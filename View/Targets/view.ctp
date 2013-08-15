<div class="targets view">
<h2><?php  echo __('Target'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($target['Target']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target'); ?></dt>
		<dd>
			<?php echo h($target['Target']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($target['Target']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Target'), array('action' => 'edit', $target['Target']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Target'), array('action' => 'delete', $target['Target']['id']), null, __('Are you sure you want to delete # %s?', $target['Target']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Targets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Target'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('controller' => 'rounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rounds'); ?></h3>
	<?php if (!empty($target['Round'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Target Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Answer'); ?></th>
		<th><?php echo __('Score'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($target['Round'] as $round): ?>
		<tr>
			<td><?php echo $round['id']; ?></td>
			<td><?php echo $round['target_id']; ?></td>
			<td><?php echo $round['user_id']; ?></td>
			<td><?php echo $round['type_id']; ?></td>
			<td><?php echo $round['answer']; ?></td>
			<td><?php echo $round['score']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rounds', 'action' => 'view', $round['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rounds', 'action' => 'edit', $round['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rounds', 'action' => 'delete', $round['id']), null, __('Are you sure you want to delete # %s?', $round['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Round'), array('controller' => 'rounds', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
