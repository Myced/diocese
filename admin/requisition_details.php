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
include_once '../classes/class.Requisition.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['code']))
{
    $code = filter($_GET['code']);
}
else {
    $code = '-1';
}

//delet an item
if(isset($_GET['id']))
{
    $id = filter($_GET['id']);

    if(isset($_GET['action']))
    {
        $action = filter($_GET['action']);

        if($action == 'del')
        {
            //delete
            $query = "DELETE FROM `req_content` WHERE `id`  = '$id' ";
            $result = mysqli_query($dbc, $query);

            $success = "Item Deleted";
        }
    }
}

function getSchool($id)
{
    global $dbc;

    $query = "SELECT `name` FROM `schools` WHERE `id` = '$id' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    list($school) = mysqli_fetch_array($result);

    return $school;
}

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->
 <link rel="stylesheet" href="../assets/css/lib/sweetalert2.min.css">

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
                          Requisition Details
                      </h2>

                      <?php
                      $count = 1;
                      $requisition = new Requisition($dbc, $code);
                      $items = $requisition->getContent();

                      $query = "SELECT * FROM `req_count`
                            WHERE `req_code` = '$code' ";
                      $result  = mysqli_query($dbc, $query)
                        or die("Error");

                    if(mysqli_num_rows($result) == 0)
                    {
                        $school = '';
                        $inputer = '';
                        $authoriser = '';
                        $month = '';
                    }
                    else {
                        while($row = mysqli_fetch_array($result))
                        {
                            $school = getSchool($row['school']);
                            $inputer = $row['inputer'];
                            $authoriser = $row['authoriser'];
                            $month = $row['month'];
                            $date_added = $row['time_added'];
                        }
                    }
                       ?>

                       <div class="row">
                           <div class="col-md-6">

                           </div>

                           <div class="col-md-6">
                               <div class="row">
                                   <dt class="col-sm-4 right-align">Added On: </dt>
                                   <dd class="col-sm-8"><?php echo date_from_timestamp($date_added); ?></dd>

                                   <dt class="col-sm-4 right-align">At: </dt>
                                   <dd class="col-sm-8"><?php echo time_from_timestamp($date_added); ?></dd>
                               </div>
                           </div>
                       </div>

                       <br>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="row">
                                  <dt class="col-sm-4 right-align">Name of School: </dt>
                                  <dd class="col-sm-8"><?php echo $school; ?></dd>
                              </div>
                          </div>

                          <div class="col-md-6">

                          </div>
                      </div>


                      <br>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="row">
                                  <dt class="col-sm-4 right-align">Inputer: </dt>
                                  <dd class="col-sm-8"><?php echo $inputer; ?></dd>

                                  <dt class="col-sm-4 right-align">Authoriser: </dt>
                                  <dd class="col-sm-8"><?php echo $authoriser; ?></dd>

                                  <dt class="col-sm-4 right-align">Month: </dt>
                                  <dd class="col-sm-8"><?php echo $month; ?></dd>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="row">

                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="row">

                              </div>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="text-center">
                                  <h3 style="font-family: serif;" class="underline"><?php echo $code; ?></h3>
                                  <input type="hidden" name="" value="<?php echo $code; ?>" id="code">
                              </div>
                          </div>
                      </div>

                      <br>
                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped">
                                      <tr>
                                          <th>S/N</th>
                                          <th>Item Code</th>
                                          <th>Item Name</th>
                                          <th>Amount</th>
                                          <th>Justification</th>
                                          <th>Action</th>
                                      </tr>

                                      <?php
                                      if($items->num_rows == 0)
                                      {
                                          ?>
                                    <tr>
                                        <td class="text-center" colspan="9">
                                            <strong class="text-primary">No Items In this Requisition Request</strong>
                                        </td>
                                    </tr>
                                          <?php
                                      }
                                      else {
                                          while($row = $items->fetch_object())
                                          {
                                              ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row->item_code; ?></td>
                                                <td><?php echo $row->item_name ?></td>
                                                <td><?php echo $row->amount; ?></td>
                                                <td><?php echo $row->justification; ?></td>
                                                <td>
                                                    <a href="#" data-id1="<?php echo $row->id; ?>"
                                                        class="btn btn-danger btn-xs del">
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

                      <div class="row">
                          <div class="col-md-12">
                              <div class="text-center">
                                  <a href="view_requisitions.php"
                                  title="View Requisitions"
                                  class="btn btn-warning">
                                    <i class="fa fa-chevron-left"></i>
                                      Requisitions
                                  </a>

                                  <a href="edit_requisition.php?code=<?php echo $code; ?>"
                                      title="Edit this Requisition"
                                      class="btn btn-primary">
                                      <i class="fa fa-pencil"></i>
                                      Edit Requisition
                                  </a>

                                  <a href="#"
                                      onclick="openRequisition()"
                                      title="Print This Requisition"
                                      class="btn btn-success">
                                      <i class="fa fa-print"></i>
                                      Print Requisition
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
 <script src="../assets/js/lib/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".del").click(function(){
            var id = $(this).data("id1");
            var code = $("#code").val();

            var url = "requisition_details.php?code="
                + code + "&action=del&id=" + id;

            if(confirm("Do you want to delete this item from the requisition list ?"))
            {
                window.location.href = url;
            }
        });


    });

    function openRequisition()
    {
        window.open("print/requisition.php?code=<?php echo $code; ?>", '', 'width: 1300')
    }
</script>
 <?php
include_once 'includes/end.php';
  ?>
