<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
			var name=$('#selectmenu option:selected').text();
			var num=parseInt(values);
                 $('#pid').val(num);
				 $('#pname').val(name);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#qty').focus();
			  		  $('#showpick').html("<img src='bigLoader.gif' />");

			  $('#showpick').fadeOut('slow');
		   }	  
		});
		

 });
</script>
<?php  
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["p"];
if (!$q) return;
$storeid=mysql_real_escape_string($_GET['storeid']);
$sql = "SELECT p . * , SUM( b.pqty ) 
			FROM tbl_product p
			INNER JOIN tbl_buyproduct b ON p.id = b.pid
			WHERE p.pname LIKE  '$q%'
			AND b.storeid='$storeid'
			AND b.pqty >0
			AND b.pstatus =  'P'
			AND b.storeid<>''
			GROUP BY pid";
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['id']; ?>"><?php echo $rs['pname']; ?></option>
<?php 

}
?>
  </select>


<?php 

}else{
  header("Location:index.php");
}
}
