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

//process page here
if(isset($_GET['id']))
{
    $id = filter($_GET['id']);

    //now check if it is to lock or update
    if(isset($_GET['lock']))
    {
        //then lock the request
        $query = "UPDATE `leave_requests` SET `locked` = '1' WHERE `id` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Error");

        $success = "Leave Locked. Can no longer be modified";
    }
    else {
        //get the details
        $remark = filter($_GET['remark']);
        $status = filter($_GET['status']);

        //now update
        $query = "UPDATE `leave_requests` SET
                `remark` = '$remark', `status` = '$status'
                    where `id` = '$id'
        ";
        $result = mysqli_query($dbc, $query)
            or die("Error");

        $success = "Leave Status Updated";
    }
}

//get all the absenses
if(isset($_GET['filter']))
{

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
    $query = "SELECT * from `leave_requests`  ";
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
    $query = "SELECT * FROM `leave_requests`  ORDER BY `id` DESC LIMIT $start, $end";
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
                          Absence Requests
                      </h2>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered">
                                      <tr>
                                          <th>S/N</th>
                                          <th>Name</th>
                                          <th>Function</th>
                                          <th>Backup</th>
                                          <th>Absence Type</th>
                                          <th>Duration</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Remark</th>
                                          <th>Status</th>
                                          <th>Lock</th>
                                      </tr>
                                      <?php
                                      while($row = mysqli_fetch_array($result))
                                      {
                                          ?>
                                        <form class="" action="" method="get">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['function']; ?></td>
                                                <td><?php echo $row['backup']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['days'] ?></td>
                                                <td><?php echo $row['start_date']; ?></td>
                                                <td><?php echo $row['end_date']; ?></td>

                                                    <?php
                                                    if($row['locked'] == '0')
                                                    {
                                                        ?>
                                                        <td>
                                                            <select class="form-control" name="remark">
                                                                <option value="Late" <?php if($row['remark'] == 'Late') echo 'selected'; ?> >Late</option>
                                                                <option value="Ok" <?php if($row['remark'] == 'Ok') echo 'selected'; ?> >Ok</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <select class="form-control" name="status">
                                                                <option value="Absent" <?php if($row['status'] == 'Absent') echo 'selected'; ?> >Absent</option>
                                                                <option value="Returned" <?php if($row['status'] == 'Returned') echo 'selected'; ?> >Returned</option>
                                                                <option value="Red Flag" <?php if($row['status'] == 'Red Flag') echo 'selected'; ?> >Red Flag</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <button type="submit" name="button"
                                                            class="btn btn-primary" title="Save">
                                                                <i class="fa fa-save"></i>
                                                            </button>

                                                            <a href="absence_requests.php?id=<?php echo $row['id']; ?>&lock=true"
                                                                class="btn btn-warning" title="Lock this Request">
                                                                <i class="fa fa-lock"></i>
                                                            </a>
                                                        </td>
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <td>
                                                            <?php
                                                            $remark =  $row['remark'];
                                                            if($remark == 'Ok')
                                                            {
                                                                ?>
                                                                <div class="badge badge-success">
                                                                    <i class="fa fa-check"></i>
                                                                    Ok
                                                                </div>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                <div class="badge badge-warning">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    Late
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $status = $row['status'];
                                                            if($status == 'Absent')
                                                            {
                                                                ?>
                                                            <div class="badge badge-warning">
                                                                <i class="fa fa-clock-o"></i>
                                                                Absent
                                                            </div>
                                                                <?php
                                                            }
                                                            elseif($status == "Red Flag")
                                                            {
                                                                ?>
                                                            <div class="badge badge-danger">
                                                                <i class="fa fa-times"></i>
                                                                Red Flag
                                                            </div>
                                                                <?php
                                                            }
                                                            elseif($status == "Returned") {
                                                                ?>
                                                            <div class="badge badge-success">
                                                                <i class="fa fa-check"></i>
                                                                Returned
                                                            </div>
                                                                <?php
                                                            }
                                                            else {
                                                                echo $status;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-check fa-2x text-success"></i>
                                                        </td>
                                                        <?php
                                                    }
                                                     ?>
                                            </tr>
                                        </form>
                                          <?php
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

 <?php
include_once 'includes/end.php';
  ?>
