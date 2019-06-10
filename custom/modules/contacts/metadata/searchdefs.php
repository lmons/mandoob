<?php
$searchdefs ['Contacts'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'search_name' => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'favorites_only' => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'prc_number_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PRC_NUMBER',
        'width' => '10%',
        'name' => 'prc_number_c',
      ),
    ),
    'advanced_search' => 
    array (
      'first_name' => 
      array (
        'name' => 'first_name',
        'default' => true,
        'width' => '10%',
      ),
      'email' => 
      array (
        'name' => 'email',
        'label' => 'LBL_ANY_EMAIL',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'phone' => 
      array (
        'name' => 'phone',
        'label' => 'LBL_ANY_PHONE',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'last_name' => 
      array (
        'name' => 'last_name',
        'default' => true,
        'width' => '10%',
      ),
      'city_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CITY',
        'width' => '10%',
        'name' => 'city_c',
      ),
      'brick_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_BRICK',
        'width' => '10%',
        'name' => 'brick_c',
      ),
      'address_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_ADDRESS',
        'width' => '10%',
        'name' => 'address_c',
      ),
      'specialty_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SPECIALTY',
        'width' => '10%',
        'name' => 'specialty_c',
      ),
      'prc_number_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PRC_NUMBER',
        'width' => '10%',
        'name' => 'prc_number_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
