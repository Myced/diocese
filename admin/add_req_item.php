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

//page app logic
if(isset($_POST['item_name']))
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

    //check that the code has not been use before
    $query = "SELECT `item_name` FROM `req_items`
            WHERE `item_code` = '$itemCode'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error1");

    if(mysqli_num_rows($result) != 0)
    {
        list($name) = mysqli_fetch_array($result);
        $error = "Code $itemCode has already been used for "
                . $name ;
    }

    if(!isset($error))
    {
        $query = "INSERT INTO `req_items`
            (`category_code`, `item_name`, `item_code`)
            VALUES
            ('$category', '$itemName', '$itemCode') ";
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
                          Add  a Requisition Item
                      </h2>

                      <div class="row">
                          <div class="col-md-6">
                            <h3 class="page-header">Enter Item Information </h3>

                            <form class="" action="" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Category : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="category">
                                            <option value="--">--SELECT CATEGORY--</option>
                                            <?php
                                            $query  = "SELECT * FROM `req_categories`";
                                            $result = mysqli_query($dbc, $query)
                                                or die("Error");

                                            while($row = mysqli_fetch_array($result))
                                            {
                                                ?>
                                            <option value="<?php echo $row['category_code']; ?>">
                                                <?php echo $row['category_name']; ?>
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
                                        placeholder="Item Name" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Item Code: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="item_code" class="form-control"
                                        placeholder="Item Code E.g. 6900123" >
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

                          </div>

                          <div class="col-md-6">
                              <h2 class="page-header">Latest Items</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Category</th>
                                            <th>Item Name</th>
                                            <th>Item Code</th>
                                        </tr>

                                        <?php
                                        $count = 1;
                                        $query  = "SELECT * FROM `req_items` LIMIT 8";
                                        $result = mysqli_query($dbc, $query)
                                            or die("Error");

                                        if(mysqli_num_rows($result) == 0)
                                        {
                                            ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <strong class="text-primary">No Requisition Items</strong>
                                            </td>
                                        </tr>
                                            <?php
                                        }
                                        else {
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['category_code']; ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_code']; ?></td>
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

 <?php
include_once 'includes/end.php';
  ?>
