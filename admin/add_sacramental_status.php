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
$current = 2;

//page logic
if(isset($_POST['birth_day']))
{
    $matricule = filter($_POST['matricule']);
    $name = filter($_POST['name']);

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

    $query = "INSERT INTO `personnel_id_card`
            (`employee_id`, `id_type`, `id_num`, `place_of_issue`,
                `date_of_issue`, `date_of_expire`
            )

            VALUES
            ('$matricule', 'ID Card', '$idNumber', '$idIssue',
                '$issueDate', '$expDate'
            )
    ";
    $result  = mysqli_query($dbc, $query)
        or die("Could not insert id card");

    $success = "Personnal Information Saved";
}
else {
    $name = "Cedric";
    $matricule = "334-dfj4";
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

                      <form class="form-horizontal" action="add_family_status.php" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Sacramental Status</h3>

                                  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>">
                                  <input type="hidden" name="name" value="<?php echo $name; ?>">

                                  <div class="row">
                                      <div class="col-md-6">

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Sacramental Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="sacramental_status">
                                                      <option value="">--SELECT--</option>
                                                      <option value="Not Baptised">Not Baptised</option>
                                                      <option value="Baptised">Baptised</option>
                                                      <option value="Communion">Comunion</option>
                                                      <option value="Confirmed">Confirmed</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Marital Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="marital_status">
                                                        <option value="">-----</option>
                                                        <option value="1">Single</a></option>
                                                        <option value="2">Married</option>
                                                        <option value="3">Divorced</option>
                                                        <option value="4">Separated</option>
                                                        <option value="5">Fiance</option>
                                                        <option value="6">Widowed</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Personal Status: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="status">
                                                      <option value="Non Clergy">Non Clergy</option>
                                                      <option value="Clergy & Religious">Clergy and Religious</option>
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
