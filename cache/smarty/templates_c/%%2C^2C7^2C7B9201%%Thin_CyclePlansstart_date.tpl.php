<?php /* Smarty version 2.6.29, created on 2019-05-27 11:53:56
         compiled from cache/modules/Import/Thin_CyclePlansstart_date.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'cache/modules/Import/Thin_CyclePlansstart_date.tpl', 6, false),array('modifier', 'default', 'cache/modules/Import/Thin_CyclePlansstart_date.tpl', 18, false),)), $this); ?>

<span class="dateTime">
<?php $this->assign('date_value', $this->_tpl_vars['fields']['start_date']['value']); ?>
<input class="date_input" autocomplete="off" type="text" name="<?php echo $this->_tpl_vars['fields']['start_date']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['start_date']['name']; ?>
" value="<?php echo $this->_tpl_vars['date_value']; ?>
" title=''  tabindex='1'    size="11" maxlength="10" >
<?php ob_start(); ?>alt="<?php echo $this->_tpl_vars['APP']['LBL_ENTER_DATE']; ?>
" style="position:relative; top:6px" border="0" id="<?php echo $this->_tpl_vars['fields']['start_date']['name']; ?>
_trigger"<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('other_attributes', ob_get_contents());ob_end_clean(); ?>
<?php echo smarty_function_sugar_getimage(array('name' => 'jscalendar','ext' => ".gif",'other_attributes' => ($this->_tpl_vars['other_attributes'])), $this);?>

&nbsp;(<span class="dateFormat"><?php echo $this->_tpl_vars['USER_DATEFORMAT']; ?>
</span>)
</span>
<script type="text/javascript">
Calendar.setup ({
inputField : "<?php echo $this->_tpl_vars['fields']['start_date']['name']; ?>
",
form : "importstep3",
ifFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
daFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
button : "<?php echo $this->_tpl_vars['fields']['start_date']['name']; ?>
_trigger",
singleClick : true,
dateStr : "<?php echo $this->_tpl_vars['date_value']; ?>
",
startWeekday: <?php echo ((is_array($_tmp=@$this->_tpl_vars['CALENDAR_FDOW'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
,
step : 1,
weekNumbers:false
}
);
</script>