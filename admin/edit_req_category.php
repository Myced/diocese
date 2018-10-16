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
    $categoryName = filter($_POST['category_name']);
    $categoryCode = filter($_POST['category_code']);

    if(empty($categoryName))
    {
        $error = "Category Name field is required";
    }

    if(empty($categoryCode))
    {
        $error = "Category Code is required";
    }

    if(!isset($error))
    {
        // insert into the database
        $query  = "UPDATE `req_categories` SET
                `category_name` = '$categoryName',
                `category_code` = '$categoryCode'
                WHERE `id` = '$id'
        ";

        $result = mysqli_query($dbc, $query)
            or die("could not update function");

        $success = "Category Updated";
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
                          Edit Requisition Category
                      </h2>

                      <div class="row">
                          <div class="col-md-6">
                              <?php
                             $query = "SELECT * FROM `req_categories` WHERE `id` = '$id' ";
                             $result = mysqli_query($dbc, $query)
                                or die("Error");

                            while($row = mysqli_fetch_array($result))
                            {
                                ?>
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label bold">
                                        Category Name:
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text"  name="category_name"  class="form-control"
                                          placeholder="Category Name" required value="<?php echo $row['category_name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label bold">
                                        Category Code:
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text"  name="category_code"  class="form-control"
                                          placeholder="Category Code E.g.67" required value="<?php echo $row['category_code']; ?>">
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
                                  <a href="add_req_category.php" title="Back to add function"
                                  class="btn btn-primary">
                                      Add Requisition Category
                                  </a>

                                  <a href="manage_req_categories.php" title="Back to Manage Functions"
                                  class="btn btn-warning">
                                      Manage Requisition Categories
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
