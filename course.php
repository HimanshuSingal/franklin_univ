<?php
include_once 'temp.php';
?>
<title>Course</title>
<?php
if(isset($_POST['rollnum']))
{

$rollnum=$_POST['rollnum'];
$ccode=$_POST['course'];
$session=$_POST['session'];
$result=mysql_query("INSERT INTO GRADE(rollnum,ccode,session,grade) values('$rollnum','$ccode','$session','P')",$cn) or die(mysql_error());

}

?>
 <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Choose a Course</h1>
            </div>
        <!-- /.row -->
       </div>
	
  <form role="form" name="form" method="POST" action="course.php">
  
  <div class="form-group">
    <label for="rollnum">Student</label>
  
  <select  class="form-control" id="rollnum" name='rollnum'>
<option value="NULL">Name/Roll Number</option>
 <?php  
	 $query=mysql_query("SELECT fname,lname,rollnum FROM STUDENT order by fname,lname",$cn) or die(mysql_error());
             while($fet = mysql_fetch_array($query))
               {
                   echo "<option value = '".$fet['rollnum']."'>".$fet['fname']." ".$fet['lname']."/".$fet['rollnum']."</option>";
               }
 ?>
</select>  
</div>

  <div class="form-group">
    <label for="course">Course</label>
  
  <select class="form-control" id="course" name='course'>
  <option value="NULL">Choose Course</option>

 <?php  

	$query=mysql_query("SELECT dno,ccode from PROG_COURSE group by dno,ccode",$cn) or die(mysql_error());
        $temp="";
	$i=1;     
	while($fet = mysql_fetch_array($query)) 
               {
		   $dno = $fet['dno']; 
		   $ccode   = $fet['ccode'];
		   $dname = mysql_query("SELECT name from DEPARTMENT where dno='$dno'",$cn) or die(mysql_error());
                   $course = mysql_query("SELECT name from COURSES where ccode='$ccode'",$cn) or die(mysql_error());
                   $fetdname = mysql_fetch_array($dname);
                   $fetcourse = mysql_fetch_array($course);
		   if($temp != $dno && $i==1)
			echo "<optgroup label='".$fetdname['name']."'>";
		   else
		   {
			echo "</optgroup";
			echo "<optgroup label='".$fetdname['name']."'>";
		   }		
		
		   echo "<option value = '".$ccode."'>".$ccode." ".$fetcourse['name']."</option>";
		   $temp=$dno;               
		}
 ?>
</select>  
</div>


  <div class="form-group">
    <label for="session">Session</label>
    <input type="text" class="form-control" id="session" name="session" placeholder="Enter session">
  </div>
  
  
<button type="submit" class="btn btn-default" onclick="return check()">Submit</button>
</form>


</div>
    <!-- /.container -->

<script>
function check()
{

if($("#rollnum").val()=="NULL" || $("#course").val()=="NULL" || $("#session").val()=="")
{
alert("Field Empty");
return false;
}
else
return true;
}
</script>



