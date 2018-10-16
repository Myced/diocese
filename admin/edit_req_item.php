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

if(isset($_POST['item_code']))
{
    $itemName = filter($_POST['item_name']);
    $itemCode = filter($_POST['item_code']);
    $category = filter($_POST['category']);

    if(empty($itemName))
    {
        $error = "Item Name field is required";
    }

    if(empty($itemCode))
    {
        $error = "Item Code is required";
    }

    if(!isset($error))
    {
        $query = "UPDATE `req_items` SET
            `category_code` = '$category',
            `item_name` = '$itemName',
            `item_code` = '$itemCode'
            WHERE `id` = '$id'
            ";
        $result = mysqli_query($dbc, $query)
            or die("Error");

        $success = "Item Saved";
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
                             $query = "SELECT * FROM `req_items` WHERE `id` = '$id' ";
                             $result = mysqli_query($dbc, $query)
                                or die("Error");

                            while($row = mysqli_fetch_array($result))
                            {
                                ?>
                                <form class="" action="" method="post">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Category : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="category">
                                                <option value="--">--SELECT CATEGORY--</option>
                                                <?php
                                                $query  = "SELECT * FROM `req_categories`";
                                                $resultat = mysqli_query($dbc, $query)
                                                    or die("Error");

                                                while($r = mysqli_fetch_array($resultat))
                                                {
                                                    ?>
                                                <option value="<?php echo $row['category_code']; ?>"
                                                    <?php
                                                    if($r['category_code'] == $r['category_code'])
                                                        echo 'selected';
                                                     ?>
                                                    >
                                                    <?php echo $r['category_name']; ?>
                                                </option>
                                                    <?php
                                                }
                                                 ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Item Name: </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="item_name" class="form-control"
                                            placeholder="Item Name" value="<?php echo $row['item_name']; ?>" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Item Code: </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="item_code" class="form-control"
                                            placeholder="Item Code E.g. 6900123" value="<?php echo $row['item_code']; ?>" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <input type="submit" name="" value="Save Item"
                                            class="btn btn-primary">
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
                                  <a href="add_req_item.php" title="Back to add function"
                                  class="btn btn-primary">
                                      Add Requisition Item
                                  </a>

                                  <a href="manage_req_items.php" title="Back to Manage Functions"
                                  class="btn btn-warning">
                                      Manage Requisition Item
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
