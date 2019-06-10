

{if is_string($fields.call_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.call_type_c.name}" value="{ $fields.call_type_c.options }">
{ $fields.call_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.call_type_c.name}" value="{ $fields.call_type_c.value }">
{ $fields.call_type_c.options[$fields.call_type_c.value]}
{/if}
