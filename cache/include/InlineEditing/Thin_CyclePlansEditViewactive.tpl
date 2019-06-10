
{if strval($fields.active.value) == "1" || strval($fields.active.value) == "yes" || strval($fields.active.value) == "on"} 
{assign var="checked" value='checked="checked"'}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.active.name}" value="0"> 
<input type="checkbox" id="{$fields.active.name}" 
name="{$fields.active.name}" 
value="1" title='' tabindex="1" {$checked} >