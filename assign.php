<?php
include_once 'temp.php';
?>
<title>Assign a program</title>
<?php
if(isset($_POST['rollnum']))
{

$rollnum=$_POST['rollnum'];
$dcode_dno=$_POST['program'];
$arr=explode("--",$dcode_dno);
$dcode = $arr[0];
$dno = $arr[1];
$yearenr=$_POST['yearenr'];
$result=mysql_query("INSERT INTO ELIGIBILTY(rollnum,dcode,dno,yearenr,Eligible) values('$rollnum','$dcode','$dno','$yearenr','P')",$cn) or die(mysql_error());

}

?>
 <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Assign A Program</h1>
            </div>
        <!-- /.row -->
       </div>
	
  <form role="form" name="form" method="POST" action="assign.php">
  
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
    <label for="program">Degree Program</label>
  
  <select class="form-control" id="program" name='program'>
  <option value="NULL">Degree Program - Department</option>

 <?php  

	 $query=mysql_query("SELECT dno,dcode from PROG_COURSE group by dcode,dno",$cn) or die(mysql_error());
             while($fet = mysql_fetch_array($query)) 
               {
		   $dno = $fet['dno']; 
		   $dcode   = $fet['dcode'];
		   $dname = mysql_query("SELECT name from DEPARTMENT where dno='$dno'",$cn) or die(mysql_error());
                   $degree = mysql_query("SELECT name from DEGREE where dcode='$dcode'",$cn) or die(mysql_error());
                   $fetdname = mysql_fetch_array($dname);
                   $fetdegree = mysql_fetch_array($degree);
		   echo "<option value = '".$dcode."--".$dno."'>".$fetdegree['name']." - ".$fetdname['name']."</option>";
               }
 ?>
</select>  
</div>


  <div class="form-group">
    <label for="year">Year</label>
    <input type="text" class="form-control" id="yearenr" name="yearenr" placeholder="Enter year enrolled">
  </div>
  
  
<button type="submit" class="btn btn-default" onclick="return check()">Submit</button>
</form>


</div>
    <!-- /.container -->
<script>
function check()
{

if($("#rollnum").val()=="NULL" || $("#program").val()=="NULL" || $("#yearenr").val()=="")
{
alert("Field Empty");
return false;
}
else
return true;
}
</script>


