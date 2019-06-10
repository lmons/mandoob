<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}
require '../../autoload.php';
require_once 'graphql/Schema/searchHelper.php';
require_once 'graphql/Schema/argsHelper.php';
//SuiteCRM files require other files from their relative path so we need to make sure we move from here
chdir('../../../');
define("DIR",dirname(__FILE__));
define("CRM_DIR",dirname(__FILE__)."/../../../");
set_include_path(DIR . '/' . PATH_SEPARATOR  . get_include_path());
require_once('data/SugarBean.php');
require_once('include/entryPoint.php');
require_once('config.php');
require_once('include/utils.php');
require_once('include/TimeDate.php');
require_once('modules/ACLRoles/ACLRole.php');
require_once('include/SugarLogger/LoggerManager.php');
require_once('modules/Opportunities/Opportunity.php');
require_once('modules/Contacts/Contact.php');
require_once('modules/Accounts/Account.php');
require_once('modules/Calls/Call.php');
require_once('modules/Leads/Lead.php');
require_once('modules/AOS_Contracts/AOS_Contracts.php');
require_once('modules/AOS_Invoices/AOS_Invoices.php');
require_once('modules/Prospects/Prospect.php');
require_once('modules/ProspectLists/ProspectList.php');
require_once('modules/Cases/Case.php');
require_once('modules/Meetings/Meeting.php');
require_once('modules/Tasks/Task.php');
require_once('modules/Documents/Document.php');
require_once('modules/Notes/Note.php');
require_once('include/formbase.php');

use Youshido\GraphQL\Execution\Processor;
use Youshido\GraphQL\Schema;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile as UploadedFile;

$config=[];
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['determineRouteBeforeAppMiddleware'] = true;
$app  = new \Slim\App(["settings" => $config]);
// initialize app
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'Cache-Control, X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
//This is dependency injection using Slim DIC -
$container = $app->getContainer();
$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('rest.php-logger');
    $file_handler = new \Monolog\Handler\StreamHandler("rest.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$app->add(function($request, $response, $next) {
    if (empty($request->getAttribute('route'))) {
        // return next Action when route not found
        return $next($request, $response);
     }
    if ($request->getAttribute('route')->getArgument('auth', true)) {
        session_start();
         $_SESSION['authenticated_user_id']=1;
        if (isset($_SESSION['authenticated_user_id']) ){
            //Somehow and sometimes current_user is not set, this breaks some functionality
            //We copy this idea from
            // https://github.com/salesagility/SuiteCRM/blob/932b87108edc154dd3c9c86b57ceaa24acd40835/modules/jjwg_Address_Cache/jjwg_Address_Cache.php
            if (empty($GLOBALS['current_user']->id) && !empty($_SESSION['authenticated_user_id'])) {
                $GLOBALS['current_user'] = new User();
                $GLOBALS['current_user']->retrieve($_SESSION['authenticated_user_id']);
            }
            return $next($request, $response);
        }else{
            return $response->withJson(['result'=>'error','message'=> 'not authenticated'], 403);
        }
    }
    return $next($request, $response);
});

$app->post('/graphql', function (Request $request, Response $response) {
    global $app_strings, $sugar_config, $app_list_strings,$sugar_config;
    $default_language = $sugar_config['default_language'];
	$app_list_strings = return_app_list_strings_language($default_language);
    require_once DIR.'/graphql/Schema/SuiteCRMSchema.php';
    require_once DIR.'/graphql/schema-bootstrap.php';
    $schema = new SuiteCRMSchema();
    $processor = new Processor($schema);
    $parsedBody = $request->getParsedBody();
    $parsedVariables = $parsedBody['variables'];
    $parsedBody = $parsedBody['query'];
    $processor->processPayload($parsedBody,$parsedVariables);
    return $response->withJson($processor->getResponseData());
    
});

