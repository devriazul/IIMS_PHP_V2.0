<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageallocatehostel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    if($_GET['page'])
{
$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 20;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
?>
<script type="text/javascript" src="jquery.js"></script>

<div class="data">

<?php 

     $sdep='';
     $searchid=!empty($_POST['searchid'])?$_POST['searchid']:'';
    if(!empty($searchid)){
		$sdq="SELECT s.id, s.stdid as StudentId, s.stdname AS Name, b.batchname AS Batch, d.name AS Department 
			   FROM  `tbl_stdinfo` s 
			   inner join `tbl_batch` b 
			   on s.batch=b.id 
			   inner join `tbl_department` d 
			   on s.deptname=d.id 
			   WHERE s.stdname LIKE '$searchid%' 
			   and s.storedstatus <>  'D' and s.stdid<>''
			  limit $start,$per_page
			 ";
	}else{
		$sdq="SELECT s.id, s.stdid as StudentId, s.stdname AS Name, b.batchname AS Batch, d.name AS Department 
			   FROM  `tbl_stdinfo` s 
			   inner join `tbl_batch` b 
			   on s.batch=b.id 
			   inner join `tbl_department` d 
			   on s.deptname=d.id 
			   WHERE  s.storedstatus <>  'D' and s.stdid<>''
			  limit $start,$per_page
			 ";
	}	 
	$sdep=$myDb->dump_queryAH($sdq,'choosehostel.php',$car['upd']);
 
 
 
 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT COUNT(*) AS count FROM  `tbl_stdinfo` s 
		   inner join `tbl_batch` b 
		   on s.batch=b.id 
		   inner join `tbl_department` d 
		   on s.deptname=d.id ";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
//$goto = "<input type='hidden' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='hidden' id='catnp' name='catnp' value='".$_POST[catp]."' />";
//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul></div>";  // Content for pagination
echo $msg; 
?>
</div>
<?php  
   }
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>
