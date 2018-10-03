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

//page logic
if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
}
else {
    $id = "";
}

if(isset($_POST['update']))
{
    $function = filter($_POST['name']);

    if($function == '')
    {
        $error = "Function cannot be empty";
    }

    if(!isset($error))
    {
        // insert into the database
        $query  = "UPDATE `functions` SET
                `function` = '$function'
                WHERE `id` = '$id'
        ";

        $result = mysqli_query($dbc, $query)
            or die("could not update function");

        $success = "Function Updated";
    }
}

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
                          Edit Function
                      </h2>

                      <div class="row">
                          <div class="col-md-6">
                              <?php
                             $query = "SELECT * FROM `functions` WHERE `id` = '$id' ";
                             $result = mysqli_query($dbc, $query)
                                or die("Error");

                            while($row = mysqli_fetch_array($result))
                            {
                                ?>
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label bold">
                                        Function:
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text"  name="name"  class="form-control"
                                          placeholder="School Accountant" required value="<?php echo $row['function']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label bold"></label>
                                    <div class="col-sm-8">
                                        <input type="submit"  name="update"  class="btn btn-primary" value="Update Function">
                                    </div>
                                </div>
                            </form>
                                <?php
                            }
                               ?>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="text-center">
                                  <a href="add_function.php" title="Back to add function"
                                  class="btn btn-primary">
                                      Add Function
                                  </a>

                                  <a href="manage_functions.php" title="Back to Manage Functions"
                                  class="btn btn-warning">
                                      Manage Functions
                                  </a>
                              </div>
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
