<?php
App::uses('AppController', 'Controller');
/**
 * Targets Controller
 *
 * @property Target $Target
 */
class TargetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Target->recursive = 0;
		$this->set('targets', $this->paginate());
	}

    public function game(){
        $games = $this->Target->getGames();
        $this->set('targets', $games);
        $this->set('print', $games);
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Target->exists($id)) {
			throw new NotFoundException(__('Invalid target'));
		}
		$options = array('conditions' => array('Target.' . $this->Target->primaryKey => $id));
		$this->set('target', $this->Target->find('first', $options));
	}

    public function play($id = null) {
        if (!$this->Target->exists($id)) {
            throw new NotFoundException(__('Invalid target'));
        }
        $game = $this->Target->getGame($id);
        $this->set('target', $game);
        $this->set('print', json_encode($game, JSON_PRETTY_PRINT));
    }

    public function ai($id = null) {
        if (!$this->Target->exists($id)) {
            throw new NotFoundException(__('Invalid target'));
        }
        $this->set('target', $this->Target->getAIGame($id));
    }

    public function submit(){
        if ($this->request->is('post')){
            $this->Target->handleSubmission($this->request->data);
            $this->redirect(array('action' => 'play', $this->Target->id));
        }
    }

    public function json(){
        $json = array();
        for ($i = 1; $i <= 15; $i++){
            $json[$i] = $this->Target->getGame($i);
        }
        $this->set('print', json_encode($json));
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Target->create();
            $this->request->data['Target']['target'] = strtoupper($this->request->data['Target']['target']);
			if ($this->Target->save($this->request->data)) {
				$this->Session->setFlash(__('The target has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The target could not be saved. Please, try again.'));
			}
		}
	}

    public function words(){
        $datasource = APP . 'Model' . DS . 'Datasource' . DS;
        $words = explode("\n", file_get_contents($datasource . 'words.txt'));
        $files = array();
        for ($c = 65; $c <= 90; $c++) $files[chr($c)] = array();
        foreach ($words as $word){
            $word = strtoupper($word);
            if (preg_match('/[A-Z]*/', $word)){
                $files[$word[0]][] = $word;
            }
        }
        foreach ($files as $letter => $lines){
            file_put_contents($datasource . $letter . '.txt', implode("\n", $lines));
        }
        $this->Session->setFlash('Words files created');
        $this->redirect(array('action' => 'index'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Target->exists($id)) {
			throw new NotFoundException(__('Invalid target'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Target->save($this->request->data)) {
				$this->Session->setFlash(__('The target has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The target could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Target.' . $this->Target->primaryKey => $id));
			$this->request->data = $this->Target->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Target->id = $id;
		if (!$this->Target->exists()) {
			throw new NotFoundException(__('Invalid target'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Target->delete()) {
			$this->Session->setFlash(__('Target deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Target was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
