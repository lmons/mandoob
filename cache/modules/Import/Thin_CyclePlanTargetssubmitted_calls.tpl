
{if strlen($fields.submitted_calls.value) <= 0}
{assign var="value" value=$fields.submitted_calls.default_value }
{else}
{assign var="value" value=$fields.submitted_calls.value }
{/if}  
<input type='text' name='{$fields.submitted_calls.name}' 
id='{$fields.submitted_calls.name}' size='30' maxlength='255' value='{sugar_number_format precision=0 var=$value}' title='' tabindex='1'    >