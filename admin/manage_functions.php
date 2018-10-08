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

if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
    $action = filter($_GET['action']);

    if($action == "del")
    {
        //delete the school
        $query = "DELETE FROM `functions` WHERE `id` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Could not delete school");

        $success = "Function Deleted";
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
                          Functions
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table responsive">
                                  <table class="table table-hover table-bordered table-striped">
                                      <tr>
                                          <th>S/N</th>
                                          <th>Function </th>
                                          <th>Actions</th>
                                      </tr>

                                      <?php
                                      $count = 1;
                                      $query = "SELECT * FROM `functions` ORDER BY function ";
                                      $result = mysqli_query($dbc, $query)
                                        or die("Error");

                                        if(mysqli_num_rows($result) == 0)
                                        {
                                            ?>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <strong class="text-primary">No Functions yet</strong>
                                            </td>
                                        </tr>
                                            <?php
                                        }
                                        else
                                        {
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['function']; ?></td>
                                                <td>
                                                    <a href="edit_function.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-primary"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </a>

                                                    <a href="#" class="btn btn-xs btn-danger delete"
                                                        data-id1="<?php echo $row['id']; ?>">
                                                        <i class="fa fa-trash"></i>
                                                        Del
                                                    </a>
                                                </td>
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
         var url = "manage_functions.php?action=del&id=";

         $(".delete").click(function(){
             var data = $(this).data("id1");
             url += data;
             if(confirm("Do you want to delete this function ?"))
             {
                 window.location.href=url;
             }
         });
     });
 </script>
 <?php
include_once 'includes/end.php';
  ?>
