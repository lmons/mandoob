

<script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
<form action="index.php" method="post" name="DetailView" id="formDetailView">
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
</form>
<ul id="detail_header_action_menu" class="clickMenu fancymenu" ><li class="sugar_action_button" >{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Thin_CyclePlanTargets'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} <ul id class="subnav" ><li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Thin_CyclePlanTargets'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} </li><li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Thin_CyclePlanTargets'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li><li>{if $bean->aclAccess("edit") && $bean->aclAccess("delete")}<input title="{$APP.LBL_DUP_MERGE}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Thin_CyclePlanTargets'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='Step1'; _form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Merge" value="{$APP.LBL_DUP_MERGE}" id="merge_duplicate_button">{/if} </li><li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Thin_CyclePlanTargets", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li></ul></li></ul>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Thin_CyclePlanTargets_detailview_tabs"
>
<div >
<div id='detailpanel_1' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<!-- PANEL CONTAINER HERE.. -->
<table id='DEFAULT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.thin_cycleplantargets_contacts_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_THIN_CYCLEPLANTARGETS_CONTACTS_FROM_CONTACTS_TITLE' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="thin_cycleplantargets_contacts_name" width='37.5%'  >
{if !$fields.thin_cycleplantargets_contacts_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.thin_cycleplantargets_contactscontacts_ida.value)}
{capture assign="detail_url"}index.php?module=Contacts&action=DetailView&record={$fields.thin_cycleplantargets_contactscontacts_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="thin_cycleplantargets_contactscontacts_ida" class="sugar_field" data-id-value="{$fields.thin_cycleplantargets_contactscontacts_ida.value}">{$fields.thin_cycleplantargets_contacts_name.value}</span>
{if !empty($fields.thin_cycleplantargets_contactscontacts_ida.value)}</a>{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="assigned_user_name" width='37.5%'  >
{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount"}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.accounts_thin_cycleplantargets_1_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNTS_THIN_CYCLEPLANTARGETS_1_FROM_ACCOUNTS_TITLE' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="accounts_thin_cycleplantargets_1_name" width='37.5%'  >
{if !$fields.accounts_thin_cycleplantargets_1_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.accounts_thin_cycleplantargets_1accounts_ida.value)}
{capture assign="detail_url"}index.php?module=Accounts&action=DetailView&record={$fields.accounts_thin_cycleplantargets_1accounts_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="accounts_thin_cycleplantargets_1accounts_ida" class="sugar_field" data-id-value="{$fields.accounts_thin_cycleplantargets_1accounts_ida.value}">{$fields.accounts_thin_cycleplantargets_1_name.value}</span>
{if !empty($fields.accounts_thin_cycleplantargets_1accounts_ida.value)}</a>{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.call_frequency_target.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CALL_FREQUENCY_TARGET' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="call_frequency_target" width='37.5%'  >
{if !$fields.call_frequency_target.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.call_frequency_target.name}">
{sugar_number_format precision=0 var=$fields.call_frequency_target.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.thin_cycleplans_thin_cycleplantargets_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_THIN_CYCLEPLANS_THIN_CYCLEPLANTARGETS_FROM_THIN_CYCLEPLANS_TITLE' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="thin_cycleplans_thin_cycleplantargets_name" width='37.5%'  >
{if !$fields.thin_cycleplans_thin_cycleplantargets_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida.value)}
{capture assign="detail_url"}index.php?module=Thin_CyclePlans&action=DetailView&record={$fields.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida" class="sugar_field" data-id-value="{$fields.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida.value}">{$fields.thin_cycleplans_thin_cycleplantargets_name.value}</span>
{if !empty($fields.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida.value)}</a>{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.submitted_calls.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBMITTED_CALLS' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="submitted_calls" width='37.5%'  >
{if !$fields.submitted_calls.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.submitted_calls.name}">
{sugar_number_format precision=0 var=$fields.submitted_calls.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.week_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_WEEK' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="week_c" width='37.5%'  >
{if !$fields.week_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.week_c.value) <= 0}
{assign var="value" value=$fields.week_c.default_value }
{else}
{assign var="value" value=$fields.week_c.value }
{/if} 
<span class="sugar_field" id="{$fields.week_c.name}">{$fields.week_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.customer_tier.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUSTOMER_TIER' module='Thin_CyclePlanTargets'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="customer_tier" width='37.5%'  >
{if !$fields.customer_tier.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.customer_tier.options)}
<input type="hidden" class="sugar_field" id="{$fields.customer_tier.name}" value="{ $fields.customer_tier.options }">
{ $fields.customer_tier.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.customer_tier.name}" value="{ $fields.customer_tier.value }">
{ $fields.customer_tier.options[$fields.customer_tier.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
        function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script><script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>