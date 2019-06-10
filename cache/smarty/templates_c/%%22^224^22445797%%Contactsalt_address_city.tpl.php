<?php /* Smarty version 2.6.29, created on 2019-06-03 15:07:15
         compiled from cache/modules/Import/Contactsalt_address_city.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['alt_address_city']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['alt_address_city']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['alt_address_city']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['alt_address_city']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['alt_address_city']['name']; ?>
' size='30' 
    maxlength='100' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >