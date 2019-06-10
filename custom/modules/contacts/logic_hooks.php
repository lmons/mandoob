<?php

    $hook_version = 1;

    $hook_array = array();
    $hook_array['before_save'] = array();

    $hook_array['before_save'][] = array(
        1,
        'before_save insertAccount',
        'custom/modules/Contacts/BeforeSaveLogicHook.php',
        'BeforeSaveLogicHook',
        'insertAccount'
    );



?>