<div class="rounds view">
<h2><?php  echo __('Round'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($round['Round']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Target']['id'], array('controller' => 'targets', 'action' => 'view', $round['Target']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['User']['name'], array('controller' => 'users', 'action' => 'view', $round['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Type']['name'], array('controller' => 'types', 'action' => 'view', $round['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($round['Round']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score'); ?></dt>
		<dd>
			<?php echo h($round['Round']['score']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Round'), array('action' => 'edit', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Round'), array('action' => 'delete', $round['Round']['id']), null, __('Are you sure you want to delete # %s?', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Targets'), array('controller' => 'targets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Target'), array('controller' => 'targets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
