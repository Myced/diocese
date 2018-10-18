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


if(isset($_GET['action']))
{
    //get the id of the item to perform on
    $id = filter($_GET['id']);

    //now perform the action
    $action = filter($_GET['action']);

    if($action == 'del')
    {
        //dele the category
        $query = "DELETE FROM `users` WHERE `user_id` = '$id'";
        $result = mysqli_query($dbc, $query);

        $success = "USER DELETED";
    }
    elseif($action == 'block')
    {
        $sta = AccountStatus::BLOCKED;
        $query = "UPDATE `users` SET `account_status` = '$sta' WHERE `user_id` = '$id'";
        $result = mysqli_query($dbc, $query);

        $success = "User has been banned";
    }
    elseif($action == 'unblock')
    {
        $sta = AccountStatus::ACTIVE;
        $query = "UPDATE `users` SET `account_status` = '$sta' WHERE `user_id` = '$id'";
        $result = mysqli_query($dbc, $query);

        $success = "User has been Unbanned";
    }
    else {
      $warning = "Unkown Action";
    }

}

//get all the users
$query = "SELECT * FROM `users` ";
$result = mysqli_query($dbc, $query);

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
                          Manage User Accounts
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">
                                  <table class="table table-stripped table-info table-hover table-bordered">
                                      <tr class="bg-success">
                                          <th> S/N </th>
                                          <th> Avatar</th>
                                          <th> User ID </th>
                                          <th> Username</th>
                                          <th> Position </th>
                                          <th> Full Name </th>
                                          <th> Contact </th>
                                          <th> Status </th>
                                          <th> Action </th>
                                      </tr>

                                        <?php
                                        $count = 1;
                                        //fetch all the restaurants.
                                        $result = mysqli_query($dbc, $query);

                                        while($row = mysqli_fetch_array($result))
                                        {
                                          $status = $row['account_status'];
                                        ?>
                                          <tr>
                                              <td> <?php echo $count++; ?> </td>

                                              <td>
                                                  <?php
                                                      if(empty($row['avatar']))
                                                      {
                                                          ?>
                                                          <img src="../<?php echo Constants::DEFAULT_AVATAR; ?>" width='60' height='60' class="img-circle">
                                                          <?php
                                                      }
                                                      else {
                                                        ?>
                                                        <img src="../<?php echo $row['avatar']; ?>" width='60' height='60' class="img-circle">
                                                        <?php
                                                      }
                                                   ?>
                                              </td>
                                              <td>
                                                  <?php echo $row['user_id']; ?>
                                              </td>

                                              <td>
                                                  <?php echo $row['username']; ?>
                                              </td>

                                              <td>
                                                  <?php
                                                    echo UserLevel::getUserLevel($row['level']);
                                                   ?>
                                              </td>

                                              <td>
                                                  <?php echo $row['full_name']; ?>
                                              </td>

                                              <td>
                                                  <?php echo $row['tel']; ?>
                                              </td>

                                              <td>
                                                <?php
                                                if($status == AccountStatus::BLOCKED)
                                                {
                                                  ?>
                                                    <span class="badge badge-danger">
                                                        Banned
                                                    </span>
                                                  <?php

                                                    }
                                                    elseif ($status == AccountStatus::SUSPENDED) {
                                                        ?>
                                                          <span class="badge badge-danger">
                                                              Suspended
                                                          </span>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                      ?>
                                                      <span class="badge badge-success">
                                                          Active
                                                      </span>
                                                        <?php
                                                    }
                                                    ?>
                                              </td>

                                              <td>
                                                  <a href="edit_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-primary btn-xs"
                                                    title="Edit this User">
                                                      <i class="fa fa-pencil"></i>
                                                  </a>

                                                  <?php
                                                  if($status == AccountStatus::BLOCKED || $status == AccountStatus::SUSPENDED)
                                                  {
                                                      ?>
                                                      <a href="manage_users.php?id=<?php echo $row['user_id']; ?>&action=unblock" class="btn btn-success btn-xs"
                                                          title="UnBan User">
                                                          <i class="fa fa-check"></i>
                                                      </a>
                                                      <?php
                                                  }
                                                  else {
                                                    ?>
                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['user_id']; ?>&action=block"
                                                       class="btn btn-warning btn-xs"
                                                        title="Ban This User">
                                                        <i class="fa fa-ban"></i>
                                                    </a>
                                                    <?php
                                                  }
                                                   ?>
                                                   <a href="reset_password.php?id=<?php echo $row['user_id']; ?>&action=reset" class="btn btn-info btn-xs"
                                                       title="Reset Password">
                                                       <i class="fa fa-key"></i>
                                                   </a>
                                                  <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['user_id']; ?>&action=del" class="btn btn-danger btn-xs"
                                                      title="Delete this User">
                                                      <i class="fa fa-trash"></i>
                                                  </a>


                                              </td>
                                          </tr>
                                        <?php
                                        }
                                        ?>
                                        </table>
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
