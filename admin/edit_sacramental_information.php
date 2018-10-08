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
include_once '../classes/class.Employee.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
}
else {
    $matricule = '';
}

//page logic
if(isset($_POST['sacramental_status']))
{

    $sacramentalStatus = filter($_POST['sacramental_status']);
    $maritalStatus = filter($_POST['marital_status']);
    $status = filter($_POST['status']);

    $query = "UPDATE `employees` SET
            `sac` = '$sacramentalStatus',
            `married` = '$maritalStatus',
            `status` = '$status'

            WHERE `matricule` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error");

    $success = "Sacramental Status information Updated";
}


$employee = new Employee($matricule);

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
              <div class="col-md-12">
                  <div class="card-box">
                      <h2 class="page-header">
                          Edit Employee Information
                      </h2>

                      <br>
                      <div class="row">
                          <div class="col-md-7">
                              <h3 class="page-header">
                                  <?php
                                  echo $employee->name . ' (' . $employee->matricule . ')';
                                   ?>
                              </h3>
                          </div>
                      </div>

                      <form class="form-horizontal" action="" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Sacramental Status</h3>

                                  <div class="row">
                                      <div class="col-md-6">

                                          <?php
                                          $sStatus = $employee->sacramentalStatus;
                                          $mStatus = $employee->maritalStatusID;
                                          $status = $employee->personalStatus;
                                           ?>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Sacramental Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="sacramental_status">
                                                      <option value="">--SELECT--</option>
                                                      <option value="Not Baptised" <?php if($sStatus == 'Not Baptised') { echo 'selected'; } ?> >Not Baptised</option>
                                                      <option value="Baptised" <?php if($sStatus == 'Baptised') { echo 'selected'; } ?> >Baptised</option>
                                                      <option value="Communion" <?php if($sStatus == 'Communion') { echo 'selected'; } ?> >Comunion</option>
                                                      <option value="Confirmed" <?php if($sStatus == 'Confirmed') { echo 'selected'; } ?> >Confirmed</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Marital Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="marital_status">
                                                        <option value="">-----</option>
                                                        <option value="1" <?php if($mStatus == '1') { echo 'selected'; }  ?> >Single</a></option>
                                                        <option value="2" <?php if($mStatus == '2') { echo 'selected'; }  ?> >Married</option>
                                                        <option value="3" <?php if($mStatus == '3') { echo 'selected'; }  ?> >Divorced</option>
                                                        <option value="4" <?php if($mStatus == '4') { echo 'selected'; }  ?> >Separated</option>
                                                        <option value="5" <?php if($mStatus == '5') { echo 'selected'; }  ?> >Fiance</option>
                                                        <option value="6" <?php if($mStatus == '6') { echo 'selected'; }  ?> >Widowed</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Personal Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="status">
                                                      <option value="Non Clergy" <?php if($status == 'Non Clergy') { echo 'selected'; }  ?> >Non Clergy</option>
                                                      <option value="Clergy & Religious" <?php if($status == "Clergy & Religious" || $status == 'Clergy &amp; Religious') { echo 'selected'; }  ?> >Clergy & Religious</option>
                                                  </select>
                                              </div>
                                          </div>

                                      </div>

                                      <div class="col-md-6">




                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <button type="submit" name="add" class="btn btn-primary">
                                          <i class="fa fa-save"></i>
                                          Save Changes
                                      </button>
                                  </div>
                              </div>

                          </div>
                          <br>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <a href="edit_profile.php?matricule=<?php echo $matricule; ?>"
                                          class="btn btn-warning">
                                          <i class="fa fa-user"></i>
                                          Edit Profile
                                      </a>

                                      <a href="employee_details.php?matricule=<?php echo $matricule; ?>"
                                          class="btn btn-info">
                                          <i class="fa fa-list-alt"></i>
                                          Employee Details
                                      </a>

                                      <a href="employee_list.php"
                                          class="btn btn-info">
                                          <i class="fa fa-list"></i>
                                          Employee List
                                      </a>
                                  </div>
                              </div>
                          </div>

                      </form>
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
