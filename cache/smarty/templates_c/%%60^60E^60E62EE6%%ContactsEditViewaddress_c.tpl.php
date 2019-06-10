<?php /* Smarty version 2.6.29, created on 2019-05-24 10:28:36
         compiled from cache/include/InlineEditing/ContactsEditViewaddress_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['address_c']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['address_c']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['address_c']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['address_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['address_c']['name']; ?>
' size='30' 
    maxlength='255' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >