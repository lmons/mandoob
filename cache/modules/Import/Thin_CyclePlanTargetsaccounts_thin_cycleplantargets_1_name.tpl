
<input type="text" name="{$fields.accounts_thin_cycleplantargets_1_name.name}" class="sqsEnabled" tabindex="1" id="{$fields.accounts_thin_cycleplantargets_1_name.name}" size="" value="{$fields.accounts_thin_cycleplantargets_1_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.accounts_thin_cycleplantargets_1_name.id_name}" 
	id="{$fields.accounts_thin_cycleplantargets_1_name.id_name}" 
	value="{$fields.accounts_thin_cycleplantargets_1accounts_ida.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.accounts_thin_cycleplantargets_1_name.name}" id="btn_{$fields.accounts_thin_cycleplantargets_1_name.name}" tabindex="1" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL"}"
onclick='open_popup(
    "{$fields.accounts_thin_cycleplantargets_1_name.module}", 
	600, 
	400, 
	"", 
	true, 
	false, 
	{literal}{"call_back_function":"set_return","form_name":"importstep3","field_to_name_array":{"id":"accounts_thin_cycleplantargets_1accounts_ida","name":"accounts_thin_cycleplantargets_1_name"}}{/literal}, 
	"single", 
	true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.accounts_thin_cycleplantargets_1_name.name}" id="btn_clr_{$fields.accounts_thin_cycleplantargets_1_name.name}" tabindex="1" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.accounts_thin_cycleplantargets_1_name.name}', '{$fields.accounts_thin_cycleplantargets_1_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.accounts_thin_cycleplantargets_1_name.name}']) != 'undefined'",
		enableQS
);
</script>