
{if strlen($fields.call_frequency_objective.value) <= 0}
{assign var="value" value=$fields.call_frequency_objective.default_value }
{else}
{assign var="value" value=$fields.call_frequency_objective.value }
{/if}  
<input type='text' name='{$fields.call_frequency_objective.name}' 
    id='{$fields.call_frequency_objective.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >