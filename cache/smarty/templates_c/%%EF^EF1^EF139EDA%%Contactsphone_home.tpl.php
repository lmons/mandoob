<?php /* Smarty version 2.6.29, created on 2019-05-20 10:52:09
         compiled from cache/modules/Import/Contactsphone_home.tpl */ ?>


<?php if (strlen ( $this->_tpl_vars['fields']['phone_home']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['phone_home']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['phone_home']['value']); ?>
<?php endif; ?>  

<input type='text' name='<?php echo $this->_tpl_vars['fields']['phone_home']['name']; ?>
' id='<?php echo $this->_tpl_vars['fields']['phone_home']['name']; ?>
' size='30' maxlength='100' value='<?php echo $this->_tpl_vars['value']; ?>
' title='' tabindex='1'	  class="phone" >