<?php
/**
This file is a sample file that will be used to build all other
pages in this application.
@param new for new
**/

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

//calculate progress bar completion
$total = 9; // ther are nine sections to fill
$current = 4;

//page logic
if(isset($_POST['children']))
{
    $matricule = filter($_POST['matricule']);
    $name = filter($_POST['name']);

    $children = filter($_POST['children']);
    $dependents = filter($_POST['dependents']);
    $adopted = filter($_POST['adopted']);

    $query = "UPDATE `employees` SET
        `children` = '$children',
        `dependent` = '$dependents',
        `achildren` = '$adopted'
        WHERE `matricule` = '$matricule';
    ";
    $result = mysqli_query($dbc, $query)
        or die("Error, cannot save information");

    $success = "Family Information saved";
}
else {
    $name = "";
    $matricule = "";
}

//calculate percentage
$percentage = ceil( ($current / $total) * 100 );

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
                          Add New Employee
                      </h2>

                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <p><?php echo $percentage . '%'; ?> Complete</p>
                              <div class="progress active">
                                  <div class="progress-bar progress-bar-primary progress-bar-striped"
                                  role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0"
                                  aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
                                      <span class="sr-only"><?php echo $percentage; ?>% Complete</span>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-7">
                              <h3 class="page-header">
                                  <?php
                                  echo $name . ' (' . $matricule . ')';
                                   ?>
                              </h3>
                          </div>
                      </div>

                      <form class="form-horizontal" action="add_school_information.php" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">In Case of Emergency</h3>

                                  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>">
                                  <input type="hidden" name="name" value="<?php echo $name; ?>">

                                  <div class="row">
                                      <div class="col-md-6">

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Person to Contact:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_name" class="form-control"
                                                  placeholder="Name of person " required>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Relationship: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_relation" class="form-control"
                                                  placeholder="Brother">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone 1:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_tel1" class="form-control"
                                                  placeholder="" required>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone 2:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_tel2" class="form-control"
                                                  placeholder="">
                                              </div>
                                          </div>

                                      </div>

                                      <div class="col-md-6">




                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-9">

                              </div>

                              <div class="col-md3">
                                  <button type="submit" name="add_first" class="btn btn-primary">
                                      Next
                                      <i class="fa fa-chevron-right"></i>
                                  </button>
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
