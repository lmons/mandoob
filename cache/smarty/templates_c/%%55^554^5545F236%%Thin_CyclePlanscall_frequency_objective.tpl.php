<?php /* Smarty version 2.6.29, created on 2019-05-27 11:53:56
         compiled from cache/modules/Import/Thin_CyclePlanscall_frequency_objective.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['call_frequency_objective']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_frequency_objective']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['call_frequency_objective']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['call_frequency_objective']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['call_frequency_objective']['name']; ?>
' size='30' 
    maxlength='255' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >