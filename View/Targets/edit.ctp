<div class="targets form">
<?php echo $this->Form->create('Target'); ?>
	<fieldset>
		<legend><?php echo __('Edit Target'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('target');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Target.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Target.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Targets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