$app->get('/ping', function ($request, $response) {
    global $current_user,$db;
    $reponseJson=$response->withJson(array("method" => "ping", "result" => "pong"));
    return $reponseJson;
})->setArgument('auth', false);
$app->get('/cpContact[/{id}]', function (Request $request, Response $response, $args)  {
 $query= '  SELECT
  cpts.id_c,
  cpts.week_c AS cptWeek,
  cp.id AS cpId,
  cp.start_date,
  cp.end_date,
  cp.call_frequency_objective,
  contacts.id AS contactId,
  contacts_cstm.prc_number_c AS contactPrcNumber,
  contacts.first_name AS contactFirstName,
  contacts.last_name AS contactLastName,
  contacts.first_name AS contactFirstName,
  contacts.last_name AS contactLastName,
  contacts_cstm.specialty_c AS contactSpecialty,
  contacts_cstm.gender_c AS contactGender,
  contacts_cstm.brick_c AS contactBrick,
  contacts_cstm.city_c AS contactCity,
  contacts_cstm.address_c AS contactAdress,
  cp.assigned_user_id AS cpAssignedUserId,
  cp.name AS cpName,
  cp.active,
  cp.created_by,
  cp.call_frequency_objective,
  cpt.name AS cptName,
  cpt.date_entered AS cptDateEntered,
  cpt.date_modified AS cptDateModified,
  cpt.modified_user_id AS cptModifiedUserId,
  cpt.submitted_calls AS cptSubmittedCalls,
  cpt.call_frequency_target,
  cpt.customer_tier,
  cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida,
  cpt.id,
  thin_cycleplans_cstm.cp_type_c,
  accounts.name AS accountName,
  accounts.id AS accountId
FROM
  thin_cycleplans AS cp
  INNER JOIN thin_cycleplans_thin_cycleplantargets_c AS cp_cpt ON
    cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida = cp.id
  INNER JOIN thin_cycleplantargets AS cpt ON cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplantargets_idb =
    cpt.id
  INNER JOIN thin_cycleplantargets_cstm AS cpts ON cpts.id_c = cpt.id
  INNER JOIN thin_cycleplantargets_contacts_c AS cpt_contacts ON
    cpts.id_c = cpt_contacts.thin_cycleplantargets_contactsthin_cycleplantargets_idb
  INNER JOIN contacts ON contacts.id = cpt_contacts.thin_cycleplantargets_contactscontacts_ida
  INNER JOIN contacts_cstm ON contacts_cstm.id_c = contacts.id
  INNER JOIN thin_cycleplans_cstm ON thin_cycleplans_cstm.id_c = cp.id
  INNER JOIN accounts_contacts ON accounts_contacts.contact_id = contacts_cstm.id_c
  INNER JOIN accounts ON accounts.id = accounts_contacts.account_id
WHERE
accounts_contacts.deleted="0" AND cpt.deleted="0" AND cpt_contacts.deleted="0"  AND cp.deleted="0" AND cp_cpt.deleted="0" AND 
  cp.active = "1" AND
  thin_cycleplans_cstm.cp_type_c = "Contacts" AND cp.assigned_user_id="'.$args['id'].'" 
';
 $queryCP= '  SELECT
  cpts.id_c,
  cpts.week_c AS cptWeek,
  cp.id AS cpId,
  cp.start_date,
  cp.end_date,
  cp.call_frequency_objective,
  contacts.id AS contactId,
  contacts_cstm.prc_number_c AS contactPrcNumber,
  Concat(contacts.first_name, " ", contacts.last_name) AS contactName,
  contacts_cstm.specialty_c AS contactSpecialty,
  contacts_cstm.gender_c AS contactGender,
  contacts_cstm.brick_c AS contactBrick,
  contacts_cstm.city_c AS contactCity,
  contacts_cstm.address_c AS contactAdress,
  cp.assigned_user_id AS cpAssignedUserId,
  cp.name AS cpName,
  cp.active,
  cp.created_by,
  cpt.name AS cptName,
  cpt.date_entered AS cptDateEntered,
  cpt.date_modified AS cptDateModified,
  cpt.modified_user_id AS cptModifiedUserId,
  cpt.submitted_calls AS cptSubmittedCalls,
  cpt.customer_tier,
  cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida,
  cp_cpt.id,
  thin_cycleplans_cstm.cp_type_c,
  accounts.name AS accountName,
  accounts.id AS accountId
FROM
  thin_cycleplans AS cp
  INNER JOIN thin_cycleplans_thin_cycleplantargets_c AS cp_cpt ON
    cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida = cp.id
  INNER JOIN thin_cycleplantargets AS cpt ON cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplantargets_idb =
    cpt.id
  INNER JOIN thin_cycleplantargets_cstm AS cpts ON cpts.id_c = cpt.id
  INNER JOIN thin_cycleplantargets_contacts_c AS cpt_contacts ON
    cpts.id_c = cpt_contacts.thin_cycleplantargets_contactsthin_cycleplantargets_idb
  INNER JOIN contacts ON contacts.id = cpt_contacts.thin_cycleplantargets_contactscontacts_ida
  INNER JOIN contacts_cstm ON contacts_cstm.id_c = contacts.id
  INNER JOIN thin_cycleplans_cstm ON thin_cycleplans_cstm.id_c = cp.id
  INNER JOIN accounts_contacts ON accounts_contacts.contact_id = contacts_cstm.id_c
  INNER JOIN accounts ON accounts.id = accounts_contacts.account_id
WHERE
accounts_contacts.deleted="0" AND cpt.deleted="0" AND cpt_contacts.deleted="0" AND cp.deleted="0" AND cp_cpt.deleted="0" AND 
  cp.active = "1" AND
  thin_cycleplans_cstm.cp_type_c = "Contacts" AND cp.assigned_user_id="'.$args['id'].'" 
  GROUP BY cpId
';
 $db = DBManagerFactory::getInstance();
$result = $db->query($query);
$arr=array();
//$cp=array();
            $inc=0;
        while ($row = $db->fetchByAssoc($result)) {
            $dateStart=date_create($row["start_date"]);
            $dateEnd=date_create($row["end_date"]);
            $x = new stdClass();
           // $x->id =$row['id'];
         //  $x->thin_cpt=array(id=>$row['id'],name=>$row['customer_tier']);
            $contactAarray=(array('id' => $row['contactId'],
                                'prc_number_c' =>replace_null($row["contactPrcNumber"],"") ,
                                'full_name' =>replace_null($row["contactFirstName"],"")." ".replace_null($row["contactLastName"],"") ,
                                'name' => replace_null($row["contactFirstName"],"")." ".replace_null($row["contactLastName"],"") ,
                                'first_name'=>replace_null($row["contactFirstName"],"") ,
                                'last_name'=> replace_null($row["contactLastName"],"") ,
                                'specialty_c' => replace_null($row["contactSpecialty"],"") ,
                                'gender_c' => replace_null($row["contactGender"],"") ,
                                'brick_c' =>replace_null($row["contactBrick"],"") ,
                                'city_c' => replace_null($row["contactCity"],"") ,
                                'address_c' => replace_null($row["contactAdress"],"") ,
                                'account_name' => replace_null($row["accountName"],"") ,
                                'account_id' => replace_null($row["accountId"],"") ,
                                ));

            $cptArrayObject = (array('id' => $row['id'],
                                'name' => replace_null($row["cptName"],"") ,
                                'date_entered' => replace_null($row["cptDateEntered"],"") ,
                                'date_modified' => replace_null($row["cptDateModified"],"") ,
                                'modified_user_id' => replace_null($row["cptModifiedUserId"],"") ,
                                'customer_tier'=>replace_null($row["customer_tier"],"") ,
                                'call_frequency_target'=>replace_null($row["call_frequency_target"],"") ,
                                'submitted_calls' =>replace_null($row["cptSubmittedCalls"],"") ,
                                'week_c' => replace_null($row["cptWeek"],"") ,
                                'contacts'=>$contactAarray));
            
            
                $arr[$row['cpId']][] = $cptArrayObject;
                $inc++;
           // $x->{$mod_strings['LBL_AN_LEADS_DAY']} = date("d/m/y", strtotime($row['date_start']));
            //$x->{$mod_strings['LBL_AN_LEADS_MONTH']} = date("Y", strtotime($row['date_start']))."-".$app_list_strings["dom_cal_month_long"][date("n", strtotime($row['date_start']))];
            //$x->{$mod_strings['LBL_AN_LEADS_CONTACT_NAME']} = $row['first_name']." ".$row['last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_CUTOMER_TIER']} = $row['customer_tier'];
            //$x->{$mod_strings['LBL_AN_LEADS_SPECIALTY_C']} = $app_list_strings["thin_specialty_list"][$row['specialty_c']];
            //$x->{$mod_strings['LBL_AN_LEADS_REP']} = $row['user_first_name']." ".$row['user_last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_WEEK_C']} = $row['week_c'];
            // $x->{$mod_strings['LBL_AN_LEADS_TEAM_NAME']} = $row['name1'];
         //   $returnArray[] = $x;
        }
        $result = $db->query($queryCP);
$arr1=array();
              while ($row = $db->fetchByAssoc($result)) {
            $dateStart=date_create($row["start_date"]);
            $dateEnd=date_create($row["end_date"]);
            $x = new stdClass();
   
            
            $cp1 = (array('id' => $row['cpId'],
                        'cp_type_c' => replace_null($row["cp_type_c"],"") ,
                        'assigned_user_id'=> replace_null($row["cpAssignedUserId"],"") ,
                        'name' => replace_null($row["cpName"],"") ,
                        'date_entered' => replace_null($row["cpName"],"") ,
                        'date_modified' => replace_null($row["cpName"],"") ,
                        'modified_user_id' => replace_null($row["cpName"],"") ,
                        'active' =>replace_null($row["active"],"") ,
                        'start_date'=> replace_null(date_format($dateStart,"m/d/Y"),"") ,
                        'end_date'=> replace_null(date_format($dateEnd,"m/d/Y"),"") ,
                        'call_frequency_objective'=>replace_null($row["call_frequency_objective"],"") ,
                        'created_by'=>replace_null($row["created_by"],"") ,
                        'submitted_calls'=>replace_null($row["call_frequency_objective"],"") ,));
                        $cp1['thin_cycleplantargets']=$arr[$row['cpId']];
                $arr1[] = $cp1;
            //    $inc++;
           // $x->{$mod_strings['LBL_AN_LEADS_DAY']} = date("d/m/y", strtotime($row['date_start']));
            //$x->{$mod_strings['LBL_AN_LEADS_MONTH']} = date("Y", strtotime($row['date_start']))."-".$app_list_strings["dom_cal_month_long"][date("n", strtotime($row['date_start']))];
            //$x->{$mod_strings['LBL_AN_LEADS_CONTACT_NAME']} = $row['first_name']." ".$row['last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_CUTOMER_TIER']} = $row['customer_tier'];
            //$x->{$mod_strings['LBL_AN_LEADS_SPECIALTY_C']} = $app_list_strings["thin_specialty_list"][$row['specialty_c']];
            //$x->{$mod_strings['LBL_AN_LEADS_REP']} = $row['user_first_name']." ".$row['user_last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_WEEK_C']} = $row['week_c'];
            // $x->{$mod_strings['LBL_AN_LEADS_TEAM_NAME']} = $row['name1'];
         //   $returnArray[] = $x;
        }
       // $arr1[0]['thin_cycleplantargets']=$arr;
        
   $reponseJson=$response->withJson(array("thin_cycleplans" => $arr1));
    return $reponseJson;
})->setArgument('auth', false);
$app->get('/cpAccount[/{id}]', function (Request $request, Response $response, $args)  {
 $query= 'SELECT
  cpts.id_c,
  cpts.week_c AS cptWeek,
  cp.id AS cpId,
  cp.start_date,
  cp.end_date,
  cp.call_frequency_objective,
  cp.assigned_user_id AS cpAssignedUserId,
  cp.name AS cpName,
  cp.active,
  cp.created_by,
  cpt.name AS cptName,
  cpt.date_entered AS cptDateEntered,
  cpt.date_modified AS cptDateModified,
  cpt.modified_user_id AS cptModifiedUserId,
  cpt.submitted_calls AS cptSubmittedCalls,
  cpt.customer_tier,
  cpt.call_frequency_target,
  cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida,
  cpt.id,
  thin_cycleplans_cstm.cp_type_c,
  accounts.id AS accountId,
  accounts.name AS accountName,
  accounts.date_entered AS accountDateEntered,
  accounts.date_modified AS accountDateModified,
  accounts.modified_user_id AS accountModifiedUserId,
  accounts.created_by AS accountCreatedBy,
  accounts.account_type AS accountType,
  accounts_cstm.account_subtype_c AS accountSubType,
  accounts_cstm.jjwg_maps_address_c AS accountAddress,
  accounts_cstm.brick_c AS accountBrick,
  accounts_cstm.country_c AS accountCountry,
  accounts_cstm.city_c AS accountCity,
  accounts_cstm.acc_number_c AS accountAccNumber,
  accounts.phone_office AS accountPhone
FROM
  thin_cycleplans AS cp
  INNER JOIN thin_cycleplans_thin_cycleplantargets_c AS cp_cpt ON
    cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida = cp.id
  INNER JOIN thin_cycleplantargets AS cpt ON cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplantargets_idb =
    cpt.id
  INNER JOIN thin_cycleplantargets_cstm AS cpts ON cpts.id_c = cpt.id
  INNER JOIN thin_cycleplans_cstm ON thin_cycleplans_cstm.id_c = cp.id
  INNER JOIN accounts_thin_cycleplantargets_1_c ON
    accounts_thin_cycleplantargets_1_c.accounts_thin_cycleplantargets_1thin_cycleplantargets_idb = cpts.id_c
  INNER JOIN accounts ON accounts.id = accounts_thin_cycleplantargets_1_c.accounts_thin_cycleplantargets_1accounts_ida
  INNER JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
WHERE
  cp.active = "1" AND cp.deleted="0" AND accounts_thin_cycleplantargets_1_c.deleted="0" AND cpt.deleted="0" AND cp_cpt.deleted="0" AND 
  thin_cycleplans_cstm.cp_type_c = "Accounts"
  AND cp.assigned_user_id="'.$args['id'].'"  
';
 $queryCP= ' SELECT
  cpts.id_c,
  cpts.week_c AS cptWeek,
  cp.id AS cpId,
  cp.start_date,
  cp.end_date,
  cp.call_frequency_objective,
  cp.assigned_user_id AS cpAssignedUserId,
  cp.name AS cpName,
  cp.active,
  cp.created_by,
  cpt.name AS cptName,
  cpt.date_entered AS cptDateEntered,
  cpt.date_modified AS cptDateModified,
  cpt.modified_user_id AS cptModifiedUserId,
  cpt.submitted_calls AS cptSubmittedCalls,
  cpt.customer_tier,
  cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida,
  cp_cpt.id,
  thin_cycleplans_cstm.cp_type_c,
  accounts.id AS accountId,
  accounts.name AS accountName,
  accounts.date_entered AS accountDateEntered,
  accounts.date_modified AS accountDateModified,
  accounts.modified_user_id AS accountModifiedUserId,
  accounts.created_by AS accountCreatedBy,
  accounts.account_type AS accountType,
  accounts_cstm.account_subtype_c AS accountSubType,
  accounts_cstm.jjwg_maps_address_c AS accountAddress,
  accounts_cstm.brick_c AS accountBrick,
  accounts_cstm.country_c AS accountCountry,
  accounts_cstm.city_c AS accountCity,
  accounts_cstm.acc_number_c AS accountAccNumber,
  accounts.phone_office AS accountPhone
FROM
  thin_cycleplans AS cp
  INNER JOIN thin_cycleplans_thin_cycleplantargets_c AS cp_cpt ON
    cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplans_ida = cp.id
  INNER JOIN thin_cycleplantargets AS cpt ON cp_cpt.thin_cycleplans_thin_cycleplantargetsthin_cycleplantargets_idb =
    cpt.id
  INNER JOIN thin_cycleplantargets_cstm AS cpts ON cpts.id_c = cpt.id
  INNER JOIN thin_cycleplans_cstm ON thin_cycleplans_cstm.id_c = cp.id
  INNER JOIN accounts_thin_cycleplantargets_1_c ON
    accounts_thin_cycleplantargets_1_c.accounts_thin_cycleplantargets_1thin_cycleplantargets_idb = cpts.id_c
  INNER JOIN accounts ON accounts.id = accounts_thin_cycleplantargets_1_c.accounts_thin_cycleplantargets_1accounts_ida
  INNER JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
WHERE
  cp.active = "1" AND cp.deleted="0" AND cpt.deleted="0" AND cp_cpt.deleted="0" AND 
  thin_cycleplans_cstm.cp_type_c = "Accounts"
  AND cp.assigned_user_id="'.$args['id'].'"  
  GROUP BY cpId
';
 $db = DBManagerFactory::getInstance();
$result = $db->query($query);
$arr=array();
//$cp=array();
            $inc=0;
        while ($row = $db->fetchByAssoc($result)) {
            $dateStart=date_create($row["start_date"]);
            $dateEnd=date_create($row["end_date"]);
            $x = new stdClass();
           // $x->id =$row['id'];
         //  $x->thin_cpt=array(id=>$row['id'],name=>$row['customer_tier']);
            $accountAarray=(array('id' => $row['accountId'],
                                'acc_number_c' => replace_null($row["accountAccNumber"],"") ,
                                'name' => replace_null($row["accountName"],"") ,
                                'date_entered' =>replace_null($row["accountDateEntered"],"") ,
                                'date_modified' => replace_null($row["accountDateModified"],"") ,
                                'modified_user_id' => replace_null($row["accountModifiedUserId"],"") ,
                                'created_by' => replace_null($row["accountCreatedBy"],"") ,
                                'account_type' =>replace_null($row["accountType"],"") ,
                                'account_subtype_c' =>replace_null($row["accountSubType"],"") ,
                                'phone_office' => replace_null($row["accountPhone"],"") ,
                                'jjwg_maps_address_c' =>replace_null($row["accountAddress"],"") ,
                                'brick_c' =>replace_null($row["accountBrick"],"") ,
                                'city_c' => replace_null($row["accountCity"],"") ,
                                'country_c' => replace_null($row["accountCountry"],"") ,
                                
                                
                                ));

           $cptArrayObject = (array('id' => $row['id'],
                                'name' => replace_null($row["cptName"],"") ,
                                'date_entered' => replace_null($row["cptDateEntered"],"") ,
                                'date_modified' => replace_null($row["cptDateModified"],"") ,
                                'modified_user_id' => replace_null($row["cptModifiedUserId"],"") ,
                                'customer_tier'=>replace_null($row["customer_tier"],"") ,
                                'call_frequency_target'=>replace_null($row["call_frequency_target"],"") ,
                                'submitted_calls' =>replace_null($row["cptSubmittedCalls"],"") ,
                                'week_c' => replace_null($row["cptWeek"],"") ,
                                'accounts'=>$accountAarray));
            
            
                $arr[$row['cpId']][] = $cptArrayObject;
                $inc++;
           // $x->{$mod_strings['LBL_AN_LEADS_DAY']} = date("d/m/y", strtotime($row['date_start']));
            //$x->{$mod_strings['LBL_AN_LEADS_MONTH']} = date("Y", strtotime($row['date_start']))."-".$app_list_strings["dom_cal_month_long"][date("n", strtotime($row['date_start']))];
            //$x->{$mod_strings['LBL_AN_LEADS_CONTACT_NAME']} = $row['first_name']." ".$row['last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_CUTOMER_TIER']} = $row['customer_tier'];
            //$x->{$mod_strings['LBL_AN_LEADS_SPECIALTY_C']} = $app_list_strings["thin_specialty_list"][$row['specialty_c']];
            //$x->{$mod_strings['LBL_AN_LEADS_REP']} = $row['user_first_name']." ".$row['user_last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_WEEK_C']} = $row['week_c'];
            // $x->{$mod_strings['LBL_AN_LEADS_TEAM_NAME']} = $row['name1'];
         //   $returnArray[] = $x;
        }
        $result = $db->query($queryCP);
$arr1=array();
              while ($row = $db->fetchByAssoc($result)) {
            $dateStart=date_create($row["start_date"]);
            $dateEnd=date_create($row["end_date"]);
            $x = new stdClass();
   
            
            $cp1 = (array('id' => $row['cpId'],
                        'cp_type_c' => replace_null($row["cp_type_c"],"") ,
                        'assigned_user_id'=> replace_null($row["cpAssignedUserId"],"") ,
                        'name' => replace_null($row["cpName"],"") ,
                        'date_entered' => replace_null($row["cpName"],"") ,
                        'date_modified' => replace_null($row["cpName"],"") ,
                        'modified_user_id' => replace_null($row["cpName"],"") ,
                        'active' =>replace_null($row["active"],"") ,
                        'start_date'=> replace_null(date_format($dateStart,"m/d/Y"),"") ,
                        'end_date'=> replace_null(date_format($dateEnd,"m/d/Y"),"") ,
                        'call_frequency_objective'=>replace_null($row["call_frequency_objective"],"") ,
                        'created_by'=>replace_null($row["created_by"],"") ,
                        'submitted_calls'=>replace_null($row["call_frequency_objective"],"") ,));
                        $cp1['cyclePlanTargetPharma']=$arr[$row['cpId']];
                $arr1[] = $cp1;
            //    $inc++;
           // $x->{$mod_strings['LBL_AN_LEADS_DAY']} = date("d/m/y", strtotime($row['date_start']));
            //$x->{$mod_strings['LBL_AN_LEADS_MONTH']} = date("Y", strtotime($row['date_start']))."-".$app_list_strings["dom_cal_month_long"][date("n", strtotime($row['date_start']))];
            //$x->{$mod_strings['LBL_AN_LEADS_CONTACT_NAME']} = $row['first_name']." ".$row['last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_CUTOMER_TIER']} = $row['customer_tier'];
            //$x->{$mod_strings['LBL_AN_LEADS_SPECIALTY_C']} = $app_list_strings["thin_specialty_list"][$row['specialty_c']];
            //$x->{$mod_strings['LBL_AN_LEADS_REP']} = $row['user_first_name']." ".$row['user_last_name'];
            //$x->{$mod_strings['LBL_AN_LEADS_WEEK_C']} = $row['week_c'];
            // $x->{$mod_strings['LBL_AN_LEADS_TEAM_NAME']} = $row['name1'];
         //   $returnArray[] = $x;
        }
       // $arr1[0]['thin_cycleplantargets']=$arr;
        
   $reponseJson=$response->withJson(array("thin_cycleplans" => $arr1));
    return $reponseJson;
})->setArgument('auth', false);
$app->post('/calls', function (Request $request, Response $response)  {
    
 $json = file_get_contents('php://input');
 $ddd= stripslashes($json);
$obj1 = json_decode($ddd,TRUE);
        
        $ids='"'.implode( '","' , $obj1['ids'] ).'"';
        
    //echo $ids;
   
    
    $query= 'SELECT
  calls.id,
  calls.name,
  calls.date_entered,
  calls.date_modified,
  calls.modified_user_id,
  calls.created_by,
  calls.description,
  calls.assigned_user_id,
  calls.duration_hours,
  calls.duration_minutes,
  calls.date_start,
  calls.date_end,
  calls.parent_type,
  calls.status,
  calls.parent_id,
  calls_cstm.call_location_c,
  calls_cstm.call_location_name_c,
  calls_cstm.call_type_c,
  calls_cstm.user_id_c,
  contacts.id AS id1,
  contacts.first_name as contactFirstName,
  contacts.last_name AS contactLastName,
  users.first_name AS userFirstName,
  users.last_name AS userLastName
FROM
  calls
  INNER JOIN calls_cstm ON calls_cstm.id_c = calls.id
  INNER JOIN calls_contacts ON calls_cstm.id_c = calls_contacts.call_id
  INNER JOIN contacts ON contacts.id = calls_contacts.contact_id 
  INNER JOIN users ON calls.assigned_user_id = users.id
WHERE
  calls.parent_type = "Contacts" AND calls.deleted="0" 
  AND contacts.id IN ('.$ids.')
';
 $db = DBManagerFactory::getInstance();
$result = $db->query($query);
$arr=array();
//$cp=array();
            $inc=0;
        while ($row = $db->fetchByAssoc($result)) {
            $dateStart=new DateTime($row["date_start"]);
            $dateEnd=new DateTime($row["date_end"]);
         
            $callsAarray=(array('id' => $row['id'],
                                'name' => replace_null($row["name"],"") ,
                                'call_type_c' => replace_null($row["call_type_c"],"") ,
                                'date_entered' => replace_null($row["date_entered"],"") ,
                                'date_modified' => replace_null($row["date_modified"],"") ,
                                'modified_user_id' => replace_null($row["'modified_user_id'"],"") ,
                                'created_by' => replace_null($row["created_by"],"") ,
                                'description' => replace_null($row["description"],"") ,
                                'assigned_user_id' => replace_null($row["assigned_user_id"],"") ,
                                'assigned_user_name' =>replace_null($row["userFirstName"],"")." ".replace_null($row["userLastName"],"") ,
                                'duration_hours' => replace_null($row["duration_hours"],"") ,
                                'duration_minutes' => replace_null($row["duration_minutes"],"") ,
                                'date_start' => replace_null(date_format($dateStart,"m/d/Y  H:i:s"),"") ,
                                'date_end' => replace_null(date_format($dateEnd,"m/d/Y  H:i:s"),"") ,
                                'parent_type' => replace_null($row["parent_type"],"") ,
                                'parent_id' => replace_null($row["parent_id"],"") ,
                                'parent_name' => replace_null($row["contactFirstName"],"")." ".replace_null($row["contactLastName"],"") ,
                                'status' => replace_null($row["status"],"") ,
                                'call_location_c' =>replace_null($row["call_location_c"],"") ,
                                'call_location_name_c' => replace_null($row["call_location_name_c"],"") ,
                                'contacts' => array('id'=>$row['id1']),
                                ));
            
                $arr[] = $callsAarray;
        }
    
  
   $reponseJson=$response->withJson(array("calls" => $arr));
    return $reponseJson;
})->setArgument('auth', false);
$app->post('/callsAccounts', function (Request $request, Response $response)  {
    
 $json = file_get_contents('php://input');
 $ddd= stripslashes($json);
$obj1 = json_decode($ddd,TRUE);
        
        $ids='"'.implode( '","' , $obj1['ids'] ).'"';
        
    //echo $ids;
   
    
    $query= 'SELECT
  calls.id,
  calls.name,
  calls.date_entered,
  calls.date_modified,
  calls.modified_user_id,
  calls.created_by,
  calls.description,
  calls.assigned_user_id,
  calls.duration_hours,
  calls.duration_minutes,
  calls.date_start,
  calls.date_end,
  calls.parent_type,
  calls.status,
  calls.parent_id,
  calls_cstm.call_location_c,
  calls_cstm.call_location_name_c,
  calls_cstm.call_type_c,
  calls_cstm.user_id_c,
  accounts.id AS id1,
  accounts.name AS accountName,
 users.first_name AS userFirstName,
 users.last_name AS userLastName
FROM
  calls
  INNER JOIN calls_cstm ON calls_cstm.id_c = calls.id
  INNER JOIN accounts ON accounts.id = calls.parent_id
  INNER JOIN users ON calls.assigned_user_id = users.id
WHERE calls.deleted="0" AND 
  calls.parent_type = "Accounts" 
  AND accounts.id IN ('.$ids.')
';
 $queryCP= 'SELECT
  calls.id,
  calls.name,
  calls.date_entered,
  calls.date_modified,
  calls.modified_user_id,
  calls.created_by,
  calls.description,
  calls.assigned_user_id,
  calls.duration_hours,
  calls.duration_minutes,
  calls.date_start,
  calls.date_end,
  calls.parent_type,
  calls.status,
  calls.parent_id,
  calls_cstm.call_location_c,
  calls_cstm.call_location_name_c,
  calls_cstm.call_type_c,
  calls_cstm.user_id_c,
  accounts.id AS id1,
  accounts.name AS accountName,
  CONCAT(users.first_name," ",users.last_name) AS assigned_user_name
FROM
  calls
  INNER JOIN calls_cstm ON calls_cstm.id_c = calls.id
  INNER JOIN accounts ON accounts.id = calls.parent_id
  INNER JOIN users ON calls.assigned_user_id = users.id
WHERE
calls.deleted="0" AND 
  calls.parent_type = "Accounts" 
  AND accounts.id IN ('.$ids.')
  GROUP BY accounts.id
';
 $db = DBManagerFactory::getInstance();
$result = $db->query($query);
$arr=array();
//$cp=array();
            $inc=0;
        while ($row = $db->fetchByAssoc($result)) {
            $dateStart=new DateTime($row["date_start"]);
            $dateEnd=new DateTime($row["date_end"]);
         
           $callsAarray=(array('id' => $row['id'],
                                'name' => replace_null($row["name"],"") ,
                                'call_type_c' => replace_null($row["call_type_c"],"") ,
                                'date_entered' => replace_null($row["date_entered"],"") ,
                                'date_modified' => replace_null($row["date_modified"],"") ,
                                'modified_user_id' => replace_null($row["'modified_user_id'"],"") ,
                                'created_by' => replace_null($row["created_by"],"") ,
                                'description' => replace_null($row["description"],"") ,
                                'assigned_user_id' => replace_null($row["assigned_user_id"],"") ,
                                'assigned_user_name' =>replace_null($row["userFirstName"],"")." ".replace_null($row["userLastName"],"") ,
                                'duration_hours' => replace_null($row["duration_hours"],"") ,
                                'duration_minutes' => replace_null($row["duration_minutes"],"") ,
                                'date_start' => replace_null(date_format($dateStart,"m/d/Y  H:i:s"),"") ,
                                'date_end' => replace_null(date_format($dateEnd,"m/d/Y  H:i:s"),"") ,
                                'parent_type' => replace_null($row["parent_type"],"") ,
                                'parent_id' => replace_null($row["parent_id"],"") ,
                                'parent_name' => replace_null($row["accountName"],""),
                                'status' => replace_null($row["status"],"") ,
                                'call_location_c' =>replace_null($row["call_location_c"],"") ,
                                'call_location_name_c' => replace_null($row["call_location_name_c"],"") ,
                                
                                ));
            
                $arr[$row['id1']][] = $callsAarray;
        }
        $result = $db->query($queryCP);
$arr1=array();
              while ($row = $db->fetchByAssoc($result)) {
   
            $accounts = (array('id' => $row['id1']));
                        $accounts['calls']=$arr[$row['id1']];
                $arr1[] = $accounts;
        }
    
  
   $reponseJson=$response->withJson(array("accounts" => $arr1));
    return $reponseJson;
})->setArgument('auth', false);
$app->post('/contactAccounts', function (Request $request, Response $response)  {
    
 $json = file_get_contents('php://input');
 $ddd= stripslashes($json);
$obj1 = json_decode($ddd,TRUE);
        
        $ids='"'.implode( '","' , $obj1['ids'] ).'"';
        
    //echo $ids;
   
    
    $query= 'SELECT
   accounts.id AS accountId,
  accounts.name AS accountName,
  accounts.date_entered AS accountDateEntered,
  accounts.date_modified AS accountDateModified,
  accounts.modified_user_id AS accountModifiedUserId,
  accounts.created_by AS accountCreatedBy,
  accounts.account_type AS accountType,
  accounts_cstm.account_subtype_c AS accountSubType,
  accounts_cstm.jjwg_maps_address_c AS accountAddress,
  accounts_cstm.brick_c AS accountBrick,
  accounts_cstm.country_c AS accountCountry,
  accounts_cstm.city_c AS accountCity,
  accounts_cstm.acc_number_c AS accountAccNumber,
  accounts.phone_office AS accountPhone,
  contacts.id AS id1
FROM
  accounts
  INNER JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
  INNER JOIN contacts_accounts_1_c ON contacts_accounts_1_c.contacts_accounts_1accounts_idb = accounts_cstm.id_c
  INNER JOIN contacts ON contacts_accounts_1_c.contacts_accounts_1contacts_ida = contacts.id
  WHERE
  contacts.id IN ('.$ids.')
';
 $queryCP= 'SELECT
  accounts.id AS accountId,
  accounts.name AS accountName,
  accounts.date_entered AS accountDateEntered,
  accounts.date_modified AS accountDateModified,
  accounts.modified_user_id AS accountModifiedUserId,
  accounts.created_by AS accountCreatedBy,
  accounts.account_type AS accountType,
  accounts_cstm.account_subtype_c AS accountSubType,
  accounts_cstm.jjwg_maps_address_c AS accountAddress,
  accounts_cstm.brick_c AS accountBrick,
  accounts_cstm.country_c AS accountCountry,
  accounts_cstm.city_c AS accountCity,
  accounts_cstm.acc_number_c AS accountAccNumber,
  accounts.phone_office AS accountPhone,
  contacts.id AS id1
FROM
  accounts
  INNER JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
  INNER JOIN contacts_accounts_1_c ON contacts_accounts_1_c.contacts_accounts_1accounts_idb = accounts_cstm.id_c
  INNER JOIN contacts ON contacts_accounts_1_c.contacts_accounts_1contacts_ida = contacts.id
  WHERE
  contacts.id IN ('.$ids.')
  GROUP BY  contacts.id
';
 $db = DBManagerFactory::getInstance();
$result = $db->query($query);
$arr=array();
//$cp=array();
            $inc=0;
        while ($row = $db->fetchByAssoc($result)) {
            $dateStart=new DateTime($row["date_start"]);
            $dateEnd=new DateTime($row["date_end"]);
         
            $accountAarray=(array('id' => $row['accountId'],
                                'acc_number_c' => replace_null($row["accountAccNumber"],"") ,
                                'name' => replace_null($row["accountName"],"") ,
                                'date_entered' =>replace_null($row["accountDateEntered"],"") ,
                                'date_modified' => replace_null($row["accountDateModified"],"") ,
                                'modified_user_id' => replace_null($row["accountModifiedUserId"],"") ,
                                'created_by' => replace_null($row["accountCreatedBy"],"") ,
                                'account_type' =>replace_null($row["accountType"],"") ,
                                'account_subtype_c' =>replace_null($row["accountSubType"],"") ,
                                'phone_office' => replace_null($row["accountPhone"],"") ,
                                'jjwg_maps_address_c' =>replace_null($row["accountAddress"],"") ,
                                'brick_c' =>replace_null($row["accountBrick"],"") ,
                                'city_c' => replace_null($row["accountCity"],"") ,
                                'country_c' => replace_null($row["accountCountry"],"") ,
                                
                                
                                ));
            
                $arr[$row['id1']][] = $accountAarray;
        }
        $result = $db->query($queryCP);
$arr1=array();
              while ($row = $db->fetchByAssoc($result)) {
   
            $contacts = (array('id' => $row['id1']));
                        $contacts['accounts']=$arr[$row['id1']];
                $arr1[] = $contacts;
        }
    
  
   $reponseJson=$response->withJson(array("contacts" => $arr1));
    return $reponseJson;
})->setArgument('auth', false);
$app->get('/suitecrm/languageModuleLabel', function ($request, $response) {
     global $app_strings,$mod_strings,$currnet_language,$moduleList ;
      $languageKey="fr_FR";
        $module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));
