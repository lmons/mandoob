

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
<ul id="detail_header_action_menu" class="clickMenu fancymenu" ><li class="sugar_action_button" >{if $bean->aclAccess("edit","not_set","not_set",$bean->report_module)}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" 
onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='AOR_Reports'; 
_form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';
SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}"/>{/if}<ul id class="subnav" ><li>{if $bean->aclAccess("edit","not_set","not_set",$bean->report_module)}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" 
onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='AOR_Reports'; 
_form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; 
_form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button"/>{/if}</li><li>{if $bean->aclAccess("delete","not_set","not_set",$bean->report_module)}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" 
onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='AOR_Reports'; 
_form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) 
SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button"/>{/if}</li><li><input type="button" class="button" id="download_csv_button_old" value="{$MOD.LBL_EXPORT}"/></li><li><input type="button" class="button" id="download_pdf_button_old" value="{$MOD.LBL_DOWNLOAD_PDF}"/></li><li><input type="button" class="button" onClick="openProspectPopup();" value="{$MOD.LBL_ADD_TO_PROSPECT_LIST}"/></li><li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=AOR_Reports", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li></ul></li></ul>
</div>
</td>
<td align="right" width="20%">{$ADMIN_EDIT}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="AOR_Reports_detailview_tabs"
>
<div >
<div id='detailpanel_1' class='detail view  detail508 collapsed'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<!-- PANEL CONTAINER HERE.. -->
<table id='DEFAULT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME' module='AOR_Reports'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="name" field="name" width='37.5%'  >
{if !$fields.name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if} 
<span class="sugar_field" id="{$fields.name.name}">{$fields.name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>			</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='AOR_Reports'}{/capture}
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
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='AOR_Reports'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="datetime" field="date_entered" width='37.5%'  >
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_modified.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_MODIFIED' module='AOR_Reports'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="datetime" field="date_modified" width='37.5%'  >
{if !$fields.date_modified.hidden}
{counter name="panelFieldCount"}
<span id="date_modified" class="sugar_field">{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}</span>
{/if}
</td>
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
{if !$fields.description.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='AOR_Reports'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="description" width='37.5%' colspan='3' >
{if !$fields.description.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
<script src="modules/AOR_Conditions/conditionLines.js"></script>
<script>
    report_module = '{$report_module}';
</script>
<div>
{$charts_content}
</div>
<div id='detailpanel_parameters' class='detail view  detail508 expanded hidden'>
<form onsubmit="return false" id="EditView" name="EditView">
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel('parameters');">
<img border="0" id="detailpanel_parameters_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel('parameters');">
<img border="0" id="detailpanel_parameters_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_PARAMETERS' module='AOR_Reports'}
<script>
            document.getElementById('detailpanel_parameters').className += ' expanded';
        </script>
</h4>
<div id="conditionLines" class="panelContainer" style="min-height: 50px;">
</div>
<input id='updateParametersButton' class="panelContainer" type="button" value="{sugar_translate label='LBL_UPDATE_PARAMETERS' module='AOR_Reports'}"/>
<script>
            {literal}
            $.each(reportParameters,function(key,val){
                loadConditionLine(val, 'EditView');
            });

            $(document).ready(function() {
                $('#updateParametersButton').click(function(){
                    //Update the Detail view form to have the parameter info and reload the page
                    var _form = $('#formDetailView');
                    _form.find('input[name=action]').val('DetailView');
                    //Add each parameter to the form in turn
                    $('.aor_conditions_id').each(function(index, elem){
                        $elem = $(elem);
                        var ln = $elem.attr('id').substr(17);
                        var id = $elem.val();
                        _form.append('<input type="hidden" name="parameter_id[]" value="'+id+'">');
                        var operator = $("#aor_conditions_operator\\["+ln+"\\]").val();
                        _form.append('<input type="hidden" name="parameter_operator[]" value="'+operator+'">');
                        var fieldType = $('#aor_conditions_value_type\\['+ln+'\\]').val();
                        _form.append('<input type="hidden" name="parameter_type[]" value="'+fieldType+'">');
                        var fieldInput = $('#aor_conditions_value\\['+ln+'\\]').val();

                        // Fix for issue #1272 - AOR_Report module cannot update Date type parameter.
                        if($('#aor_conditions_value\\['+ln+'\\]\\[0\\]').length){
                            var fieldValue = $('#aor_conditions_value\\['+ln+'\\]\\[0\\]').val();
                            var fieldSign = $('#aor_conditions_value\\['+ln+'\\]\\[1\\]').val();
                            var fieldNumber = $('#aor_conditions_value\\['+ln+'\\]\\[2\\]').val();
                            var fieldTime = $('#aor_conditions_value\\['+ln+'\\]\\[3\\]').val();                            _form.append('<input type="hidden" name="parameter_value[]" value="'+fieldValue+'">');
                            _form.append('<input type="hidden" name="parameter_value[]" value="'+fieldSign+'">');
                            _form.append('<input type="hidden" name="parameter_value[]" value="'+fieldNumber+'">');
                            _form.append('<input type="hidden" name="parameter_value[]" value="'+fieldTime+'">');
                        }
                        // Fix for issue #1082 - change local date format to db date format
                        if($('#aor_conditions_value\\['+index+'\\]').hasClass('date_input')) { // only change to DB format if its a date
                            if ($('#aor_conditions_value\\[' + ln + '\\]').hasClass('date_input')) {
                                fieldInput = $.datepicker.formatDate('yy-mm-dd', new Date(fieldInput));
                            }
                        }
                        _form.append('<input type="hidden" name="parameter_value[]" value="'+fieldInput+'">');
                    });
                    _form.submit();
                });

                // Make sure to change dates back to the user format
                $('.aor_conditions_id').each(function(index, elem){
                    if($('#aor_conditions_value\\['+index+'\\]').hasClass('date_input')) {
                        var dateValue = new Date( $('#aor_conditions_value\\['+index+'\\]').val() );
                        var dateValueinUserFormat = dateValue.toLocaleFormat(cal_date_format);
                        $('#aor_conditions_value\\['+index+'\\]').val(dateValueinUserFormat)
                    }
                });
            });
            {/literal}
        </script>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel('parameters', 'expanded'); {rdelim}); </script>
</form>
</div>
<div id='detailpanel_report' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel('report');">
<img border="0" id="detailpanel_report_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel('report');">
<img border="0" id="detailpanel_report_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_REPORT' module='AOR_Reports'}
<script>
            document.getElementById('detailpanel_report').className += ' expanded';
        </script>
</h4>
<table id='FIELDS' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='37.5%' colspan='4' >
{if !$fields.field_lines.hidden}
{counter name="panelFieldCount"}
<span id='field_lines_span'>
{$fields.field_lines.value}
{$report_content}
</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel('report', 'expanded'); {rdelim}); </script>
</div>
<script src="modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.js"></script><script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>