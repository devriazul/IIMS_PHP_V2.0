<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM tbl_accdtl WHERE flname='manage_userinfo.php' AND userid='$_SESSION[userid]' and storedstatus<>'D'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $uname=mysql_real_escape_string(strtolower($_POST['uname']));
	$upass=mysql_real_escape_string(md5($_POST['upass']));
	//$password=md5($_POST['password']);	
	$emailid=mysql_real_escape_string($_POST['emailid']);
	$accessid=$_POST['accessid'];
	$opdate=date("Y-m-d");
    $query="INSERT INTO tbl_login(`userid`,`emailid`,`password`,`accid`,`storedstatus`) VALUES('$uname','$emailid','$upass','$accessid','I')";
	if($r=$myDb->insert_sql($query)){
	   $msg="Data inserted successfully";
	   echo $msg;
	   $sdq="SELECT l.id,l.userid,l.emailid,l.password,a.accname FROM tbl_access a
				              INNER JOIN tbl_login l
							  ON a.id=l.accid
							  WHERE l.id=(SELECT max(id) FROM tbl_login)";
			    $sdep=$myDb->dump_query($sdq,'edit_userinfo.php','del_userinfo.php',$car['upd'],$car['delt']);			
	   /*$sdq="select l.userid UserID,a.accname AccessName,a.id AccessID 
	         from tbl_access a
			 left join tbl_login l 
			 on a.id=l.accid order by a.id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car[upd],$car[delt]);
	   */			
    }else{
	   $msg=$myDb->last_error;
	   echo $msg;	
	   /*$sdq="select l.userid UserID,a.accname AccessName,a.id AccessID 
	         from tbl_access a
			 left join tbl_login l 
			 on a.id=l.accid order by a.id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car[upd],$car[delt]);
	  */
	  $sdq="SELECT l.id,l.userid,l.emailid,l.password,a.accname FROM tbl_access a
				              INNER JOIN tbl_login l
							  ON a.id=l.accid
							  WHERE l.id=(SELECT max(id) FROM tbl_login)";
			    $sdep=$myDb->dump_query($sdq,'edit_userinfo.php','del_userinfo.php',$car['upd'],$car['delt']);			
	} 			
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}