foreach($module_list as $module_name) {
        $field_defs[$module_name] = return_module_language($languageKey, $module_name);
        
}  
$field_defs['Home'] = return_module_language($languageKey, 'Home');
$field_defs['Calendar'] = return_module_language($languageKey, 'Calendar');
   
     $reponseJson=$response->withJson($field_defs);
    return $reponseJson;
})->setArgument('auth', false);


$app->get('/suitecrm/languageLabel', function ($request, $response) {
     global $app_strings;
         $languageKey="fr_FR";
     $reponseJson=$response->withJson($app_strings);
    return $reponseJson;
})->setArgument('auth', false);
$app->get('/suitecrm/moduleFields', function ($request, $response) {
    $module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));

foreach($module_list as $module_name) {
        $bean = BeanFactory::getBean($module_name);
        $field_defs[$module_name] = $bean->getFieldDefinitions();
}
    $reponseJson=$response->withJson($field_defs);
    return $reponseJson;
})->setArgument('auth', false);

$app->post('/sendEmail', function (Request $request, Response $response)  {
    $parsedBody     = $request->getParsedBody();
    $message        = $parsedBody->message;
    $recipient      = $parsedBody->recipient;
    $template       = $parsedBody->template;
    $subject        = $parsedBody->subject;
    $attachments   = $parsedBody->attachments;

    if (empty($message) || empty($recipient) || empty($template)) {
        return json_encode("Invalid parameters");
    }
    global $current_user, $db;
    require_once("include/SugarPHPMailer.php");
    $query                  = "select id, name from email_templates where name ='".$template."';";// where name like '%a2%' limit 1";
    $results                = $db->query($query);
    $current_emailtemplate  = new EmailTemplate();
    $idTemplate             =   '';
    while ($row = $db->fetchByAssoc($results)) {
        $idTemplate=$row['id'];
    }
    $current_emailtemplate->retrieve($idTemplate);
    //escape email template contents.
    $current_emailtemplate->subject=from_html($current_emailtemplate->subject);
    $current_emailtemplate->body_html=from_html($current_emailtemplate->body_html);
    $current_emailtemplate->body=from_html($current_emailtemplate->body);
    $mail = new SugarPHPMailer();
    $mail->Mailer = "smtp"; //make configurable
    $mail->IsHTML(true);
     // Set the different fields for the attachments
     foreach ($attachments as $key => $attachement) {
         $file_name  = $attachement->name;
         $location  = __DIR__."/upload/{$attachement->id}";
         $mime_type  = $attachment->$attachement->mimeType;
         // Add attachment to email
         $mail->AddAttachment($location, $file_name, 'base64', $mime_type);
     }


    $email_body=$current_emailtemplate->body_html;
    $email_body = str_replace('{{message}}', $message, $email_body);
    $current_emailtemplate->body_html= $email_body;

    $mail->ClearAllRecipients();
    $mail->ClearReplyTos();
    $mail->setMailerForSystem();
    /** [IC] jeggers: 8/6/2008 */
    $sugarEmailAddress = new SugarEmailAddress();
    /** end [IC] */
    $mail->AddAddress($recipient);
    $emailObj = new Email();
    $defaults = $emailObj->getSystemDefaultEmail();
    $mail->From = $defaults['email'];
    $mail->Sender = $defaults['email'];
    $mail->FromName = $defaults['name'];

    if ($subject=='From Template') {
        $mail->Subject =  $current_emailtemplate->subject;
    } else {
        $mail->Subject=$subject;
    }
    //check if this template is meant to be used as "text only"
    $text_only = false;
    if (isset($current_emailtemplate->text_only) && $current_emailtemplate->text_only) {
        $text_only =true;
    }
    //if this template is textonly, then just send text body.
    if ($text_only) {
        $this->description_html = '';
        $mail->IsHTML(false);
    }
    $mail->Body = $current_emailtemplate->body_html;

    $mail->prepForOutbound();
    $success = $mail->Send();
    if (!$success) {
        error_log("Email failed to send. ".$mail->ErrorInfo);
        error_log($subject);
        error_log($message);
        error_log($recipient);
        error_log($template);
        echo json_encode($mail->ErrorInfo);
    }
    $reponseJson=$response->withJson(array("result" => "success" ));
    return $reponseJson;
});
$app->post('/webtocontactopportunity', function (Request $request, Response $response)  {
    $parsedBody     = $request->getParsedBody();

    $first_name        = $parsedBody['contact_first_name'];
    $last_name        = $parsedBody[ 'contact_last_name'];
    $phone_mobile        = $parsedBody['contact_phone_mobile'];
    $email        = $parsedBody['contact_email1'];
    $opportunity_name        = $parsedBody['opportunity_name'];
    $campaign_id        = $parsedBody['campaign_id'];
    $assigned_user_id        = $parsedBody['assigned_user_id'];

    if ( empty($last_name) ) {
        return $response->withJson(['result'=>'error','message'=> 'Last Name missing'], 400);
    }elseif (empty($campaign_id)) {
        return $response->withJson(['result'=>'error','message'=> 'Campaign Id missing'], 400);
    }elseif (empty($email) && empty($phone_mobile)) {
        return $response->withJson(['result'=>'error','message'=> 'Missing contact information - at least a phone (contact_phone_mobile) or an email (contact_email1) should be provided'], 400);
    }

    global $current_user, $db,$dictionary, $moduleList,$beanList,$beanFiles,$app_list_strings,$sugar_config;
    $GLOBALS['app_list_strings'] = return_app_list_strings_language($GLOBALS['current_language']);
    $default_language = $sugar_config['default_language'];

    $current_user->id="bot";
    $co = new Contact();
    $op = new Opportunity();
    if (empty($language)) {
        $language = $default_language;
    }
    $entities=["Contacts", "Opportunities"];
    $moduleFields=array();
    foreach ($entities as $entity) {
        $object = BeanFactory::getObjectName($entity);
        VardefManager::refreshVardefs($entity, $object);
        if (!empty($beanList[$entity]) && $entity!="Cases") {
            $entity=$beanList[$entity];
        }elseif ($entity=="Cases") {
            //Case is a special scenario, Cases is the entity, but aCase is the class and Case seems to be in the dictionary
            $entity="Case";
        }
        if(isset($dictionary[$entity])){
            $moduleFields[$entity]=$dictionary[$entity]['fields'];
        }else{
            $moduleFields=null;
        }
    }
    foreach ($parsedBody as $parameter => $value) {
        if(substr_count($parameter,'contact_')>0){
            $tentativeVariableName=str_replace('contact_','',$parameter);
            if(isset($moduleFields['Contact'][$tentativeVariableName])){
                $co->{$tentativeVariableName}=$value;
            }
        }
        if(substr_count($parameter,'opportunity_')>0){
            $tentativeVariableName=str_replace('opportunity_','',$parameter);
            if(isset($moduleFields['Opportunity'][$tentativeVariableName])){
                $op->{$tentativeVariableName}=$value;
            }
        }
    }
    $co->last_name =  $last_name;
    $co->email1 =  $email;
    $op->name = $op->name? $op->name: "Web Opportunity";
    $op->campaign_id = $campaign_id;
    $co->campaign_id = $campaign_id;
    $op->assigned_user_id =  $assigned_user_id? $assigned_user_id:"bot";
    $co->assigned_user_id =  $assigned_user_id? $assigned_user_id:"bot";
    $co->save();
    foreach ($co->get_linked_beans('accounts') as $account) {
        $account_id = $account->id;
    }
    if(!empty($account_id)){
        $op->account_id = $account_id;
    }
    $op->contact_id = $co->id;
    //Only for LionixCRM - suitecrm/sugarcrm will not mind having this set unless is a new field on your installation
    $op->maincontact_c = $co->id;
    $op->sales_stage = "Prospecting";
    $op->save();
    $co=$co->retrieve($co->id);
    $co->opportunity_id=$op->id;
    $co->save();
    if(isset($co->id) && isset($op->id)  ){
        return $response->withJson(array("result" => "success" ), 200);
    }else{
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/lx.log", PHP_EOL. date_format(date_create(),"Y-m-d H:i:s ")  .__FILE__ .":". __LINE__." -- ".print_r("Opportunity or Contact could not be saved - Dumping request for analysis", 1).PHP_EOL, FILE_APPEND);
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/lx.log", PHP_EOL. date_format(date_create(),"Y-m-d H:i:s ")  .__FILE__ .":". __LINE__." -- ".print_r($parsedBody, 1).PHP_EOL, FILE_APPEND);
        return $response->withJson(array("result" => "error", "message" => "Unknown error" ), 400);
    }
})->setArgument('auth', false);;

