
{if strlen($fields.address_c.value) <= 0}
{assign var="value" value=$fields.address_c.default_value }
{else}
{assign var="value" value=$fields.address_c.value }
{/if}  
<input type='text' name='{$fields.address_c.name}' 
    id='{$fields.address_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >