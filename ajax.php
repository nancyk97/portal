<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
// if($action == 'delete_user'){
// 	$save = $crud->delete_user();
// 	if($save)
// 		echo $save;
// }
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_recruitment_status"){
	$save = $crud->save_recruitment_status();
	if($save)
		echo $save;
}
if($action == "delete_recruitment_status"){
	$save = $crud->delete_recruitment_status();
	if($save)
		echo $save;
}

if($action == "save_candidate"){
	$save = $crud->save_candidate();
	if($save)
		echo $save;
}
// if($action == "delete_application"){
// 	$save = $crud->delete_application();
// 	if($save)
// 		echo $save;
// }
if($action == "check_existing_candidate"){
	$save = $crud->check_existing_candidate();
	if($save)
		echo $save;
}
if($action == "download_certificate"){
    $save = $crud->download_certificate();
    echo $save;
    return $save;
    if($save)
        echo $save;
}

