<?php
/**
This file is a sample file that will be used to build all other
pages in this application.
**/

//start by including the scripts required for this page
include_once '../classes/class.Company.php';
include_once '../classes/class.dbc.php';
include_once '../classes/functions.php'; //contains our filter function and other functions
include_once '../classes/day.php'; //contains values for current day, month and year
include_once '../classes/class.AccountStatus.php';
include_once '../classes/class.User.php'; //instantiates a user object;
include_once '../classes/class.UserLevel.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

/**
To show an error, just put the error message in a variable $error
Same goes too for a success message ($success)
=> eg $error = "Could not log in user"
    $success = "You activated your account";
**/

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->

 <?php
include_once 'includes/top_bar.php'; //for the page title and logo and account information
include_once 'includes/navigation.php'; //page navigations.

  ?>

  <div class="wrapper">
      <div class="container-fluid">

          <?php
          //show errors here
          include_once '../classes/notifications.php';
           ?>

           <!-- Page-Title -->
           <div class="row">
               <div class="col-sm-12">
                   <div class="page-title-box">
                       <div class="btn-group pull-right">
                       </div>
                       <h4 class="page-title">St Regina Muyuka</h4>
                   </div>
               </div>
           </div>
           <!-- end page title end breadcrumb -->

          <div class="row">
              <div class="col-md-12">
                  <div class="card-box">
                      <h2 class="page-header">
                          Page Heading
                      </h2>
                  </div>
              </div>
          </div>

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
