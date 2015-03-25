<?php
include_once 'temp.php';
if(isset($_POST['roll']))
{
//echo "<script>alert('sd')</script>";
$roll = $_POST['roll'];
$ccode = $_POST['course'];
$grade = $_POST['grade'];
$session = $_POST['session'];
$result=mysql_query("update GRADE set grade='$grade' where rollnum='$roll' and ccode='$ccode' and session='$session'",$cn) or die(mysql_error());
}
if(!isset($_POST['rollnum']))
{
   header('Location: grade.php');
}
else
{
?>
<title>Grade</title>
 <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Grade</h1>
            </div>
        <!-- /.row -->
       </div>
	
  <form role="form" name="form" method="POST" action="grade2.php">
  
 <div class="form-group">
    <label for="roll">Roll Number</label>
    <input type="text" class="form-control" id="roll" name='roll' value="<?php echo $_POST['rollnum']?>" readonly>
  </div>
<div class="form-group">
    <label for="session">Session</label>
    <input type="text" class="form-control" id="session" name='session' value="<?php echo $_POST['session']?>" readonly>
  </div>

<div class="form-group">
    <label for="course">Courses</label>
  
  <select  class="form-control" id="course" name='course'>
<option value="NULL">Select Course</option>
 <?php  
	$roll = $_POST['rollnum'];
	$session=$_POST['session'];
	 $query=mysql_query("SELECT ccode FROM GRADE where rollnum='$roll' and session='$session' order by ccode ",$cn) or die(mysql_error());

             while($fet = mysql_fetch_array($query))
               {
		   $ccode=$fet['ccode'];
		   $course = mysql_query("SELECT name from COURSES where ccode='$ccode'",$cn) or die(mysql_error());
                   $fetcourse = mysql_fetch_array($course);
		   echo "<option value = '".$fet['ccode']."'>".$fet['ccode']." ".$fetcourse['name']."</option>";
               }
 ?>
</select>  
</div>

<div class="form-group">
    <label for="grade">Grade</label>
  
  <select  class="form-control" id="grade" name='grade'>
<option value="NULL">Select Grade</option>
<option value="O">O</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="E">E</option>
<option value="F">F</option>
 
</select>  
</div>

    
<button type="submit" class="btn btn-default" onclick="return check()">Submit</button>
</form>


</div>
    <!-- /.container -->
<?php
}
?>
<script>
function check()
{

if($("#grade").val()=="NULL" || $("#course").val()=="NULL")
{
alert("Field Empty");
return false;
}
else
return true;
}
</script>




