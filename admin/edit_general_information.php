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

//calculate progress bar completion
$total = 9; // ther are nine sections to fill
$current = 0;

//calculate percentage
$percentage = ceil( ($current / $total) * 100 );

//edit here
if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
}
else {
    $matricule = '';
}

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

    //save to the database
    $query = "UPDATE  `employees` SET
             `fname` ='$name', `f_name` ='$fname', `m_name` = '$mname',
             `l_name` = '$lname', `o_name` = '$oname',
             `prefix` = '$prefix', `sex` = '$sex', `contact` = '$tel',
             `email` = '$email', `nationality` = '$nationality',
             `entry_day` = '$empDay', `entry_month` = '$empMonth', `entry_year` = '$empYear'

             WHERE `matricule` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error");

    $success = 'General Information Updated';
}

//get the employee details
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
                          Edit Employee
                      </h2>

                      <form class="form-horizontal" action="" method="post">
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
                                                    <option value="Mr" <?php if($employee->prefix == 'Mr') echo 'selected'; ?> > Mr. </option>
                                                    <option value="Mrs" <?php if($employee->prefix == 'Mrs') echo 'selected'; ?> > Mrs. </option>
                                                    <option value="Miss" <?php if($employee->prefix == 'Miss') echo 'selected'; ?> > Miss </option>
                                                    <option value="Dr" <?php if($employee->prefix == 'Dr') echo 'selected'; ?> > Dr. </option>
                                                    <option value="Msgr." <?php if($employee->prefix == 'Msgr') echo 'selected'; ?> > Msgr. </option>
                                                    <option value="Prof." <?php if($employee->prefix == 'prof') echo 'selected'; ?> > Prof. </option>
                                                    <option value="Rev. Br." <?php if($employee->prefix == 'Rev. Br.') echo 'selected'; ?> > Rev. Br. </option>
                                                    <option value="Rev. Fr." <?php if($employee->prefix == 'Rev. Fr.') echo 'selected'; ?> > Rev. Fr. </option>
                                                    <option value="Rev. Sr." <?php if($employee->prefix == 'Rev. Sr') echo 'selected'; ?> > Rev. Sr. </option>
                                                    <option value="other" <?php if($employee->prefix == 'other') echo 'selected'; ?> > Other </option>
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
                                                  <input type="text" name="fname" required value="<?php echo $employee->fname; ?>"
                                                  class="form-control" placeholder="First Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Middle Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="mname" value="<?php echo $employee->mname; ?>"
                                                  class="form-control" placeholder="Middle Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Last Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="lname" value="<?php echo $employee->lname; ?>"
                                                  class="form-control" placeholder="Last Name">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Other Name:
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="oname" value="<?php echo $employee->oname; ?>"
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
                                                      <option value="M" <?php if($employee->sex == 'M') echo 'selected'; ?> >Male</option>
                                                      <option value="F" <?php if($employee->sex == 'F') {echo 'selected';} ?> >Female</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Telephone:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="tel" required value="<?php echo $employee->tel; ?>"
                                                  class="form-control" placeholder="677 895 895">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Email: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="email" value="<?php echo $employee->email; ?>"
                                                  class="form-control" placeholder="Email">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Nationality: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="nationality">
                                                      <option value="Cameroonian" <?php if($employee->nationality == 'Cameroonian') { echo 'selected'; } ?> >Cameroonian</option>
                                                      <option value="Nigerian" <?php if($employee->nationality == 'Nigerian') { echo 'selected'; } ?> >Nigerian</option>
                                                      <option value="other" <?php if($employee->nationality == 'other') { echo 'selected'; } ?> >Other</option>
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
                                                                <?php if($employee->empDay == $i) { echo 'selected'; } ?>    >
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
                                                                <?php if($employee->empMonth == $i) { echo 'selected'; } ?>    >
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
                                                                <?php if($employee->empYear == $i) { echo 'selected'; } ?>    >
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
                                      <button type="submit" name="add_first" class="btn btn-primary">
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
