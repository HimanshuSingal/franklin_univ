<?php
include_once 'temp.php';
if(isset($_POST['rollnum']))
{
	     $roll = $_POST['rollnum'];
	     $query1=mysql_query("SELECT * FROM ELIGIBILTY where rollnum='$roll'",$cn) or die(mysql_error());
            $c=0;
	     while($fet1 = mysql_fetch_array($query1))
               {
			$dno = $fet1['dno'];
			$dcode=$fet1['dcode'];
			$e=1;
			$query2=mysql_query("SELECT ccode FROM PROG_COURSE where dno='$dno' and dcode='$dcode'",$cn) or die(mysql_error());
                        while($fet2 = mysql_fetch_array($query2))
			{
				$ccode=$fet2['ccode'];
				$query3=mysql_query("SELECT grade FROM GRADE where ccode='$ccode' and rollnum='$roll'",$cn) or die(mysql_error());
				if(mysql_num_rows($query3)!=0)
				{
					$fet3 = mysql_fetch_array($query3);
					if($fet3['grade'] == 'F' || $fet3['grade'] == 'P')
						{$e=0;break;}
						
				}
				else
				{	
				$e=0;break;}
                        
			}
	
			if($e)
			{
				$deptquery=mysql_query("SELECT name FROM DEPARTMENT where dno='$dno'",$cn) or die(mysql_error());
				$degreequery=mysql_query("SELECT name FROM DEGREE where dcode='$dcode'",$cn) or die(mysql_error());
                		$deptfet = mysql_fetch_array($deptquery);
				$degreefet=mysql_fetch_array($degreequery);                		
		if($c==0)
{
echo "<div class='container'>
	<div class='row'> 
		<div class='col-lg-12 text-left'>
                <h3>Eligible for the following:-</h3>
                
            ";
}
echo "<p><span class='glyphicon glyphicon-ok'></span>".$degreefet['name']." in ".$deptfet['name']."</p>";
				$c=$c+1;
			}               
        echo "</div></div>";        
	 }
if($c==0)
{
echo "<div class='container'>
	<div class='row'> 
		<div class='col-lg-12 text-left'>
                <h3>Not Eligible for any Degree</h3>
                </div></div>
            ";

} 
}
else
{
?>
<title>Qualify</title>
 <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Qualify</h1>
            </div>
        <!-- /.row -->
       </div>
	
  <form role="form" name="form" method="POST" action="qualify.php">
  
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
  <div class="form-group">
<button type="submit" class="btn btn-default">Submit</button>
</div>
</form>


</div>
    <!-- /.container -->
<?php
}
?>
