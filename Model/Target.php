<?php
App::uses('AppModel', 'Model');
/**
 * Target Model
 *
 * @property Round $Round
 */
class Target extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'target' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Round' => array(
			'className' => 'Round',
			'foreignKey' => 'target_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function getGames(){
        $this->recursive = -1;
        $targets = $this->find('all');
        return $targets;
    }

    public function getAIGame($id){
        $this->id = $id;
        $this->recursive = -1;
        $target = $this->read();

        $types = $this->getTarget($id);
        $file = APP . 'Model' . DS . 'Datasource' . DS . 'words.txt';
        $lines = explode("\n", file_get_contents($file));
        $total = 0;
        foreach ($types as $type => $letters){
            $pattern = $this->getPattern($letters);
            $target[$type] = array(
                'answer' => null,
                'score' => 20,
                'label' => '- (20)'
            );
            el('x', $type, $letters, $pattern);

            foreach ($lines as $line){
                $guess = strtoupper($line);
                $score = strlen($guess);
                if ($score >= $target[$type]['score']){
                    continue;
                }
                if ($type === 'TARGET') {
                    if ($this->matchTarget($guess, $letters) && $this->validWord($guess)){
                        $target[$type]['answer'] = $guess;
                            $target[$type]['score'] = $score;
                            $target[$type]['label'] = $guess . ' (' . $score . ')';
                        break; //only need one target
                    }
                } else if (preg_match($pattern, $guess) && $this->validWord($guess)){
                    $target[$type]['answer'] = $guess;
                    $target[$type]['score'] = $score;
                    $target[$type]['label'] = $guess . ' (' . $score . ')';
                    if ($score === 3){  //cant beat that
                        break;
                    }
                }
            }
            $total += $target[$type]['score'];
        }
        $target['Target']['score'] = $total;
        $this->saveField('par', $total + 12);
        el($target);
        return $target;
    }

    public function getGame($id){
        $this->id = $id;
        $this->recursive = -1;
        $target = $this->read();

        $uid = 1;
        $options = array('conditions' => array(
            'Round.target_id' => $id,
            'Round.user_id' => $uid
        ));

        $rounds = $this->Round->find('all', $options);
        if (count($rounds) === 0){
            $this->initGame($uid);
            $rounds = $this->Round->find('all', $options);
        }
        $score = 0;
        foreach ($rounds as $round){
            $r = $round['Round'];
            $r['label'] = $r['answer']
                ? $r['answer']
                : '-';
            $r['label'] .= ' (' . $r['score'] . ')';
            $score += $r['score'];

            $target[$round['Type']['name']] = $r;
        }
        $target['Target']['score'] = $score;
        return $target;
    }

    private function initGame($uid){
        for ($t = 1; $t <= ROUNDS; $t++){
            $this->Round->create();
            $this->Round->save(array(
                'target_id' => $this->id,
                'user_id' => $uid,
                'type_id' => $t,
                'score' => 20
            ));
        }
    }

    public function handleSubmission($data){
        $guess = strtoupper($data['Target']['answer']);
        el($guess);
        $target = $this->getTarget($data['Target']['id']);
        foreach ($target as $type => $letters){
            $pattern = $this->getPattern($letters);
            el($type, $letters, $pattern);
            if ($type === 'TARGET'){
                if (!$this->matchTarget($guess, $letters) && $this->validWord($guess)){
                    $this->submitAnswer($guess, $type);
                }
            } else if (preg_match($pattern, $guess) && $this->validWord($guess)){
                $this->submitAnswer($guess, $type);
            }
        }
    }

    private function matchTarget($guess, $letters){
        $count = strlen($letters);
        if (strlen($guess) !== $count) return false;
        $letters = str_split($letters);
        for ($c = 0; $c < $count; $c++){
            $letter = $guess[$c];
            if (($pos = array_search($letter, $letters)) !== FALSE){
                unset($letters[$pos]);
            } else {
                return false;
            }
        }
        return true;
    }

    private function validWord($word){
        $first = $word[0];
        $file = APP . 'Model' . DS . 'Datasource' . DS . $first . '.txt';
        $fp = fopen($file, 'r');
        while ($line = fgets($fp)){
            if (substr($line,0,-1) === $word){
                return true;
            }
        }
        fclose($fp);
        el('invalid word', $word);
        return false;
    }

    private function submitAnswer($answer, $type){
        $uid = 1;
        $round = $this->Round->find('first', array('conditions' => array(
            'target_id' => $this->id,
            'user_id' => $uid,
            'type_id' => constant($type)
        )));

        $score = strlen($answer);
        el('submit', $answer, $type, $score, $round);
        if ($score < $round['Round']['score']){
            $this->Round->save(array(
                'id' => $round['Round']['id'],
                'answer' => $answer,
                'score' => strlen($answer)
            ));
        }
    }

    private function getPattern($letters){
        $AZ = '[A-Z]*';
        return '/'.$AZ.$letters[0].$AZ.$letters[1].$AZ.$letters[2].$AZ.'/';
    }

    private function getTarget($id){
        $this->id = $id;
        $record = $this->read();
        $t = $record['Target']['target'];
        // 012
        // 345
        // 678
        $target = array(
            'ROW1' => $t[0] . $t[1] . $t[2],
            'ROW2' => $t[3] . $t[4] . $t[5],
            'ROW3' => $t[6] . $t[7] . $t[8],
            'COL1' => $t[0] . $t[3] . $t[6],
            'COL2' => $t[1] . $t[4] . $t[7],
            'COL3' => $t[2] . $t[5] . $t[8],
            'TARGET' => $t
        );
        return $target;
    }

}
