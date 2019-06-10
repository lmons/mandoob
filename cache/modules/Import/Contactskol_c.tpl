
{if strval($fields.kol_c.value) == "1" || strval($fields.kol_c.value) == "yes" || strval($fields.kol_c.value) == "on"} 
{assign var="checked" value='checked="checked"'}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.kol_c.name}" value="0"> 
<input type="checkbox" id="{$fields.kol_c.name}" 
name="{$fields.kol_c.name}" 
value="1" title='' tabindex="1" {$checked} >