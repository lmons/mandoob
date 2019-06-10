<?php /* Smarty version 2.6.29, created on 2019-05-24 11:32:41
         compiled from cache/include/InlineEditing/Thin_CyclePlansEditViewactive.tpl */ ?>

<?php if (strval ( $this->_tpl_vars['fields']['active']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['active']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['active']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'checked="checked"'); ?>
<?php else: ?>
<?php $this->assign('checked', ""); ?>
<?php endif; ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['active']['name']; ?>
" value="0"> 
<input type="checkbox" id="<?php echo $this->_tpl_vars['fields']['active']['name']; ?>
" 
name="<?php echo $this->_tpl_vars['fields']['active']['name']; ?>
" 
value="1" title='' tabindex="1" <?php echo $this->_tpl_vars['checked']; ?>
 >