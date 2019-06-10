
{if strlen($fields.active__c.value) <= 0}
{assign var="value" value=$fields.active__c.default_value }
{else}
{assign var="value" value=$fields.active__c.value }
{/if}  
<input type='text' name='{$fields.active__c.name}' 
    id='{$fields.active__c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >