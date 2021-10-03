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

<script type="text/javascript" src="jquery-latest.js"></script>
  <script type="text/javascript" src="jquery.form.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm<?php echo $count; ?>').ajaxForm({
      target: '#showdata<?php echo $count; ?>',
      success: function() {
	    $('#ani<?php echo $count; ?>').show('slow');
	    $('#ani<?php echo $count; ?>').html('<img src="loader.gif" align="absmiddle">');
        $('#showdata<?php echo $count; ?>').show(100);		
		$('#ani<?php echo $count; ?>').hide();

      }
    });
  });
 
  </script>
  <script language="JavaScript" type="text/javascript">
<!--

/*function copy<?php //echo $count; ?>() {
   var sel = document.getElementById("session<?php //echo $count; ?>");
   var text = sel.options[sel.selectedIndex].text;
   document.getElementById("year<?php //echo $count; ?>").value=text;
   //var out = document.getElementById("output");
   //out.value += text+"\n";
}

function showSelected<?php echo $count; ?>()
{
	var selObj = document.getElementById('session<?php echo $count; ?>');
	var inVal;
	var selIndex = selObj.selectedIndex;
	inVal=selIndex;
	switch(selObj.options[selIndex].text){
	  case '2005-2006':
	     document.getElementById('year<?php echo $count; ?>').value='2005';
		 break;
      case '2006-2007':
	     document.getElementById('year<?php echo $count; ?>').value='2006';
	     break;	 
      case '2007-2008':
	     document.getElementById('year<?php echo $count; ?>').value='2007';
	     break;	  
      case '2008-2009':
	     document.getElementById('year<?php echo $count; ?>').value='2008';
	     break;	
      case '2009-2010':
	     document.getElementById('year<?php echo $count; ?>').value='2009';
	     break;
      case '2010-2011':
	     document.getElementById('year<?php echo $count; ?>').value='2010';
	     break;	  
      case '2011-2012':
	     document.getElementById('year<?php echo $count; ?>').value='2011';
	     break;	  
      case '2012-2013':
	     document.getElementById('year<?php echo $count; ?>').value='2012';
	     break;	  
      case '2013-2014':
	     document.getElementById('year<?php echo $count; ?>').value='2013';
	     break;	
      case '2014-2015':
	     document.getElementById('year<?php echo $count; ?>').value='2014';
	     break;
      case '2015-2016':
	     document.getElementById('year<?php echo $count; ?>').value='2015';
	     break;	 
      case '2016-2017':
	     document.getElementById('year<?php echo $count; ?>').value='2016';
	     break;	  
      case '2017-2018':
	     document.getElementById('year<?php echo $count; ?>').value='2017';
	     break;	  
      case '2018-2019':
	     document.getElementById('year<?php echo $count; ?>').value='2018';
	     break;	  
      case '2019-2020':
	     document.getElementById('year<?php echo $count; ?>').value='2019';
	     break;	  
      case '2020-2021':
	     document.getElementById('year<?php echo $count; ?>').value='2020';
	     break;	  
      case '2021-2022':
	     document.getElementById('year<?php echo $count; ?>').value='2021';
	     break;	  
      case '2022-2023':
	     document.getElementById('year<?php echo $count; ?>').value='2022';
	     break;	  
      case '2023-2024':
	     document.getElementById('year<?php echo $count; ?>').value='2023';
	     break;	  
      case '2024-2025':
	     document.getElementById('year<?php echo $count; ?>').value='2024';
	     break;	  
      
	  default:
	     document.getElementById('year<?php echo $count; ?>').value='<?php echo date("Y"); ?>';
	}	 
}
*/

