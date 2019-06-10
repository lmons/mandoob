
{if strlen($fields.tm_accept_decline.value) <= 0}
{assign var="value" value=$fields.tm_accept_decline.default_value }
{else}
{assign var="value" value=$fields.tm_accept_decline.value }
{/if}  
<input type='text' name='{$fields.tm_accept_decline.name}' 
    id='{$fields.tm_accept_decline.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >