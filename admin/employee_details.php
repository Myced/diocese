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
    $matricule  = filter($_GET['matricule']);
}
else {
    $matricule = '';
}

$employee = new Employee($matricule);
//prepare the employee information


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
              <div class="col-md-12">
                  <h2 class="page-header">
                      Employee Details
                  </h2>
              </div>
          </div>

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

                <!-- start of the second column -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title mt-0 mb-3">GENERAL INFORMATION</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4 right-align">Prefix: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->prefix; ?></dd>

                                            <dt class="col-sm-4 right-align">First Name: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->fname; ?></dd>

                                            <dt class="col-sm-4 right-align">Middle  Name: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->mname; ?></dd>

                                            <dt class="col-sm-4 right-align">Last Name: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->lname; ?></dd>

                                            <dt class="col-sm-4 right-align">Other Name: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->oname; ?></dd>

                                            <dt class="col-sm-4 right-align">Full Name: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->name; ?></dd>

                                            <dt class="col-sm-4 right-align">Sex: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->sex; ?></dd>

                                        </dl>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <dt class="col-sm-4 right-align">Telephone: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->tel; ?></dd>

                                            <dt class="col-sm-4 right-align">Email: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->email; ?></dd>

                                            <dt class="col-sm-4 right-align">Nationality: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->nationality; ?></dd>


                                            <dt class="col-sm-4 right-align">Employment Date: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->empDate; ?></dd>

                                            <dt class="col-sm-4 right-align">Highest Qualification: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->qualification; ?></dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title mt-0 mb-3">PERSONNAL INFOMATION</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4 right-align">Date of Birth: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->birthDate; ?></dd>

                                            <dt class="col-sm-4 right-align">Place of Birth: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->birthPlace; ?></dd>

                                            <dt class="col-sm-4 right-align">ID Card No: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->idNumber; ?></dd>

                                            <dt class="col-sm-4 right-align">Issue: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->idIssue; ?></dd>

                                            <dt class="col-sm-4 right-align">Issued Date: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->issueDate; ?></dd>

                                            <dt class="col-sm-4 right-align">Expiry Date: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->expireDate; ?></dd>
                                        </dl>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <dt class="col-sm-5 right-align">Sacramental Staus: </dt>
                                            <dd class="col-sm-7"><?php echo $employee->sacramentalStatus; ?></dd>

                                            <dt class="col-sm-5 right-align">Marital Staus: </dt>
                                            <dd class="col-sm-7"><?php echo $employee->maritalStatus; ?></dd>

                                            <dt class="col-sm-5 right-align">Personal Staus: </dt>
                                            <dd class="col-sm-7"><?php echo $employee->personalStatus; ?></dd>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <dt class="col-sm-4 right-align">N<sup>o</sup> Children: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->children; ?></dd>

                                            <dt class="col-sm-4 right-align">N<sup>o</sup> Dependents: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->dependents; ?></dd>

                                            <dt class="col-sm-4 right-align">N<sup>o</sup> Adopted: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->adopted; ?></dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row  -->

                    <!-- start of next row  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="page-title mt-0 mb-3">EMERGENCY CONTACT</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4 right-align">Name of Person: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->ICEName; ?></dd>

                                            <dt class="col-sm-4 right-align">Relation: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->ICERelation; ?></dd>

                                            <dt class="col-sm-4 right-align">Telephone 1: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->ICETel1; ?></dd>

                                            <dt class="col-sm-4 right-align">Telephone 2: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->ICETel2; ?></dd>
                                        </dl>

                                    </div>

                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row  -->

                    <!-- start of next row  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="page-title mt-0 mb-3">SCHOOL AND FUNCTION</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4 right-align">School: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->school; ?></dd>

                                            <dt class="col-sm-4 right-align">Function: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->function; ?></dd>

                                            <dt class="col-sm-4 right-align">Area of Competence: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->competence; ?></dd>

                                            <dt class="col-sm-4 right-align">Residence: </dt>
                                            <dd class="col-sm-8"><?php echo $employee->residence; ?></dd>
                                        </dl>

                                    </div>

                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row  -->

                    <!-- start of new row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Medals </h3>
                                </div>

                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>#</th>
                                                <th>Medal</th>
                                                <th>Year Obtained</th>
                                                <th>Status</th>
                                            </tr>

                                            <?php
                                            $medals = $employee->getMedals();
                                            $count = 1;
                                            if(mysqli_num_rows($medals) == 0)
                                            {
                                                ?>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <strong>No Medals</strong>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            else {
                                                while($row = mysqli_fetch_array($medals))
                                                {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['medal']; ?></td>
                                                    <td><?php echo $row['date_issued']; ?></td>
                                                    <td> <i class="fa fa-check text-success"></i> </td>
                                                </tr>
                                                    <?php
                                                }
                                            }
                                             ?>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->

                    <!-- start of new row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Schools Attended </h3>
                                </div>

                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>S/N</th>
                                                <th>School</th>
                                                <th>Certificate</th>
                                                <th>Year</th>
                                            </tr>

                                            <?php
                                            $schools = $employee->getSchoolsAttended();
                                            $count = 1;
                                            if(mysqli_num_rows($schools) == 0)
                                            {
                                                ?>
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <strong>No Schools Attended Information</strong>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            else {
                                                while($row = mysqli_fetch_array($schools))
                                                {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['school']; ?></td>
                                                    <td><?php echo $row['certificate']; ?></td>
                                                    <td><?php echo $row['year']; ?></td>
                                                </tr>
                                                    <?php
                                                }
                                            }
                                             ?>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->

                    <!-- start of new row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Work Experience </h3>
                                </div>

                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Institution</th>
                                                <th>Function</th>
                                                <th>Start Year</th>
                                                <th>End Year</th>
                                            </tr>

                                            <?php
                                            $work = $employee->getWorkExperience();
                                            $count = 1;
                                            if(mysqli_num_rows($work) == 0)
                                            {
                                                ?>
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <strong>No Working Experience Information</strong>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            else {
                                                while($row = mysqli_fetch_array($work))
                                                {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['institution']; ?></td>
                                                    <td><?php echo $row['function']; ?></td>
                                                    <td><?php echo $row['year_start']; ?></td>
                                                    <td><?php echo $row['year_end']; ?></td>
                                                </tr>
                                                    <?php
                                                }
                                            }
                                             ?>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->

                    <!-- start of new row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Documents </h3>
                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <?php
                                        $files = $employee->getFiles();

                                        if(mysqli_num_rows($files) == 0)
                                        {
                                            ?>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h3 class="text-primary">NO Files Uploaded</h3>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                        else {
                                            while($row = mysqli_fetch_array($files))
                                            {
                                                $type = $row['type'];

                                                if($type == 'pdf')
                                                {
                                                    ?>
                                                <div class="col-md-4">
                                                    <a href="<?php echo '../' . $row['location']; ?>" target="_blank">
                                                        <img src="../assets/images/pdf.svg" alt="PDF FILE"
                                                        width="150px" height="150px">

                                                        <h4><?php echo $row['name']; ?></h4>
                                                    </a>
                                                </div>
                                                    <?php
                                                }

                                                elseif($type == 'png' || $type == 'jpg'
                                                        || $type == 'jpeg' || $type == 'gif')
                                                {
                                                    ?>
                                                <div class="col-md-4">
                                                    <a href="<?php echo '../' . $row['location']; ?>" data-lightbox="gallery"
                                                        data-title="<?php echo $row['name']; ?>">
                                                        <img src="<?php echo '../' . $row['location']; ?>" alt="Document"
                                                            width="150px" height="150px">

                                                        <h4><?php echo $row['name']; ?></h4>
                                                    </a>
                                                </div>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                <div class="col-md-4">
                                                    <a href="<?php echo '../' . $row['location']; ?>" target="_blank">
                                                        <img src="../assets/images/doc.svg" alt="PDF FILE"
                                                        width="150px" height="150px">

                                                        <h4><?php echo $row['name']; ?></h4>
                                                    </a>
                                                </div>
                                                    <?php
                                                }
                                            }
                                        }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->

                </div>
                <!-- end of second column -->
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
