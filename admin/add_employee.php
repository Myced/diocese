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
$current = 0;

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

                      <form class="form-horizontal" action="add_personnal_information.php" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">General Information</h3>

                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label bold">Title:</label>
                                              <div class="col-sm-8">
                                                  <select name="prefix" id="prefix" class="form-control">
                                                    <option value="--">----</option>
                                                    <option value="Mr"> Mr. </option>
                                                    <option value="Mrs"> Mrs. </option>
                                                    <option value="Miss"> Miss </option>
                                                    <option value="Dr"> Dr. </option>
                                                    <option value="Msgr. "> Msgr. </option>
                                                    <option value="Prof. "> Prof. </option>
                                                    <option value="Rev. Br."> Rev. Br. </option>
                                                    <option value="Rev. Fr."> Rev. Fr. </option>
                                                    <option value="Rev. Sr."> Rev. Sr. </option>
                                                    <option value="other"> Other </option>
                                                </select>
                                              </div>
                                          </div>

                                          <div class="form-group row hide" id="prefixField">
                                              <label for="" class="col-sm-4 col-form-label"></label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="other" value=""
                                                  class="form-control" placeholder="Other Title">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  First Name:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="fname" required
                                                  class="form-control" placeholder="First Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Middle Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="mname"
                                                  class="form-control" placeholder="Middle Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Last Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="lname"
                                                  class="form-control" placeholder="Last Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Other Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="oname"
                                                  class="form-control" placeholder="">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Sex:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="sex" required>
                                                      <option value="M">Male</option>
                                                      <option value="F">Female</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="tel" required
                                                  class="form-control" placeholder="677 895 895">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Email: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="email" value=""
                                                  class="form-control" placeholder="Email">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Nationality: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="nationality">
                                                      <option value="Cameroonian">Cameroonian</option>
                                                      <option value="Nigerian">Nigerian</option>
                                                      <option value="other">Other</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Employment Date:</label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-3">
                                                          <select class="form-control" name="emp_day">
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

                                                      <div class="col-md-5">
                                                          <select class="form-control" name="emp_month">
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
                                                          <select class="form-control" name="emp_year">
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#prefix").click(function(){

            //Get the selected value and check what it contains
            $select = $("#prefix option:selected").val();

            if($select == "other")
            {
                //show the box for other prefix
                if($("#prefixField").hasClass("hide"))
                {
                    $("#prefixField").removeClass("hide");
                }
                $("#prefixField").addClass("show");
            }
            else
            {
                if($("#prefixField").hasClass("show"))
                {
                    //Remove the other form field
                    $("#prefixField").removeClass("show");
                }
                $("#prefixField").addClass("hide");
            }
        });
    })
</script>
 <?php
include_once 'includes/end.php';
  ?>
