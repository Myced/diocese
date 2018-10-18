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

//page logiv
if(isset($_POST['change']))
{
    //grab the various password fields.
    $old_password = filter($_POST['current_password']);
    $new_password = filter($_POST['new_password']);
    $repeat_password = filter($_POST['repeat_password']);

    $old_hash = password_hash($old_password, PASSWORD_BCRYPT);
    $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

    $user_id = get_user_id();

    if(empty($old_password) || empty($new_password) || empty($repeat_password))
    {
        $error = "You must fill all form fields";
    }

    if(!isset($error))
    {
        //now check if the new password is corrent.
        $query = "SELECT `password` FROM `users` WHERE `user_id` = '$user_id'";
        $result  = mysqli_query($dbc, $query)
                 or die("Could not check the password");

        list($password) = mysqli_fetch_array($result);

        if(password_verify($old_password, $password))
        {
            //then the password are the same
            if($new_password != $repeat_password)
            {
                //error again
                $error = "The new password and the repeated password do not match";
            }
            else
            {
                //update the password.
                $query = "UPDATE `users` SET `password` = '$new_hash'";
                $result = mysqli_query($dbc, $query)
                         or die("Could not change your password");

                $success = "Password Successfully changed";
            }
        }
        else
        {
            $error = "Current Password is not correct";
        }
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
                          Change Your Account Password
                      </h2>

                      <br>
                      <div class="row">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="password" placeholder="Enter Current Password"
                                                    name="current_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="password" placeholder="Enter New Password"
                                                    name="new_password" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="password" placeholder="Repeat the new Password"
                                                    name="repeat_password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button class="btn btn-info btn-block btn-flat" name="change">
                                                <strong> Change Password </strong>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
