<?php
require './includes/dbcs.php';
require_once '../classes/class.Constants.php';
require_once '../classes/class.dbc.php';
require_once '../classes/class.Employee.php';

$ms=$_GET['matricule'];

$emp = new Employee($ms);

?>
 <HTML>
 <HEAD>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>


<style>
body {size:A4 portrait;
        margin: 5px;
        padding: 0;
        font: 25pt;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 750px;
        min-height: 77.7cm;
        padding: 2cm;
        margin: 1cm auto;
        background: white;
    }
    .subpage {
        padding: 1cm;
        border: 2px black solid;
        height: 325mm;
        outline: 2cm #000 solid;
    }

    @page {
        size: A4 portrait ;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }



th.rotate {
  /* Something you can count on */
  height: 150px;
  white-space: nowrap;
  padding:1px;
}

th.rotate > div {
	font-weight:normal;
  transform:
    /* Magic Numbers */
    translate(2px, 51px)
    /* 45 is really 360 - 45 */
    rotate(270deg);font-family:calibri;
  width: 24px;
}
th.rotate > div > span {
  border-bottom: 1px solid #000;
margin-left:-40px;
  margin-top:-10px;font-family:calibri;
}
</style>

		</HEAD>
		<BODY >

<?php

$year=date("Y");
$querys="select * from employees where matricule='$ms'
";
$results=mysql_query($querys);
		 while ($row = mysql_fetch_array($results)) {

  $ms=$row["fname"];
		 ?> <div class="page" >
		 <div style="float:left; MARGIN-LEFT:-40PX;">

		 <div style="float:left; width:750px;MARGIN-TOP:-50PX;FONT-SIZE:25PX;FONT-WEIGHT:BOLD; height:40px; padding:5px; text-align:center;"><U>EMPLOYEE BIODATA</U></div>


		  <div style="float:left; margin-top:10px;width:737px; BORDER:1px solid #000;FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:35px; padding:5px; background:#efefef;">

		  <table cellspacing="0" cellpadding="0" width="750px">
		  <tr><td>Employee ID</td><td><b><?php echo $rollg=$row["matricule"];?></b></td>

		  <td>&nbsp;</td><td>Employee Name:</td><td><b><?php echo $row["fname"];
		  $id= $row["schoolid"];
		  $contact= $row["contact"];$religion= $row["religion"];
		  $email= $row["email"];
          $sex= $row["sex"];$origin= $row["origin"];
          $married=$row["married"];


		  $position= $row["position"];$hqual= $row["hqual"];$sac= $row["sac"];

		  $ability= $row["workp"];$next_of_kin= $row["next_of_kin"];
          $entry= $row["entry_year"];

          /** FOR SALARIES  **/
          // $salary= $row["salary"];
		  // $special= $row["special"];
          // $supp= $row["supp"];
          // $other= $row["other"];
          // $allowa= $row["allowa"];
          //
		  $children= $row["children"];
		  $achildren= $row["dependent"];

		   $adopted= $row["achildren"];









		  ?></b></td>








		  </tr></table>
		  </div>

		  <div style="float:left; margin-top:3px;width:737px;
		  BORDER:1px solid #000;FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:210px; padding:5px;
		 ">
		  <div style="float:left; width:250px;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:208px; margin-top:-5px; margin-left:-5px;
		 ">
		  <?php

// 			$rfggg = "select id as total
// from emplopic where empname='$rollg'  ";
// $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  $savep4=$row['total'];
// 				 $mxx=$rec['empname'];

                 ?>
					<td width="200">

					<?php
$roll=$emp->matricule;
$query="select * from employees where matricule='$rollg'";
$result=mysql_query($query);
		 while ($row = mysql_fetch_array($result)) {



?>
					<img src="<?php echo $emp->avatar;?>" width="250px" height="205p">
					</td>
					<td>
		 <?php } ?>
</div>









		   <div style="float:left; width:470px;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:205px; margin-top:-5px; margin-left:5px;
		 ">


		  <table width="500px" cellspacing="0" cellpadding="3" style='font-family:times;'>
		  <tr><td> School/Unit</td><td>:</td><td><b><?php
 echo $emp->school;
 ?></b>
 </td></tr>

 		  <tr><td> Contact </td><td>:</td><td> <?php echo $contact;?>


 </td></tr>

 <tr><td> E-Mail </td><td>:</td><td> <?php if(empty($email)){

	 echo "<b style='font-weight:normal; color:#ccc;'>No E-mail</b>";
 } elseif($email>''){
	 echo $email;
 }
	 ?>


 </td></tr>




 		  <tr><td> Place of Birth</td><td>:</td><td>
              <?php
              echo $emp->birthPlace;
	 ?>


 </td></tr>






		    <tr><td> Sex</td><td>:</td><td> <?php if(empty($sex)){

	 echo "<b style='font-weight:normal; color:#ccc;'>No Sex</b>";
 } elseif($sex>="M" && $sex<="M"){
	 echo "Male";
 }elseif($sex>="F" && $sex<="F"){
	 echo "Female";
 }
	 ?>


 </td>
 </tr><tr>

 <td>Region Of Origin</td><td>:</td><td> <?php if(empty($origin)){

	 echo "<b style='font-weight:normal; color:#ccc;'>No Origin</b>";
 } elseif($origin>"" ){
	 echo $origin;
 }
	 ?>


 </td>

 </tr>





		  <tr>

 <td>Marital Status</td><td>:</td><td> <?php
    echo $emp->maritalStatus;
	 ?>


 </td>

 </tr>




		   <tr>

 <td>Religion</td><td>:</td><td style='text-transform:Capitalize;'> <?php echo $religion;?>



 </td>

 </tr>

		  </table>






		   </div>








		   </div>

		   <div style="float:left; width:740px; BORDER-bottom:1px solid #000;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:auto; margin-top:-5px; margin-left:5px;
		 ">


		   <div style="float:left; width:350px;">

		  <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Functions and other Details</i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="300px">


		   <tr><td>Function</td><td>:</td><td>
               <?php
               echo $emp->function;
                ?>
           </td></tr>

		    <tr><td>Qualification</td><td>:</td><td><?php
 echo $emp->qualification; ?></td></tr>
		    <tr><td >Sacramental Status</td><td>:</td><td style='text-transform:uppercase;'><?php
 echo $emp->sacramentalStatus; ?></td></tr>

   <tr><td >Prev. Employment</td><td>:</td><td style='text-transform:uppercase;'><?php
 echo $ability; ;?></td></tr>
		   </table>


		  <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Emergency</i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="300px">


		   <tr><td>Emergency Contact</td><td>:</td><td><?php
 echo $emp->ICEName; ?></td></tr>

		   </table>



		   	  <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Next-of-Kin</i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="300px">


		   <tr><td>Next-of-Kin </td><td>:</td><td><?php
 echo $next_of_kin; ;?></td></tr>

		   </table>









		   </div>




		   <div style="float:left; width:350px;">

		  <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Medals</i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="300px">
		   <?php


$querys="select * from medal where matricule='$rollg'
";
$results=$emp->getMedals();
		 while ($row = mysqli_fetch_array($results)) {
		 ?>

		   <tr><td><?php
 echo $savep4=$row['medal']; ;?></td><td>:</td><td><?php
 echo $savep4=$row['date_issued']; ;?></td></tr>
		 <?php }
		 ?>
		   </table>

		   <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Nationality</i>
		  </div>

		   <table cellspacing="0" cellpadding="1" width="300px">
		   <tr><td>Nationality </td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
 echo $emp->nationality; ?></b></b></td></tr>
 </table>


		   <div style="float:left; margin-top:10px;width:300px;background:#efefef;">
		  <i>Date of Employment</i>
		  </div>

  <table cellspacing="0" cellpadding="1" width="300px">
		   <tr><td> </td><td></td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
 echo $entry; ;?></b></b></td></tr>


 </table>





  <table cellspacing="0" cellpadding="1" width="300px">

 	   <tr><td>Number of Children </td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
 echo $children; ;?></b></b></td></tr>
  <tr><td>Number of dependent</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
 echo $achildren; ;?></b></b></td></tr>
  <tr><td>Number of adopted</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
 echo $adopted; ;?></b></b></td></tr>
 </table>









		   </table>









		   </div>





		   </div>

		    <div style="float:left; width:740px; BORDER-bottom:1px solid #000;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:235px; margin-top:-5px; margin-left:5px;
		 ">

		   <div style="float:left; width:400px;">

		  <div style="float:left; margin-top:10px;width:400px;background:#efefef;">
		  <i>Salary and Benefit</i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="400px">

		    <tr><td> Gross Salary </td><td>:</td><td STYLE='font-weight:normal;'>
                <b STYLE='font-weight:normal'>
                    <?php
                    if(!isset($salary))
                    {
                        $salary = 0;
                    }
                        echo number_format($salary);
                     ?>
                 </b></b></td></tr>

		    <tr><td> CNPS Number</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
;?></b></b></td></tr>


		    <tr><td> Administrative Allowance</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
$rfggg = "select special as total
from salary where matricule='$rollg'  "; $qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);
 $xcsss=$row['total'];

if(empty($xcsss)){
}elseif($xcsss>''){
 echo number_format($xcsss,0);



} ;
;?></b></b></td></tr>


		    <tr><td> Telephone Allowance</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
$rfggg = "select supp as total
from salary where matricule='$rollg'  "; $qry=mysql_query($rfggg ) ;
$row = mysql_fetch_assoc($qry);
    $xcss=$row['total'];

if(empty($xcss)){
}elseif($xcss>''){
 echo number_format($xcss,0);



}
;?></b></b></td></tr>

		   <tr><td> Housing Allowance</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
$rfggg = "select house as total
from salary where matricule='$rollg'  "; $qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);

    $xcs=$row['total'];

if(empty($xcs)){
}elseif($xcs>''){
 echo number_format($xcs,0);



}
 ?></b></b></td></tr>
		    	   <tr><td>Other Allowance</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
$rfggg = "select other as total
from salary where matricule='$rollg'  "; $qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);
 $xc=$row['total'];

if(empty($xc)){
}elseif($xc>''){
 echo number_format($xc,0);



}


 ?></b></b></td></tr>

			  <tr><td>Net Salary</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
$rfggg = "select net as total
from salary where matricule='$rollg'  "; $qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);
$f=$row['total'];
if(empty($f)){
}elseif($f>''){
 echo number_format($f,0);

};?></b></b></td></tr>



		   </table>

		   </div>

		    <div style="float:left; width:320px;margin-left:10px;">

		  <div style="float:left; margin-top:10px;width:320px;background:#efefef;">
		  <i>Leave </i>
		  </div>
		   <br>
		   <table cellspacing="0" cellpadding="1" width="320px">
		   <tr><td>Vocational Limit</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
?></b></b></td></tr>
		     <tr><td>Loan limit</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
			 if(empty($net)){
			 echo "0";
		 }elseif($net>''){

			 echo number_format($ns=(((($net*1)/4))*12));


		 }
?></b></b></td></tr>

				     <tr><td>Loan amount</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
					 $rfggg = "select SUM(amount) as total
from loan where matricule='$rollg'and extra=''  ";
// $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  echo $netss=$row['total'];
//no loan for now
echo '';
?></b></b></td></tr>

				     <tr><td>Loan balance</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
					 $rfggg = "select SUM(amount) as total
from loan where matricule='$rollg'and extra=''  ";
/* no loan for now
$qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);
$nes=$row['total'];
		 $rfggg = "select SUM(loan) as total
from salaryy where matricule='$rollg' and extra=''  "; $qry=mysql_query($rfggg );
$row = mysql_fetch_assoc($qry);
$ness=$row['total'];
echo $fv=($nes-$ness);
*/

echo '';

?></b></b></td></tr>


			   <tr><td>Bepha</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
					 $rfggg = "select SUM(amount) as total
from loan where matricule='$rollg'and extra=''  ";
// $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  echo $netss=$row['total'];

echo '';
?></b></b></td></tr>



			   <tr><td>Employment Type</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
// 					 $rfggg = "select SUM(amount) as total
// from loan where matricule='$rollg'and extra=''  ";
// $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  echo $netss=$row['total'];
echo '';
?></b></b></td></tr>

			  <tr><td>N<sup>o</sup> of permission</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
// 					 $rfggg = "select SUM(amount) as total
// from loan where matricule='$rollg'and extra=''  "; $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  echo $netss=$row['total'];
 echo ' ';
?></b></b></td></tr>







  <tr><td>N<sup>o</sup> of Absences</td><td>:</td><td STYLE='font-weight:normal;'><b STYLE='font-weight:normal'><?php
// 					 $rfggg = "select SUM(amount) as total
// from loan where matricule='$rollg'and extra=''  "; $qry=mysql_query($rfggg );
// $row = mysql_fetch_assoc($qry);
//  echo $netss=$row['total'];
?></b></b></td></tr>









	</table>
		   </div>










		 </div></b>


	   <div style="float:left; width:740px; BORDER-bottom:1px solid #000;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:auto; margin-top:-5px; margin-left:5px;
		 ">

		   <div style="float:left; width:400px;">

		  <div style="float:left; margin-top:10px;width:740px;background:#efefef;">
		  <i>Supporting Ducments</i>
		  </div>
		   <br>
		   <table cellspacing="3" cellpadding="1" width="300px">
		   <?php


$querys="select * from files where matricule='$rollg'
";
$results=mysql_query($querys);
		 while ($row = mysql_fetch_array($results)) {

  // $ms=$row["fname"];
		 ?>

		   <tr><td><?php
 echo $savep4=$row['name']; ;?></td><td><?php
                echo '<strong class="text-success"><i class="fa fa-check"></i></strong>';
                ?></td></tr>
		 <?php }
		 ?>
		   </table>




		 </div>







		 </div>







		    <div style="float:left; width:740px;
		  FONT-SIZE:17PX;FONT-WEIGHT:BOLD; height:25px; margin-top:15px; margin-left:5px;font-weight:normal;font-size:13px; text-align:center;
		 ">
		   <i>This is a system generated report and does not require signature</i>

		    </div>
		 </div>
		 <?php } ?>
