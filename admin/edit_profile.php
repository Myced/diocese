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

$employee = new Employee($matricule);

//then include static html
include_once 'includes/head.php';
 ?>
<!-- enter custom css files needed for this page here  -->
<link rel="stylesheet" href="../assets/css/lib/lightbox.css">

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
              <div class="col-md-4">
                  <div class="box box-primary ">
                   <div class="box-body box-profile">
                    <div class="row text-center prof">
                         <span class="text-center">
                             <a href="<?php echo $employee->avatar; ?>" class="text-center"
                                 data-lightbox="gallery" data-title="Profile Picture">
                                 <img class="profile-user-img  img-circle" src="<?php echo $employee->avatar; ?>"
                                    alt="User profile picture">
                             </a>
                         </span>
                    </div>

                     <h2 class="profile-username text-center"><?php echo $employee->name; ?></h2>
                     <h3 class="profile-username text-center"><?php echo $employee->matricule; ?></h3>

                     <p class="text-muted text-center"></p>

                     <ul class="list-group list-group-unbordered">
                       <li class="list-group-item">
                         <b><?php echo $employee->school; ?></b> </a>
                       </li>
                       <li class="list-group-item">
                         Function: <b><?php echo $employee->function; ?></b> </a>
                       </li>
                       <li class="list-group-item">
                         Employment Date: <b><?php echo $employee->empDate; ?></b>  </a>
                       </li>
                       <li class="list-group-item">
                         Highest Qualification: <b><?php echo $employee->qualification; ?></b>
                       </li>
                     </ul>

                     <a href="edit_profile.php?matricule=<?php echo $matricule; ?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                   </div>
                   <!-- /.box-body -->
               </div>
             <!-- /.box -->

                 <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">About Employee</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <strong><i class="fa fa-envelope-o  margin-r-5"></i> Email </strong>
                            <br>
                            <?php echo $employee->email; ?>
                      <hr>

                      <strong>
                          <i class="fa fa-map-marker margin-r-5"></i>
                          Nationality</strong>
                          <br>
                          <?php echo $employee->nationality; ?>
                      <hr>

                      <strong><i class="fa fa-phone margin-r-5"></i> Telephone</strong>
                      <br>
                      <?php echo $employee->tel; ?>

                      <hr>

                      <strong><i class="fa fa-file-text-o margin-r-5"></i> Medals</strong>

                      <p class="">
                          <?php
                          $results = $employee->getMedals();

                          while($row = mysqli_fetch_array($results))
                          {
                              echo $row['medal'] . ' => ' . $row['date_issued'];
                              echo '<br>';
                          }
                           ?>
                      </p>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- end of the first column -->

                <!-- //next row -->
                <div class="col-md-8">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item list-head">
                                        <span class="head-text">General Information</span>

                                        <span class="pull-right">
                                            <a href="edit_general_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">
                                            Personal Information
                                        </span>

                                        <span class="pull-right">
                                            <a href="edit_personal_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Sacramental Status</span>

                                        <span class="pull-right">
                                            <a href="edit_sacramental_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Family Status</span>

                                        <span class="pull-right">
                                            <a href="edit_family_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Emergency Contact</span>

                                        <span class="pull-right">
                                            <a href="edit_emergency_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">School Information</span>

                                        <span class="pull-right">
                                            <a href="edit_school_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Education Information</span>

                                        <span class="pull-right">
                                            <a href="edit_education_information.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Work Experience</span>

                                        <span class="pull-right">
                                            <a href="edit_work_experience.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>

                                    <li class="list-group-item list-head">
                                        <span class="head-text">Documents</span>

                                        <span class="pull-right">
                                            <a href="edit_documents.php?matricule=<?php echo $matricule; ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </a>
                                        </span>
                                    </li>
                                </ul>
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
<script src="../assets/js/lib/lightbox.js"></script>
 <?php
include_once 'includes/end.php';
  ?>
