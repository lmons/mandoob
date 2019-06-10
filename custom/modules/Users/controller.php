<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

 

require_once('modules/Users/controller.php');

 

class CustomUsersController extends UsersController

{

    protected function action_editview() {

        $this->view = (is_admin($GLOBALS['current_user'])) ? 'edit' : 'noaccess';

    }

}