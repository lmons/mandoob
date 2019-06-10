<?php /* Smarty version 2.6.29, created on 2019-05-22 11:05:29
         compiled from cache/include/InlineEditing/Thin_CyclePlanTargetsEditViewcall_frequency_target.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_number_format', 'cache/include/InlineEditing/Thin_CyclePlanTargetsEditViewcall_frequency_target.tpl', 8, false),)), $this); ?>

<?php if (strlen ( $this->_tpl_vars['fields']['call_frequency_target']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_frequency_target']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_frequency_target']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['call_frequency_target']['name']; ?>
' 
id='<?php echo $this->_tpl_vars['fields']['call_frequency_target']['name']; ?>
' size='30' maxlength='255' value='<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['value']), $this);?>
' title='' tabindex='1'    >