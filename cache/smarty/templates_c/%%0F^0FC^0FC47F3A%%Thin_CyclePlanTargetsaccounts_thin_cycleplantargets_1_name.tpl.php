<?php /* Smarty version 2.6.29, created on 2019-05-23 10:48:27
         compiled from cache/modules/Import/Thin_CyclePlanTargetsaccounts_thin_cycleplantargets_1_name.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'cache/modules/Import/Thin_CyclePlanTargetsaccounts_thin_cycleplantargets_1_name.tpl', 7, false),array('function', 'sugar_getimagepath', 'cache/modules/Import/Thin_CyclePlanTargetsaccounts_thin_cycleplantargets_1_name.tpl', 18, false),)), $this); ?>

<input type="text" name="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" class="sqsEnabled" tabindex="1" id="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" size="" value="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['value']; ?>
" title='' autocomplete="off"  	 >
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['id_name']; ?>
" 
	id="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['id_name']; ?>
" 
	value="<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1accounts_ida']['value']; ?>
">
<span class="id-ff multiple">
<button type="button" name="btn_<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" id="btn_<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" tabindex="1" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE'), $this);?>
" class="button firstChild" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL'), $this);?>
"
onclick='open_popup(
    "<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['module']; ?>
", 
	600, 
	400, 
	"", 
	true, 
	false, 
	<?php echo '{"call_back_function":"set_return","form_name":"importstep3","field_to_name_array":{"id":"accounts_thin_cycleplantargets_1accounts_ida","name":"accounts_thin_cycleplantargets_1_name"}}'; ?>
, 
	"single", 
	true
);' ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-select.png"), $this);?>
"></button><button type="button" name="btn_clr_<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" id="btn_clr_<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
" tabindex="1" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE'), $this);?>
"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
', '<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['id_name']; ?>
');"  value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL'), $this);?>
" ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['<?php echo $this->_tpl_vars['form_name']; ?>
_<?php echo $this->_tpl_vars['fields']['accounts_thin_cycleplantargets_1_name']['name']; ?>
']) != 'undefined'",
		enableQS
);
</script>