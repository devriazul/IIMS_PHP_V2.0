<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
  $id=mysql_real_escape_string($_GET['id']);
  $mq="SELECT*FROM tbl_stdinfo WHERE stdid in(SELECT stdid FROM tbl_educationalq where id='$id')";
  $mqr=$myDb->select($mq);
  $msf=$myDb->get_row($mqr,'MYSQL_ASSOC');
  $stid=$msf['id'];
    $ei="UPDATE tbl_educationalq SET 
									 nexemination='".mysql_real_escape_string($_POST['nexemination'])."',
									 group1='".mysql_real_escape_string($_POST['group1'])."',
									 board='".mysql_real_escape_string($_POST['board'])."',
									 passyear='".mysql_real_escape_string($_POST['passyear'])."',
									 cgpas='".mysql_real_escape_string($_POST['cgpas'])."',
									 tcgpa='".mysql_real_escape_string($_POST['tcgpa'])."',
									 gcsubject='".mysql_real_escape_string($_POST['gcsubject'])."',
									 opby='$_SESSION[userid]',
									 othtrade='".mysql_real_escape_string($_POST['othtrade'])."'
	     WHERE id='$id'";
    if($ein=$myDb->insert_sql($ei)){
		$msg="Student education information successfully updated.";
		header("Location:manage_student.php?msg=$msg&id=$stid");
	}else{
	    $msg=$myDb->last_error;
		header("Location:manage_student.php?msg=$msg&id=$stid");
	}	
	
 
 
 }else{
     $msg="Sorry,you are not authorized to access this page";
 }	 

}else{
  header("Location:login.php");
}
}