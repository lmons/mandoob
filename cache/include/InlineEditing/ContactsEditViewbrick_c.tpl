
{if strlen($fields.brick_c.value) <= 0}
{assign var="value" value=$fields.brick_c.default_value }
{else}
{assign var="value" value=$fields.brick_c.value }
{/if}  
<input type='text' name='{$fields.brick_c.name}' 
    id='{$fields.brick_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >