<?php
//start by including the scripts required for this page
include_once '../classes/class.Company.php';
include_once '../classes/class.dbc.php';
include_once '../classes/functions.php'; //contains our filter function and other functions
include_once '../classes/day.php'; //contains values for current day, month and year
include_once '../classes/class.AccountStatus.php';
include_once '../classes/class.User.php'; //instantiates a user object;
include_once '../classes/class.UserLevel.php';
include_once '../classes/class.Constants.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();


//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->

 <?php
include_once 'includes/top_bar.php'; //for the page title and logo and account information
include_once 'includes/navigation.php'; //page navigations.

  ?>

  <br>
  <div class="wrapper">
      <div class="container-fluid">

          <?php
          //show errors here
          include_once '../classes/notifications.php';
           ?>

           <div class="row">
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-aqua">
                 <div class="inner">
                   <h3>150</h3>

                   <p>New Orders</p>
                 </div>
                 <div class="icon">
                   <i class="fa fa-shopping-cart"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-green">
                 <div class="inner">
                   <h3>53<sup style="font-size: 20px">%</sup></h3>

                   <p>Bounce Rate</p>
                 </div>
                 <div class="icon">
                   <i class="ion ion-stats-bars"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-yellow">
                 <div class="inner">
                   <h3>44</h3>

                   <p>User Registrations</p>
                 </div>
                 <div class="icon">
                   <i class="ion ion-person-add"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-red">
                 <div class="inner">
                   <h3>65</h3>

                   <p>Unique Visitors</p>
                 </div>
                 <div class="icon">
                   <i class="ion ion-pie-graph"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
           </div>
           <!-- /.row -->

      </div> <!-- end container -->
  </div>
  <!-- end wrapper -->

  <?php
include_once 'includes/footer.php';
include_once 'includes/scripts.php';
   ?>
 <!-- enter your custom scripts needed for the page here -->

 <?php
include_once 'includes/end.php';
  ?>
