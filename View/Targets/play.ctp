<?php
$L = $target['Target']['target'];
?>
<div class="targets view">
<h2><?php echo __('Target'); ?></h2>
<dl>
    <dt><?php echo __('Date'); ?></dt>
    <dd>
        <?php echo h($target['Target']['date']); ?>
        &nbsp;
    </dd>
    <dt>Target</dt>
    <dd>
        <table class="target play">
            <tr class="row row1">
                <th><?php echo $L[0]; ?></th>
                <th><?php echo $L[1]; ?></th>
                <th><?php echo $L[2]; ?></th>
                <td class="answer"><?php echo $target['ROW1']['label']; ?></td>
            </tr>
            <tr class="row row2">
                <th><?php echo $L[3]; ?></th>
                <th><?php echo $L[4]; ?></th>
                <th><?php echo $L[5]; ?></th>
                <td class="answer"><?php echo $target['ROW2']['label']; ?></td>
            </tr>
            <tr class="row row3">
                <th><?php echo $L[6]; ?></th>
                <th><?php echo $L[7]; ?></th>
                <th><?php echo $L[8]; ?></th>
                <td class="answer"><?php echo $target['ROW3']['label']; ?></td>
            </tr>
            <tr>
                <td class="col col1 answer"><?php echo $target['COL1']['label']; ?></td>
                <td class="col col2 answer"><?php echo $target['COL2']['label']; ?></td>
                <td class="col col3 answer"><?php echo $target['COL3']['label']; ?></td>
                <td class="target answer"><?php echo $target['TARGET']['label']; ?></td>
            </tr>
        </table>
    </dd>
    <dt><?php echo __('Score'); ?></dt>
    <dd>
        <?php echo h($target['Target']['score']); ?>
        &nbsp;
    </dd>
</dl>
<?php
echo $this->Form->create('Target', array('action' => 'submit'));
echo $this->Form->input('id', array('value' => $target['Target']['id']));
echo $this->Form->input('answer');
echo $this->Form->end(__('Submit'));
?>
</div>