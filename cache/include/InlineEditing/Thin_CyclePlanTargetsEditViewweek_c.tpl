
{if strlen($fields.week_c.value) <= 0}
{assign var="value" value=$fields.week_c.default_value }
{else}
{assign var="value" value=$fields.week_c.value }
{/if}  
<input type='text' name='{$fields.week_c.name}' 
    id='{$fields.week_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >