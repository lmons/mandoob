<?php /* Smarty version 2.6.29, created on 2019-05-27 04:51:45
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewcall_type_c.tpl */ ?>


<?php if (is_string ( $this->_tpl_vars['fields']['call_type_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['call_type_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['call_type_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['call_type_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['call_type_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['call_type_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['call_type_c']['options'][$this->_tpl_vars['fields']['call_type_c']['value']]; ?>

<?php endif; ?>