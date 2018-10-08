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

if(isset($_POST['ice_name']))
{

    $iceName = filter($_POST['ice_name']);
    $iceRelation = filter($_POST['ice_relation']);
    $iceTel1 = filter($_POST['ice_tel1']);
    $iceTel2 = filter($_POST['ice_tel2']);

    $query = "UPDATE `personnel_nok` SET
        `name_ice` = '$iceName', `tel1_ice` = '$iceTel1',
        `tel2_ice` = '$iceTel2', `relation_ice` = '$iceRelation'

        WHERE `employee_id` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error, could not save emergency number");

    $success = "Emergency Contact Updated";
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
                                  echo $employee->name . ' (' . $matricule . ')';
                                   ?>
                              </h3>
                          </div>
                      </div>

                      <form class="form-horizontal" action="" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">In Case of Emergency</h3>

                                  <div class="row">
                                      <div class="col-md-6">

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Person to Contact:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_name" class="form-control"
                                                  placeholder="Name of person " required value="<?php echo $employee->ICEName; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Relationship: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_relation" class="form-control"
                                                  placeholder="Brother" value="<?php echo $employee->ICERelation; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone 1:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_tel1" class="form-control"
                                                  placeholder="" required value="<?php echo $employee->ICETel1 ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone 2:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="ice_tel2" class="form-control"
                                                  placeholder="" value="<?php echo $employee->ICETel2; ?>">
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
