

{if is_string($fields.parent_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.parent_type.name}" value="{ $fields.parent_type.options }">
{ $fields.parent_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.parent_type.name}" value="{ $fields.parent_type.value }">
{ $fields.parent_type.options[$fields.parent_type.value]}
{/if}
