<?php /* Smarty version 2.6.29, created on 2019-05-20 10:52:09
         compiled from cache/modules/Import/Contactsmodified_user_id.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['modified_user_id']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modified_user_id']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['modified_user_id']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['modified_user_id']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['modified_user_id']['name']; ?>
' size='30' 
     
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >