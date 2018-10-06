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
$current = 1;

function generateMatricule($empYear)
{
    global $dbc;

    $constant = "CES-";
    $year = substr($empYear, 2, 2);
    $p = "-P";

    //get the count of those employed for that year
    $query  = "SELECT * FROM `employees` WHERE `entry_year` = '$empYear' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    $count = mysqli_num_rows($result);

    ++$count;

    if($count < 10)
    {
        $num = '000' . $count;
    }
    elseif($count < 100)
    {
        $num = '00' . $count;
    }
    elseif ($count < 1000) {
        $num = '0' . $count;
    }
    else {
        $num  = $count;
    }

    $matricule = $constant . $year . $p . $num;

    return $matricule;
}

//page logic
if(isset($_POST['prefix']))
{
    //form has been submitted
    $prefix = filter($_POST['prefix']);
    $otherPrefix = filter($_POST['other']);
    $fname = filter($_POST['fname']);
    $mname = filter($_POST['mname']);
    $lname = filter($_POST['lname']);
    $oname = filter($_POST['oname']);
    $sex = filter($_POST['sex']);
    $tel = filter($_POST['tel']);
    $email = filter($_POST['email']);
    $nationality = filter($_POST['nationality']);
    $empDay = filter($_POST['emp_day']);
    $empMonth = filter($_POST['emp_month']);
    $empYear = filter($_POST['emp_year']);

    //derived variables
    $empDate = $empDay . '/' . $empMonth . '/' . $empYear;
    $name = $fname . ' ' . $mname . ' ' . $lname . ' ' . $oname;

    if($prefix == "other")
    {
        $prefix = $otherPrefix;
    }

    $matricule = generateMatricule($empYear);

    //save to the database
    $query = "INSERT INTO `employees`
            (`matricule`, `fname`, `f_name`, `m_name`, `l_name`, `o_name`,
                `prefix`, `sex`, `contact`, `email`, `nationality`,
                `entry_day`, `entry_month`, `entry_year`
            )

            VALUES
            ('$matricule', '$name', '$fname', '$mname', '$lname', '$oname',
                '$prefix', '$sex', '$tel', '$email', '$nationality',
                '$empDay', '$empMonth', '$empYear'
            )
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error saving employee" . mysqli_error($dbc));



    $success = "General Information Saved";
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

                      <form class="form-horizontal" action="add_sacramental_status.php" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Personal Information</h3>

                                  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>">
                                  <input type="hidden" name="name" value="<?php echo $name; ?>">

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
                                                            >
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
                                                            >
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
                                                            >
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
                                                  <input type="text" name="birth_place" value=""
                                                  class="form-control" placeholder="place of birth">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">ID CARD No: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="id_card_no" value=""
                                                  class="form-control" placeholder="ID Card No.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Issued At: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="id_card_issue" value=""
                                                  class="form-control" placeholder="eG. SW 22">
                                              </div>
                                          </div>

                                      </div>

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
                                                            >
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
                                                            >
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
                                                            >
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
                                                            >
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
                                                            >
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
                                                            >
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
                              <div class="col-md-9">

                              </div>

                              <div class="col-md3">
                                  <button type="submit" name="add" class="btn btn-primary">
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
