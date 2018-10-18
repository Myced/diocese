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


//page application logic here
if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
}
else {
    $error = "Sorry. Password could not be edited";
}

if(isset($_POST['save']))
{
    $password = filter($_POST['new_password']);
    $rpassword = filter($_POST['repeat_password']);

    $hash = password_hash($password, PASSWORD_BCRYPT);

    if($password != $rpassword)
    {
        $error = "Passwords do not match";
    }

    if(!isset($error))
    {
        $query = "UPDATE `users` SET `password` = '$hash'
                    WHERE `user_id` = '$id'";

        //Execute the query now
        $result = mysqli_query($dbc, $query)
                or die("Could not query");

        $success = "Password Changed";
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
                          Reset Account Password
                      </h2>

                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mg-b-0">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input class="form-control" placeholder="Enter New Password" type="text"
                                         name="new_password" required value=""> <br>

                                        <input class="form-control" placeholder="Repeat Password" type="text"
                                         name="repeat_password" value=""> <br>



                                        <input class="btn  btn-success" value="Update Password" type="submit" name="save">
                                        <a href="manage_users.php" class="btn btn-primary">
                                            <i class="fa fa-arrow-left"></i>
                                            Back to Users
                                        </a>
                                    </form>

                                </div><!-- form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="card pd-20">

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                                <?php
                                                //fetch all the restaurants.
                                                $query = "SELECT * FROM `users` WHERE `user_id` = '$id'";
                                                $result = mysqli_query($dbc, $query);

                                                while($row = mysqli_fetch_array($result))
                                                {
                                                ?>

                                                <li class="list-group-item">
                                                    <strong>User Name : </strong> <?php echo $row['username']; ?>
                                                </li>

                                                <li class="list-group-item">
                                                    <strong>Full Name : </strong> <?php echo $row['username']; ?>
                                                </li>

                                                <li class="list-group-item">
                                                    <strong>User ID : </strong> <?php echo $row['user_id']; ?>
                                                </li>

                                                <li class="list-group-item">
                                                    <strong>User Level : </strong> <?php echo UserLevel::getUserLevel($row['level']); ?>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                        </div>
                                    </div>
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