$app->post('/upload/attachment', function (Request $request, Response $response)  {
    global $sugar_config, $current_user;
    function createSuiteCrmDocument($data, $parentType, $parentId)
    {
        // Try to upload file
        try {
            // Success!
            $document = new Document();
            //         $document->id = "testing-a-lot";
            //         $document->new_with_id = true;
            $document->document_name = $data['name'];
            $document->filename = $data['name'];
            $document->category_id = 'Sales';
            $document->status_id = 'Active';
            $document->assigned_user_id = $user_id;
            $document->save();
            // $contents = file_get_contents("upload://{$data['name']}");

            $revision = new DocumentRevision();
            //         $revision->id = "testing-a-lot-rev";
            //         $revision->new_with_id = true;
            $revision->document_id = $document->id;
            //$revision->file = base64_encode($contents);
            $revision->filename = $document->filename;
            $revision->revision = 1;
            $revision->doc_type = 'Sugar';
            $revision->change_log = 'Document Created';
            $revision->file_mime_type = $data['mime'];
            $revision->file_ext = $data['extension'];
            $revision->save();

            $document->load_relationship(strtolower($parentType));
            if (strtolower($parentType)=="contacts") {
                $document->parent_type = ucwords(strtolower($parentType));
                $document->contact_id = $parentId;
                $document->parent_id = $parentId;
            }
            $document->contacts->add($parentId);
            $document->save();

            $data['document_id'] = $document->id;
            $data['revision_id'] = $revision->id;
            $data['document_file'] = "index.php?entryPoint=download&type=Documents&id={$revision->id}";
            return $data;
        } catch (\Exception $e) {
            // Fail!
            $errors = "Cannot create Document ";
            return $errors;
        }
    }

    function createSuiteCrmNote($data, $parentType, $parentId)
    {
        // Try to upload file
        try {
            // Success!
            $note = new Note();
            //         $note->id = "testing-a-lot";
            //         $note->new_with_id = true;
            $note->name = $data['name'];
            $note->filename = $data['name'];
            $note->file_mime_type = $data['mime'];
            $note->assigned_user_id = $user_id;
            $note->parent_type = $parentType;
            $note->parent_id = $parentId;
            if (strtolower($parentType) == 'contacts') {
                $note->contact_id = $parentId;
            }
            $note->save();
            // $contents = file_get_contents("upload://{$data['name']}");
            $data['note_id'] = $note->id;
            $data['note_file'] = "index.php?entryPoint=download&type=Notes&id={$note->id}";
            return $data;
        } catch (\Exception $e) {
            // Fail!
            $errors = "Cannot create Document ";
            return $errors;
        }
    }

    $parsedBody = $request->getParsedBody();
    if (empty($parsedBody['parent_id'])) {
        return false;
    } else {
        $parentId =$parsedBody['parent_id'];
        $parentType = $parsedBody['parent_type'];
    }
    $storage = new \Upload\Storage\FileSystem(CRM_DIR."/".$sugar_config['upload_dir']);
    $file = new \Upload\File('upload_files', $storage);
    if (count($file)>1) {
        //Multiple file upload
        $results=[];
        for ($i=0 ; $i <count($file) ; $i++) {
            // error_log(__FILE__." ". __LINE__." ". $i);
            // Access data about the file that has been uploaded
            $data = array(
                'name'       => $file[$i]->getNameWithExtension(),
                'extension'  => $file[$i]->getExtension(),
                'mime'       => $file[$i]->getMimetype(),
                'size'       => $file[$i]->getSize(),
                'md5'        => $file[$i]->getMd5(),
                'dimensions' => $file[$i]->getDimensions()
            );

            // $result=createSuiteCrmDocument($data, $parentType, $parentId);
            $result=createSuiteCrmNote($data, $parentType, $parentId);
            $file[$i]->setName($result['note_id']);
            $file[$i]->setExtension("");
            $results[]=$result;
        }
        try {
            //Trying to save the File
            $file->upload();
            $reponseJson=$response->withJson($results);
        } catch (\Exception $e) {
            $results[]=$file->getErrors();
            error_log(__FILE__." ". __LINE__." ". print_r($e, 1));
            $reponseJson=$response->withJson(array("result" => "error", "result" => $results), 401);
        }
        return $reponseJson;
    } else {
        $data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        );
        $result=createSuiteCrmNote($data, $parentType, $parentId);
        $file->setName($result['note_id']);
        $results[]=$result;
        $file->setExtension("");
        try {
            $file->upload();
            echo json_encode($results);
            $reponseJson=$response->withJson($results);
        } catch (\Exception $e) {
            $result[]=$file->getErrors();
            // error_log(__FILE__." ". __LINE__." ". print_r($e, 1));
            $reponseJson=$response->withJson(array("result" => "error", "result" => $results), 401);
        }
        return $reponseJson;
    }
});

