<?php /* Smarty version 2.6.29, created on 2019-05-27 13:12:20
         compiled from cache/include/InlineEditing/ContactsEditViewemail2.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['email2']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['email2']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['email2']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['email2']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['email2']['name']; ?>
' size='30' 
     
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >