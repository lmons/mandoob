<?php
// created: 2019-03-29 11:32:43
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'thin_cycleplantargets_contacts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_THIN_CYCLEPLANTARGETS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'THIN_CYCLEPLANTARGETS_CONTACTSCONTACTS_IDA',
    'width' => '20%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'thin_cycleplantargets_contactscontacts_ida',
  ),
  'specialty_non_db' => 
  array (
    'name' => 'specialty_non_db',
    'vname' => 'LBL_SPECIALTY',
    'width' => '20%',
    'default' => true,
    'sortable' => false,
  ),
  'accounts_non_db' => 
  array (
    'name' => 'accounts_non_db',
    'vname' => 'LBL_ACCOUNTS',
    'width' => '30%',
    'default' => true,
    'sortable' => false,
  ),
  'accounts_thin_cycleplantargets_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_ACCOUNTS_THIN_CYCLEPLANTARGETS_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_THIN_CYCLEPLANTARGETS_1ACCOUNTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'accounts_thin_cycleplantargets_1accounts_ida',
  ),
  'brick_non_db' => 
  array (
    'name' => 'brick_non_db',
    'vname' => 'LBL_BRICK',
    'width' => '30%',
    'default' => true,
    'sortable' => false,
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'vname' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'assigned_user_id',
  ),
  'customer_tier' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_CUSTOMER_TIER',
    'width' => '10%',
    'default' => true,
  ),
  'week_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_WEEK',
    'width' => '10%',
  ),
  'call_frequency_target' => 
  array (
    'type' => 'int',
    'vname' => 'LBL_CALL_FREQUENCY_TARGET',
    'width' => '10%',
    'default' => true,
  ),
  'submitted_calls' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_SUBMITTED_CALLS',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Thin_CyclePlanTargets',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Thin_CyclePlanTargets',
    'width' => '5%',
    'default' => true,
  ),
);