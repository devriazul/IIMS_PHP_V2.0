<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rptdesignation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_designation.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
		 
</script>
<script src="designation.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<style type="text/css">
<!--
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style></head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          ���������<br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">


<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
          <div align="center">
          <a href="reportdesignation.php" target="new"><input type="button"  value="Print Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB;" /></a>
<table width="95%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" class="gridTbl">
              <tr bgcolor="#F4F4FF">
                <th width="10%" height="18" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small;  ">ID</span></div></th>
                <th width="60%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Name</span></div></th>
                <th width="30%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Description</span></div></th>
                </tr>
              <?php 
				$uac=$myDb->select("SELECT * FROM tbl_designation Where storedstatus<>'D' order by torder");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
              <tr bgcolor="#FFFFFF">
                <td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['id']; ?></span></td>
                <td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['name']; ?></span></td>
                <td height="21" class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['description']; ?></span></td>
                </tr>
              <?php } ?>
            </table>
          </div>
          <div align="center">
            <br />
   		    </div>
          <div id="MyResult" align="center"></div>  		          
          
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}