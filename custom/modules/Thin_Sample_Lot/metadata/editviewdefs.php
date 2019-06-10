<?php
$module_name = 'Thin_Sample_Lot';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'aos_products_thin_sample_lot_1_name',
            'displayParams' => 
            array (
              'initial_filter' => '&type_advanced=Sample',
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'active_c',
            'label' => 'LBL_ACTIVE',
          ),
          1 => 
          array (
            'name' => 'expiration_date_c',
            'label' => 'LBL_EXPIRATION_DATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'calls_thin_sample_lot_1_name',
          ),
        ),
      ),
    ),
  ),
);
echo "lmkm";
?>
