<?php /* Smarty version 2.6.29, created on 2019-05-22 12:24:00
         compiled from cache/modules/Import/Thin_CyclePlanTargetsaccounts_non_db.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['accounts_non_db']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['accounts_non_db']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['accounts_non_db']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['accounts_non_db']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['accounts_non_db']['name']; ?>
' size='30' 
     
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >