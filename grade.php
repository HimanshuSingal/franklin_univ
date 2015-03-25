<?php
include_once 'temp.php';
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

if($("#rollnum").val()=="NULL" || $("#session").val()=="")
{
alert("Field Empty");
return false;
}
else
return true;
}
</script>