$app->get('/accounts[/{id}]', function (Request $request, Response $response, $args)  {
    global $sugar_config, $current_user;
    $accountBean = BeanFactory::getBean('Accounts');
    if (isset($id)) {
        $account = $accountBean->retrieve($args['id']);
        $module_arr = array();
        if ($account->id && $account->ACLAccess('view')) {
            $all_fields = $account->column_fields;
            foreach ($all_fields as $field) {
                if (isset($account->$field) && !is_object($account->$field)) {
                    $account->$field = from_html($account->$field);
                    $account->$field = preg_replace("/\r\n/", "<BR>", $account->$field);
                    $account->$field = preg_replace("/\n/", "<BR>", $account->$field);
                    $module_arr['accounts'][$field] = $account->$field;
                }
            }
            return $response->withJson($module_arr);
        } else {
            return $response->withJson(['result'=>'error','message'=> 'You shall not pass!'], 403);
        }
    } else {
        $list = $accountBean->get_list();
        $resultArray = [];
        if (is_array($list) && !empty($list)) {
            foreach ($list['list'] as $account) {
                if ($account->ACLAccess('list')) {
                    if ($account->id && $account->ACLAccess('view')) {
                        $all_fields = $account->column_fields;
                        foreach ($all_fields as $field) {
                            if (isset($account->$field) && !is_object($account->$field)) {
                                $account->$field = from_html($account->$field);
                                $account->$field = preg_replace("/\r\n/", "<BR>", $account->$field);
                                $account->$field = preg_replace("/\n/", "<BR>", $account->$field);
                                $module_arr['accounts'][$field] = $account->$field;
                            }
                        }
                        $resultArray[]=$module_arr;
                    }
                } else {
                    return $response->withJson(['result'=>'error','message'=> 'You shall not pass!'], 403);
                }
            }
            return $response->withJson($module_arr);
        }
    }
});



