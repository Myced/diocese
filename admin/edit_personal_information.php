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
if(isset($_POST['birth_day']))
{
    //collect the information
    $birthDay = filter($_POST['birth_day']);
    $birthMonth = filter($_POST['birth_month']);
    $birthYear = filter($_POST['birth_year']);
    $birthPlace = filter($_POST['birth_place']);
    $idNumber = filter($_POST['id_card_no']);
    $idIssue = filter($_POST['id_card_issue']);
    $issueDay = filter($_POST['id_issue_day']);
    $issueMonth = filter($_POST['id_issue_month']);
    $issueYear = filter($_POST['id_issue_year']);
    $expDay = filter($_POST['id_exp_day']);
    $expMonth = filter($_POST['id_exp_month']);
    $expYear = filter($_POST['id_exp_year']);

    //derived elements
    $expDate = $expDay . '/' . $expMonth . '/' . $expYear;
    $issueDate = $issueDay . '/' . $issueMonth . '/' . $issueYear;

    //now query
    $query = "UPDATE `employees`  SET
        `day` = '$birthDay', `month` = '$birthMonth', `year` = '$birthYear',
        `birth_place` = '$birthPlace', `id_issue` = '$idIssue', `idcard` = '$idNumber',
        `date_issue` = '$issueDate', `date_expire` = '$expDate'
        WHERE `matricule` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error" . mysqli_error($dbc));

    $query = "UPDATE `personnel_id_card` SET
            `id_type` = 'ID Card', `id_num` = '$idNumber',
            `place_of_issue` = '$idIssue',
            `date_of_issue` = '$issueDate', `date_of_expire` = '$expDate'

            WHERE  `employee_id` = '$matricule'

    ";
    $result  = mysqli_query($dbc, $query)
        or die("Could not insert id card");

    $success = "Personnal Information Updated";
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
                                  <h3 class="page-header">Personal Information</h3>

                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Date of Birth:</label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-3">
                                                          <select class="form-control" name="birth_day">
                                                              <option value="--">--DAY--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 31; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($employee->birthDay == $i) { echo 'selected'; } ?> >
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-6">
                                                          <select class="form-control" name="birth_month">
                                                              <option value="--">--MONTH--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 12; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($employee->birthMonth == $i) { echo 'selected'; } ?> >
                                                            <?php echo get_month($i); ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-3">
                                                          <select class="form-control" name="birth_year">
                                                              <option value="--">--YEAR--</option>
                                                              <?php

                                                              for ($i = 1970; $i <= date("Y"); $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($employee->birthYear == $i ) { echo 'selected'; }  ?> >
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Place of Birth: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="birth_place" value="<?php echo $employee->birthPlace; ?>"
                                                  class="form-control" placeholder="place of birth">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">ID CARD No: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="id_card_no" value="<?php echo $employee->idNumber; ?>"
                                                  class="form-control" placeholder="ID Card No.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Issued At: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="id_card_issue" value="<?php echo $employee->idIssue; ?>"
                                                  class="form-control" placeholder="eG. SW 22">
                                              </div>
                                          </div>

                                      </div>

                                      <?php
                                      //parse issue date here
                                      $issue = $employee->issueDate;
                                      $days = explode('/', $issue);
                                      $day = $days[0];
                                      $month = $days[1];
                                      $year = $days[2];
                                       ?>

                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Date of Issue:</label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-3">
                                                          <select class="form-control" name="id_issue_day" id="id_issue_day">
                                                              <option value="--">--DAY--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 31; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($day == $i) { echo 'selected'; } ?> >
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-6">
                                                          <select class="form-control" name="id_issue_month" id="id_issue_month">
                                                              <option value="--">--MONTH--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 12; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($month == $i) { echo 'selected'; } ?> >
                                                            <?php echo get_month($i); ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-3">
                                                          <select class="form-control" name="id_issue_year" id="id_issue_year">
                                                              <option value="--">--YEAR--</option>
                                                              <?php

                                                              for ($i = 1970; $i <= date("Y"); $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($year == $i) { echo 'selected'; } ?> >
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <?php
                                          //parse issue date here
                                          $issue = $employee->expireDate;
                                          $days = explode('/', $issue);
                                          $day = $days[0];
                                          $month = $days[1];
                                          $year = $days[2];
                                           ?>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label"> Expiry Date:</label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-3">
                                                          <select class="form-control" name="id_exp_day" id="id_exp_day">
                                                              <option value="--">--DAY--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 31; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                             <?php if($day == $i) { echo 'selected'; } ?> >
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-6">
                                                          <select class="form-control" name="id_exp_month" id="id_exp_month">
                                                              <option value="--">--MONTH--</option>
                                                              <?php
                                                              for ($i = 1; $i <= 12; $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                             <?php if($month == $i) {echo 'selected'; }  ?> >
                                                            <?php echo get_month($i); ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-3">
                                                          <select class="form-control" name="id_exp_year" id="id_exp_year">
                                                              <option value="--">--YEAR--</option>
                                                              <?php

                                                              for ($i = 1970; $i <= date("Y"); $i++)
                                                              {
                                                                  ?>
                                                            <option value="<?php echo $i; ?>"
                                                            <?php if($year == $i ) { echo 'selected'; } ?>>
                                                            <?php echo $i; ?>
                                                            </option>
                                                                  <?php
                                                              }
                                                               ?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

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
