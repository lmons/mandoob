
{if strlen($fields.call_frequency_target.value) <= 0}
{assign var="value" value=$fields.call_frequency_target.default_value }
{else}
{assign var="value" value=$fields.call_frequency_target.value }
{/if}  
<input type='text' name='{$fields.call_frequency_target.name}' 
id='{$fields.call_frequency_target.name}' size='30' maxlength='255' value='{sugar_number_format precision=0 var=$value}' title='' tabindex='1'    >