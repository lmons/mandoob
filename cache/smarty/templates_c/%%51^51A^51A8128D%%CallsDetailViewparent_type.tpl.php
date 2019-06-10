<?php /* Smarty version 2.6.29, created on 2019-05-27 04:51:45
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewparent_type.tpl */ ?>


<?php if (is_string ( $this->_tpl_vars['fields']['parent_type']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['parent_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['parent_type']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['parent_type']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['parent_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['parent_type']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['parent_type']['options'][$this->_tpl_vars['fields']['parent_type']['value']]; ?>

<?php endif; ?>