<?php 
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM candidate where id=".$_GET['id'])->fetch_array();

extract($_POST);

 		$fname=$qry['profile_path'];   
       $file = ("assets/profile/".$fname);
       $fname = explode('_',$fname);
       unset($fname[0]);
       $fname = implode("",$fname);
       header ("Content-Type: ".filetype($file));
       header ("Content-Length: ".filesize($file));
       header ("Content-Disposition: attachment; filename=".$fname);

       readfile($file);