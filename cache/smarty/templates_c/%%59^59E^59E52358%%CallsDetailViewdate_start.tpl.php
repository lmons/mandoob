<?php /* Smarty version 2.6.29, created on 2019-05-27 04:51:45
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewdate_start.tpl */ ?>


    <?php if (strlen ( $this->_tpl_vars['fields']['date_start']['value'] ) <= 0): ?>
        <?php $this->assign('value', $this->_tpl_vars['fields']['date_start']['default_value']); ?>
    <?php else: ?>
        <?php $this->assign('value', $this->_tpl_vars['fields']['date_start']['value']); ?>
    <?php endif; ?>



<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['date_start']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>