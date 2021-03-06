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

//function to generate a requisition code
function generateReqCode()
{
    global $dbc;

    $y = date("y");
    $year = date("Y");

    $query = "SELECT * FROM `req_count`
            WHERE `year` = '$year' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    $num  = mysqli_num_rows($result);

    ++$num;

    if($num < 10)
    {
        $numm = '00' . $num;
    }
    elseif($num < 100)
    {
        $numm = '0' . $num;
    }
    else {
        $numm = $num;
    }

    return 'REQ-' . $y . '-' . $numm;
}

//process form here
if(isset($_POST['req_code']))
{
    //get the form fields
    $requestCode  = filter($_POST['req_code']);
    $school = filter($_POST['school']);
    $inputer = filter($_POST['inputer']);
    $authoriser = filter($_POST['authoriser']);
    $month = filter($_POST['month']);

    $amounts = $_POST['amount'];
    $justifications = $_POST['justification'];
    $names  = $_POST['name'];
    $codes = $_POST['code'];

    //now check that the code does not exist.
    //else create a new one
    $query = "SELECT * FROM `req_count` WHERE `req_code` = '$requestCode'";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    if(mysqli_num_rows($result) != 0)
    {
        ///generate a new code
        $requestCode = generateReqCode();
    }

    $end = count($amounts);
    $year = date("Y");

    $itemCount = 0;
    $amountTotal = 0;

    //now loop through all these
    for($i = 1; $i < $end; $i++)
    {
        //get the item
        $justification = filter($justifications[$i]);
        $amount = filter(get_money($amounts[$i]));
        $name = filter($names[$i]);
        $code = filter($codes[$i]);

        //if the amount is not empty then save it
        if(!empty($amount))
        {
            //count
            $itemCount++;
            $amountTotal += $amount;

            //save it
            $query = "INSERT INTO `req_content`
                (`req_code`, `item_code`, `item_name`,
                    `amount`, `justification`
                )

                VALUES
                ('$requestCode', '$code', '$name',
                    '$amount', '$justification'
                )
            ";
            $result = mysqli_query($dbc, $query)
                or die("Error" . mysqli_error($dbc));
        }
    }

    //now save to the count
    $query = "INSERT INTO `req_count`
        (`req_code`, `school`, `inputer`, `authoriser`,
            `month`, `items`, `total`, `year`
        )

        VALUES
        ('$requestCode', '$school', '$inputer', '$authoriser',
            '$month', '$itemCount', '$amountTotal', '$year'
        )
    ";

    $result = mysqli_query($dbc, $query)
        or die("Errpr");

    $success = "Requisition made. You can view and modify it later";
}

$req_code = generateReqCode();

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->
<link rel="stylesheet" href="../assets/css/lib/select2.css">

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
                          Requisition Form
                      </h2>

                      <form class="" action="" method="post">
                          <div class="row">
                              <div class="col-md-2">

                              </div>

                              <div class="col-md-8">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-4 col-form-label bold">
                                          School:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <select class="form-control select2" name="school" required>
                                              <option value=""></option>
                                              <?php
                                              $query  = "SELECT * FROM `schools` ";
                                              $result = mysqli_query($dbc, $query)
                                                or die("Error");

                                             while($row = mysqli_fetch_array($result))
                                             {
                                                 ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                                 <?php
                                             }
                                               ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-4 col-form-label bold">
                                          Inputer:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="inputer"  class="form-control"
                                            placeholder="Name of Person Inputing" required>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-4 col-form-label bold">
                                          Authoriser:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="authoriser"  class="form-control"
                                            placeholder="Authoriser" required>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-4 col-form-label bold">
                                          Month:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="month"  class="form-control"
                                            placeholder="Month" required>
                                      </div>
                                  </div>
                              </div>

                          </div>

                          <br>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <h4>Requisition code : <strong><?php echo $req_code; ?></strong> </h4>
                                      <input type="hidden" name="req_code" value="<?php $req_code; ?>">
                                  </div>
                              </div>
                          </div>

                          <br>
                          <br>
                          <div class="row">
                              <div class="col-md-12">
                                  <table class="table table-bordered">
                                      <tr>
                                          <th>Code</th>
                                          <th>Expenditure</th>
                                          <th>Amount</th>
                                          <th>Justification</th>
                                      </tr>

                                      <?php
                                      //get the req categories
                                      $query = "SELECT * FROM `req_categories` ";
                                      $categories = mysqli_query($dbc, $query)
                                        or die("Error");

                                      while($r = mysqli_fetch_array($categories))
                                      {
                                          $catCode = $r['category_code'];

                                          ?>
                                          <tr>
                                              <th><?php echo $r['category_code']; ?></th>
                                              <th><?php echo $r['category_name']; ?></th>
                                              <th></th>
                                              <th></th>
                                          </tr>
                                          <?php

                                          //for each category get the items
                                          $query = "SELECT * FROM `req_items`
                                                WHERE `category_code` = '$catCode' ";
                                          $result = mysqli_query($dbc, $query)
                                            or die("Error");

                                            while($row = mysqli_fetch_array($result))
                                            {
                                                ?>
                                                <tr>
                                                    <input type="hidden" name="code[]" value="<?php echo $row['item_code']; ?>">
                                                    <input type="hidden" name="name[]" value="<?php echo $row['item_name']; ?>">
                                                    <td><?php echo $row['item_code']; ?></td>
                                                    <td><?php echo $row['item_name']; ?></td>
                                                    <td>
                                                        <input type="text" name="amount[]"
                                                        data-id1="<?php echo $catCode; ?>"
                                                        class="form-control amount item_<?php echo $catCode; ?>" placeholder="Amount">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="justification[]"
                                                        class="form-control" placeholder="Justification">
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                            <tr style="background-color: #41c4f5;">
                                                <td></td>
                                                <td> <strong>Total</strong> </td>
                                                <td colspan="2" class="text-center">
                                                    <strong> <span class="total_<?php echo $catCode; ?> heading bigger"></span> FCFA </strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="4"> <span style="padding: 5px;"></span> </td>
                                            </tr>
                                            <?php
                                      }
                                       ?>


                                  </table>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <button type="submit" name="button"
                                      class="btn btn-primary btn-lg">
                                      <i class="fa fa-plus"></i>
                                      Make Requisition
                                  </button>
                                  </div>
                              </div>
                          </div>

                      </form>
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
<script src="../assets/js/lib/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();

        //now process the form
        $(".amount").focusout(function(){
            //get the group
            var category = $(this).data("id1");

            var amount = $(this).val();

            var totalID  = '.total_' + category;

            $total = $(totalID);

            //sum all the amounts
            var sum  = getSum(category);

            $total.text(sum);

        });

        function getSum(category)
        {
            var itemID = '.item_' + category;

            var total = 0;

            $(itemID).each(function(){
                var amountString = $(this).val();

                var amount = parseInt(filter_num(amountString));

                if(!isNaN(amount))
                {
                    total += amount;
                }
            });

            return total;
        }

        //function to filter the amount entered
        function filter_num(number)
        {
            var num = number.replace(/\s/g, '');
                num = num.replace(/\,/g, '');
                num = num.replace(/\-/g, '');
                num = num.replace(/\./g, '');

            return num;
        }
    })
</script>
 <?php
include_once 'includes/end.php';
  ?>
