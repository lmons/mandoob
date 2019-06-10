
{if strlen($fields.call_location_name_c.value) <= 0}
{assign var="value" value=$fields.call_location_name_c.default_value }
{else}
{assign var="value" value=$fields.call_location_name_c.value }
{/if} 
<span class="sugar_field" id="{$fields.call_location_name_c.name}">{$fields.call_location_name_c.value}</span>