//-->
</script>
<script src="semesterwisesubjectassaign.js" type="text/javascript"></script>
<script type="text/javascript">
function checkArray(form,arrayName)
{
   var retval=new Array();
   for(var i=0;i<form.elements.length;i++){
       var el=form.elements[i];
	   if(el.type=="checkbox"&&el.name==arrayName&&el.checked){
	      retval.push(el.value);
	   }
   }
   return retval;
}
function checkForm4(form)
{
   var itemsChecked=checkArray(form,"crid[]");
   //alert("You selected "+itemsChecked.length+" items");
   if(itemsChecked.length==0){
      alert("You have to select at least one item");
	  //itemsChecked.length.focus();
      return false;
      //alert("The items selected were:\n\t"+itemsChecked);
   }
   return true;
}
</script>
<script language="javascript">
 $(document).ready(function(){
    $('.submit1').click(function(){
	  var fid=$(this).attr('id');
	  var arr=$('#MyForm'+fid).serializeArray();
	  $.post('datac.php?count='+fid,arr,function(result){
	    $('#MyResult'+fid).html(result);
	     
	  });
	    $('#MyResult'+fid).hide().fadeIn('slow');
	});
	
 });
</script>

<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
           
<form name="MyForm<?php echo $count; ?>" id="MyForm<?php echo $count; ?>" autocomplete="off"  method="post">           <tr>
             <td height="30" bgcolor="#D9F0FB" class="style15"><span class="style2">Faculty Name :<span class="stars">*</span> </span></td>
             <td height="30" colspan="2" bgcolor="#D9F0FB" class="style15"><select name="facultyid" id="facultyid" onkeypress="return handleEnter(this, event)">
               <option>Select Faculty</option>
               <?php $hq=$myDb->select("select id,name from tbl_faculty Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
               <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
               <?php } ?>
             </select></td>
             <td height="30" colspan="2" bgcolor="#D9F0FB" class="style15">&nbsp;</td>
           </tr>
           <tr bgcolor="#F4F4FF">
             <td width="30%" height="30" class="style15">Department</td>
             <td width="13%" class="style15">Year</td>
             <td width="13%" height="30" class="style15">Section</td>
             <td height="30" colspan="2" class="style15">Session</td>
           </tr><tr>
             <td><label><input type="hidden" name="semester" id="semester" value="<?php echo $stdr['id']; ?>" />
               <select name="department" id="department" style="font-family: Verdana; font-size: 8pt;padding:3px; width:320px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="-1" selected="selected">Select Department</option>
                <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
				while($cfetch=mysql_fetch_array($cat)){
	 			?>
                <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                <?php } ?>
              </select>
             </label></td>
             <td><input name="year" type="text" id="year" size="7" style="width:50px;font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" value="<?php echo date("Y"); ?>" onKeyPress="return handleEnter(this, event)"  /></td>
             <td><label><span class="style4">
               <select name="section" id="section" style="font-family: Verdana; width:50px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="C">C</option>
                 <option value="D">D</option>
                 <option value="E">E</option>
               </select>
             </span>
             </label></td>
             <td width="15%"><label>
               <select name="session" id="session<?php echo $count; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected<?php echo $count; ?>();">
                <option value="">Select session</option>
				<option value="0506">2005-2006</option>
				<option value="0607">2006-2007</option>
				<option value="0708">2007-2008</option>
				<option value="0809">2008-2009</option>
				<option value="0910">2009-2010</option>
				<option value="1011">2010-2011</option>
				<option value="1112">2011-2012</option>
				<option value="1213">2012-2013</option>
				<option value="1314">2013-2014</option>
				<option value="1415">2014-2015</option>
				<option value="1516">2015-2016</option>
				<option value="1617">2016-2017</option>
				<option value="1718">2017-2018</option>
				<option value="1819">2018-2019</option>
				<option value="1920">2019-2020</option>
				<option value="2021">2020-2021</option>
				<option value="2122">2021-2022</option>
				<option value="2223">2022-2023</option>
				<option value="2324">2023-2024</option>
				<option value="2425">2024-2025</option>
              </select>
             </label></td>
             <td width="22%"><label>
               <input type="button" class="submit1" id="<?php echo $count; ?>"  value="Next" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
             </label></td>
           </tr>
           <tr>
             <td colspan="5"> 

			 <div id="MyResult<?php echo $count; ?>" align="center">
  </div></td>
           </tr>		   </form>

         </table>