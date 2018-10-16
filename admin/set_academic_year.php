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

//if form is posted then update the year
if(isset($_POST['year']))
{
    $year = filter($_POST['year']);

    //update the year
    Constants::setAcademicYear($dbc, $year);
    $success = "Academic Year set";
}

//get the academic year
$year = Constants::getAcademicYear($dbc);

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
                          Set Current Academic Year
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <form class="" action="" method="post">
                                  <div class="row">
                                      <div class="col-md-3">

                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Current Academic Year: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="year" class="form-control"
                                                  placeholder="Academic Year" value="<?php echo $year; ?>"
                                                 >
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label"></label>
                                              <div class="col-sm-8">
                                                  <input type="submit" name="save" value="Update Year"
                                                  class="btn btn-primary">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
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