$app->get('/suitecrm/dropdown/{name}[/{type}]', function (Request $request, Response $response, $args){
    global $sugar_config, $current_user;
    $suitecrm_list=$GLOBALS['app_list_strings'][$args['name']];
    $list = array();
    //$list[]=array(''=>''); //when empty value is needed
    foreach ($suitecrm_list as $value => $name) {
        //$list[] = array('value' => $value, 'name' => $name, 'default' => $default, 'selected' => $selected); //this  is the below format example
        switch ($args['type']) {
            case 'native':
                $list[] = array('value' => $value, 'name' => $name);
                break;
            case 'formio':
                $list[] = array('label' => $value, 'value' => $name);
                break;
            default:
                $list[] = array('id' => $value, 'name' => $name);
                break;
        }

    }
    return $response->withJson($list);
});

$app->get('/suitecrm/applist', function (Request $request, Response $response, $args){
    global $sugar_config, $current_user;
    $suitecrm_list=$GLOBALS['app_list_strings'];
    return $response->withJson($suitecrm_list);
});
$app->get('/suitecrm/restrictionconfig', function (Request $request, Response $response, $args){
    global $timedate, $sugar_config, $current_user;
        $configuratorObj = new Configurator();
        $configuratorObj->loadConfig();
       $enable_restriction= array('time'=>$timedate->to_display_date_time($timedate->getInstance()->nowDb(), true, true, $current_user),'submitConf'=>$configuratorObj->config['realisation'],'planConf'=>$configuratorObj->config['planification']);
     //   echo json_encode($enable_restriction);
    return $response->withJson($enable_restriction);
});


$app->post('/whoami', function (Request $request, Response $response){
    global $sugar_config, $current_user;
    //We retrieve the current user in order to get
    // all the fields we have to serialize
    $userBean = BeanFactory::getBean('Users');
    $user=$userBean->retrieve($current_user->id);
    $all_fields = $user->column_fields;
    $roles = ACLRole::getUserRoleNames($current_user->id);
    if (!empty($roles)) {
        $module_arr['user']['roles']=$roles;
    }
    $timezone = TimeDate::userTimezone($user);
    $module_arr['user']['language']=$GLOBALS['current_language'];
    $module_arr['user']['timezone']=$timezone;

    foreach ($all_fields as $field) {
        if (isset($current_user->$field) && !is_object($current_user->$field)) {
            if (is_string($current_user->$field)) {
                $current_user->$field = from_html($current_user->$field);
                $current_user->$field = preg_replace("/\r\n/", "<BR>", $current_user->$field);
                $current_user->$field = preg_replace("/\n/", "<BR>", $current_user->$field);
            }
            if (isset($translate)
                && !empty($current_user->$field) && isset($current_user->field_defs[$field]['options'])
                && $current_user->field_defs[$field]['options']!='date_range_search_dom'
                && $current_user->field_defs[$field]['options']!='numeric_range_search_dom') {
                $displayFieldValue = $GLOBALS['app_list_strings'][$current_user->field_defs[$field]['options']][$current_user->$field];
                $field_hidden=$field . "_hidden";
                $current_user->$field_hidden=$current_user->$field;

                $current_user->$field=$displayFieldValue;
            }
            if (isset($field_hidden)) {
                $module_arr['user'][$field_hidden] = $current_user->$field_hidden;
                unset($field_hidden);
            }
            $module_arr['user'][$field] = $current_user->$field;
        }
    }
    //Override User Hash - we don't need it
    $module_arr['user']['user_hash']='youShallNotPass';
    return $response->withJson($module_arr);
})->setArgument('auth', true);



function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function replace_null($value, $replace) {
    if(empty($value) && $value !== '0') {
        return $replace;
    } else {
        return $value;
    }
}
if(file_exists(__DIR__.'/../../../graphql/CustomRest.php')){
    include_once(__DIR__.'/../../../graphql/CustomRest.php');
}
$app->run();
