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
include_once '../classes/class.Employee.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['code']))
{
    $id = filter($_GET['code']);
    $action = filter($_GET['action']);

    if($action == "del")
    {
        //delete the school
        $query = "DELETE FROM `req_count` WHERE `req_code` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Could not delete cat");

        $query = "DELETE FROM `req_content` WHERE `req_code` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Could not delete cat");

        $success = "Requisition Deleted";
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

//get the academic year
$year = Constants::getAcademicYear($dbc);

//get all the absenses
if(isset($_GET['filter']))
{
    $school = filter($_GET['school']);

    //filter the input
    $query = "SELECT * FROM `req_count` WHERE `school` = '$school' ";
    $result = mysqli_query($dbc, $query)
        or die('Error');

    $page_number  = 1;
    $page_count = 1;
    $count = 1;
}
else {
    //query initialisation
    $results_per_page = 30; //number of results to show on a sigle page

    //data manipulation
    if(isset($_GET['page']))
    {
        //get the page number
        $page_number = filter($_GET['page']);

        //Variable to maintain countring
        $inter  = $page_number - 1; //reduces the page numer in order to count
        $count = (int) ($inter * $results_per_page) + 1;
    }
    else
    {
        $page_number = 1;

        //Variable to do countring
        $count = 1;
    }

    //START OF search results
    if($page_number < 2)
    {
        $start = 0;
    }
     else {
         $start = (($page_number - 1) * ($results_per_page));
    }

    //total data in the database;
    $query = "SELECT * from `req_count`  ";
    $result  = mysqli_query($dbc, $query);

    $total = mysqli_num_rows($result);

    if($results_per_page >= 1)
    {

       $number_of_pages = ceil($total/$results_per_page);

       if($number_of_pages < 1)
       {
           $page_count = 1;
       }
       else
       {
           $page_count = $number_of_pages;
       }

    }
    else
    {
        $error = "Results Per page Cannot be zero or Less";
        $page_count = 1;
    }
    //end
    $end = $results_per_page;

    //now if page number is greater that
    if($page_number > $page_count)
    {
        $error = "That Page does not Exist";
    }

    //do the query here
    $query = "SELECT * FROM `req_count`  ORDER BY `id` DESC LIMIT $start, $end";
    $result = mysqli_query($dbc, $query)
            or die("Error");
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
                          Requisitions
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <form class="" action="" method="get">
                                  <h3>Filter</h3>

                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  School:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="school">
                                                      <option value="">--SELECT SCHOOL--</option>
                                                      <?php
                                                      $query = "SELECT * FROM `schools` ORDER BY `name` ASC ";
                                                      $res = mysqli_query($dbc, $query)
                                                        or die("Error");

                                                        while($row = mysqli_fetch_array($res))
                                                        {
                                                            ?>
                                                        <option value="<?php echo $row['id']; ?>"
                                                            <?php if(isset($school)) { if($school == $row['id']) { echo 'selected'; } } ?> >
                                                            <?php echo $row['name']; ?>
                                                        </option>
                                                            <?php
                                                        }
                                                       ?>
                                                  </select>
                                              </div>
                                          </div>



                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group row">

                                              <div class="col-sm-8">
                                                  <input type="submit" name="filter" value="Filter"
                                                   class="btn btn-success">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="text-center">
                                  <h3>School:
                                      <strong>
                                          <?php
                                          if(!isset($_GET['school']))
                                            echo 'All Schools';
                                          else {
                                              echo getSchool($school);
                                          }
                                          ?>
                                      </strong> </h3>
                              </div>
                          </div>
                      </div>
                      <br>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">
                                  <table class="table table-striped ">
                                      <tr>
                                          <th>S/N</th>
                                          <th>Date Added</th>
                                          <th>Code</th>
                                          <th>School</th>
                                          <th>Inputer</th>
                                          <th>Authoriser</th>
                                          <th>Month</th>
                                          <th>N<sup>o</sup> Items  </th>
                                          <th>Total Cost</th>
                                          <th>Action</th>
                                      </tr>
                                      <?php
                                      if(mysqli_num_rows($result) == 0)
                                      {
                                          ?>
                                    <tr>
                                        <th colspan="12" class="text-center"> <strong class="text-primary">No Requisitions yet</strong> </th>
                                    </tr>
                                          <?php
                                      }
                                      else {
                                          while($row = mysqli_fetch_array($result))
                                          {
                                              ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo date_from_timestamp($row['time_added']); ?></td>
                                            <td><?php echo $row['req_code']; ?></td>
                                            <td><?php echo getSchool($row['school']); ?></td>
                                            <td><?php echo $row['inputer']; ?></td>
                                            <td><?php echo $row['authoriser']; ?></td>
                                            <td><?php echo $row['month']; ?></td>
                                            <td><?php echo $row['items']; ?></td>
                                            <td><?php echo number_format($row['total']); ?></td>
                                            <td>
                                                <a href="edit_requisition.php?code=<?php echo $row['req_code']; ?>"
                                                    title="Edit Requisition">
                                                    <i class=" fa fa-pencil"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-xs delete"
                                                 data-id1="<?php echo $row['req_code']; ?>"
                                                 title="Delete this requisition">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="requisition_details.php?code=<?php echo $row['req_code']; ?>"
                                                    title="View Requisition Details"
                                                    class="btn btn-info btn-xs">
                                                    <i class="fa fa-list"></i>
                                                    View
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
                          <!-- //page number -->
                          <div class="col-md-12">
                              <div class="pull-right">
                                  Page <?php echo $page_number; ?>/<?php echo $page_count; ?>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="pull-right">
                                  <?php

                                  //the scrpt name
                                  $script = basename(__FILE__);

                                  if($page_count > 1)
                                  {
                                      ?>
                                  <ul class="pagination">
                                      <?php
                                      if($page_number != 1)
                                      {
                                          ?>
                                      <li class="previous">
                                          <a href="<?php echo $script; ?>?page=<?php echo $page_number - 1; ?>" >Prev</a>
                                      </li>
                                          <?php
                                      }
                                      ?>
                                      <?php
                                      for($i = 1; $i <= $page_count; $i++)
                                      {
                                          ?>
                                      <li class="<?php  $i == $page_number ? print 'active' : ''; ?>">
                                          <a href="<?php echo $script; ?>?page=<?php echo $i; ?>"  >
                                              <?php echo $i; ?>
                                          </a>
                                      </li>
                                          <?php
                                      }
                                      ?>

                                      <?php
                                      //If the pages and page number are not the same then show the next button
                                      if($page_number != $page_count)
                                      {
                                          ?>
                                      <li class="next">
                                          <a href="<?php echo $script; ?>?page=<?php echo $page_number + 1; ?>"> Next</a>
                                      </li>
                                          <?php
                                      }
                                      ?>

                                  </ul>
                                      <?php
                                  }
                                  ?>
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
        $(".delete").click(function(){
            var code = $(this).data("id1");

            var url = "view_requisitions.php?action=del&code=" + code;

            if(confirm("Do you want to delete this requisition ?"))
            {
                window.location.href = url;
            }
        });
    });
</script>
 <?php
include_once 'includes/end.php';
  ?>
