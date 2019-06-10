<?php
$id_medecin=$_GET['id_medecin'];
$url = "http://thnln.com/scrm/service/v4_1/rest.php";
$url2 = "http://scrm.thnln.com/custom/service/v4_1_custom/rest.php";
$username = "admin";
$password = "password";
//function to make cURL request
function call($method, $parameters, $url)
{
    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

    $jsonEncodedData = json_encode($parameters);

    $post = array(
        "method" => $method,
        "input_type" => "JSON",
        "response_type" => "JSON",
        "rest_data" => $jsonEncodedData
    );

    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);

    $result = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();

    return $response;
}

//login ---------------------------------------------
$login_parameters = array(
    "user_auth" => array(
        "user_name" => $username,
        "password" => md5($password),
        "version" => "1"
    ),
    "application_name" => "RestTest",
    "name_value_list" => array(),
);

$login_result = call("login", $login_parameters, $url);

$get_module_fields_parameters = array(
    //Session id
    'session' => $login_result->id,

    //The name of the module from which to retrieve records
    'module_name' => "Contacts",

    //The ID of the record to retrieve.
    'id' => $id_medecin,

    //The list of fields to be returned in the results
    'fields' => array(
        'account_id',
    ),

    //A list of link names and the fields to be returned for each link name
    'link_name_to_fields_array' => array(
    ),

    //Flag the record as a recently viewed item
    'track_view' => true,

);
$get_module_fields_result=call("get_entry",$get_module_fields_parameters, $url);

//print_r(json_encode($cc->fields));

print_r(json_encode($get_module_fields_result));