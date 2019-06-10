<?php /* Smarty version 2.6.29, created on 2019-05-27 11:53:56
         compiled from cache/modules/Import/Thin_CyclePlanssubmitted_calls.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['submitted_calls']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['submitted_calls']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['submitted_calls']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['submitted_calls']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['submitted_calls']['name']; ?>
' size='30' 
    maxlength='255' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >