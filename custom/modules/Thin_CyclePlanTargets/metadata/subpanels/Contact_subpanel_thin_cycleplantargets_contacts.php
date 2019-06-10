<?php
// created: 2019-01-02 06:11:48
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'thin_cycleplans_thin_cycleplantargets_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_THIN_CYCLEPLANS_THIN_CYCLEPLANTARGETS_FROM_THIN_CYCLEPLANS_TITLE',
    'id' => 'THIN_CYCLEPLANS_THIN_CYCLEPLANTARGETSTHIN_CYCLEPLANS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Thin_CyclePlans',
    'target_record_key' => 'thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida',
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