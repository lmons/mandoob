
{if strlen($fields.specialty_non_db.value) <= 0}
{assign var="value" value=$fields.specialty_non_db.default_value }
{else}
{assign var="value" value=$fields.specialty_non_db.value }
{/if}  
<input type='text' name='{$fields.specialty_non_db.name}' 
    id='{$fields.specialty_non_db.name}' size='30' 
     
    value='{$value}' title=''  tabindex='1'      >