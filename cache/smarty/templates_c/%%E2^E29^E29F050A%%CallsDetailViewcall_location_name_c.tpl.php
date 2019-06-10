<?php /* Smarty version 2.6.29, created on 2019-05-27 04:51:45
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewcall_location_name_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['call_location_name_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_location_name_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_location_name_c']['value']); ?>
<?php endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['call_location_name_c']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['call_location_name_c']['value']; ?>
</span>