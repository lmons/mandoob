
{if strlen($fields.call_location_name_c.value) <= 0}
{assign var="value" value=$fields.call_location_name_c.default_value }
{else}
{assign var="value" value=$fields.call_location_name_c.value }
{/if}  
<input type='text' name='{$fields.call_location_name_c.name}' 
    id='{$fields.call_location_name_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >