<div class="rounds form">
<?php echo $this->Form->create('Round'); ?>
	<fieldset>
		<legend><?php echo __('Edit Round'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('target_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('answer');
		echo $this->Form->input('score');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Round.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Round.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Targets'), array('controller' => 'targets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Target'), array('controller' => 'targets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
