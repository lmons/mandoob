<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class BeforeSaveLogicHook
{
function insertAccount($bean, $event, $args)
    {
        if (!isset($bean->ignore_update_c) || $bean->ignore_update_c === false) {
            $bean->load_relationship('contacts_accounts_1');
            $bean->contacts_accounts_1->delete($bean->id,$bean->fetched_row['account_id']); 
            $bean->contacts_accounts_1->add($bean->account_id);
            $bean->ignore_update_c = true;
         //   $bean->save();
        }
    }
}

?>