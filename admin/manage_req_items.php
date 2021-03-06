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

function getCategory($id)
{
    global $dbc;

    $query = "SELECT `category_name` FROM `req_categories`
            WHERE `category_code` = '$id' ";
    $result = mysqli_query($dbc, $query);

    list($name) = mysqli_fetch_array($result);

    return $name;
}

if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
    $action = filter($_GET['action']);

    if($action == "del")
    {
        //delete the school
        $query = "DELETE FROM `req_items` WHERE `id` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Could not delete cat");

        $success = "Item Deleted";
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
                          Requisition Items
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table responsive">
                                  <table class="table table-hover table-bordered table-striped">
                                      <tr>
                                          <th>S/N</th>
                                          <th>Category Code</th>
                                          <th>Category Name</th>
                                          <th>Item Name </th>
                                          <th>Item  Code</th>
                                          <th>Actions</th>
                                      </tr>

                                      <?php
                                      $count = 1;
                                      $query = "SELECT * FROM `req_items`  ";
                                      $result = mysqli_query($dbc, $query)
                                        or die("Error");

                                        if(mysqli_num_rows($result) == 0)
                                        {
                                            ?>
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <strong class="text-primary">No Items yet</strong>
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
                                                <td><?php echo $row['category_code']; ?></td>
                                                <td><?php echo getCategory($row['category_code']); ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_code']; ?></td>
                                                <td>
                                                    <a href="edit_req_item.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-primary"
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
         var url = "manage_req_items.php?action=del&id=";

         $(".delete").click(function(){
             var data = $(this).data("id1");
             url += data;
             if(confirm("Do you want to delete this item ?"))
             {
                 window.location.href=url;
             }
         });
     });
 </script>
 <?php
include_once 'includes/end.php';
  ?>
