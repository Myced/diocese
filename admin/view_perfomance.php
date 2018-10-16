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
include_once '../classes/class.Evaluation.php';
include_once '../classes/class.Employee.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

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
    $query = "SELECT * FROM `employees` WHERE `school_id` = '$school' ";
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
    $query = "SELECT * from `employees`  ";
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
    $query = "SELECT * FROM `employees`  ORDER BY `id` DESC LIMIT $start, $end";
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
                                  <h2>Academic Year: <strong><?php echo $year; ?></strong> </h2>
                              </div>
                          </div>
                      </div>
                      <br>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="text-center">
                                  <h2>School:
                                      <strong>
                                          <?php
                                          if(!isset($_GET['school']))
                                            echo 'All Schools';
                                          else {
                                              echo getSchool($school);
                                          }
                                          ?>
                                      </strong> </h2>
                              </div>
                          </div>
                      </div>
                      <br>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped">

                                      <?php
                                      //get the categories
                                      $query = "SELECT * FROM `evaluation_categories` ";
                                      $categories = $dbc->query($query);

                                      //create a small instance of evaluation
                                      // to get the total marks for each category
                                      $eval = new Evaluation($dbc, '');
                                      $grandEvalTotal = 0;

                                      $num = mysqli_num_rows($categories);
                                       ?>

                                      <tr>
                                          <th>S/N</th>
                                          <th></th>
                                          <th></th>
                                          <th colspan="<?php echo ++$num; ?>" class="text-center">MID TERM EVALUATION</th>
                                          <th colspan="<?php echo $num; ?>" class="text-center">END OF YEAR EVALUATION</th>
                                          <th></th>
                                      </tr>
                                      <tr>
                                          <th>S/N</th>
                                          <th>Edit</th>
                                          <th>Name</th>
                                          <?php

                                          $evalTotal = 0;

                                          while($row = mysqli_fetch_array($categories))
                                          {
                                              ?>
                                            <th>
                                                <?php echo $row['name']; ?>
                                                <br>
                                                /
                                                <br>
                                                <?php
                                                echo $eval_tt=  $eval->getCategoryTotalMark($row['id']);
                                                $evalTotal += $eval_tt;
                                                 ?>
                                            </th>
                                              <?php
                                          }

                                          echo '<th> Total <br> / <br> ' . $evalTotal . ' </th>';

                                          mysqli_data_seek($categories, 0);
                                          $evalTotal = 0;

                                          while($row = mysqli_fetch_array($categories))
                                          {
                                              ?>
                                            <th>
                                                <?php echo $row['name']; ?>
                                                <br>
                                                /
                                                <br>
                                                <?php
                                                echo $eval_tt=  $eval->getCategoryTotalMark($row['id']);
                                                $evalTotal += $eval_tt;
                                                 ?>
                                            </th>
                                              <?php
                                          }
                                          echo '<th> Total <br> / <br> ' . $evalTotal . '  </th>';

                                          echo '<th> Grand Total <br> / <br> ' . $evalTotal * 2 . ' </th>';
                                           ?>
                                      </tr>

                                      <?php
                                      //get all candidates
                                      while($row = mysqli_fetch_array($result))
                                      {
                                          $matricule = $row['matricule'];
                                          ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td>
                                                <a href="edit_performance.php?matricule=<?php echo $row['matricule']; ?>"
                                                    title="Edit Performance">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td><?php echo $row['fname']; ?></td>

                                            <?php
                                            //get the totals for each
                                            mysqli_data_seek($categories, 0);
                                            $term = '1';

                                            $termTotal = 0; //terminal total for each
                                            $grandTotal = 0; //the evaluation grand total;

                                            //prepare an evaluation object
                                            $evaluation = new Evaluation($dbc, $matricule);
                                            $evaluation->setTerm($term);
                                            $evaluation->setYear($year);

                                            while($row = mysqli_fetch_array($categories))
                                            {
                                                $cat_id = $row['id'];

                                                $catTotal = $evaluation->getCategoryTotal($cat_id);
                                                $termTotal += $catTotal;

                                                ?>
                                                <td> <?php echo $catTotal; ?> </td>
                                                <?php
                                            }

                                            $grandTotal += $termTotal;
                                            echo '<th> ' . $termTotal . ' </th>';

                                            mysqli_data_seek($categories, 0);
                                            $term = '2';

                                            //reconfigure the evaluation obecjt to second term
                                            $evaluation->setTerm($term);

                                            //reinitialise term totoal
                                            $termTotal = 0;

                                            while($row = mysqli_fetch_array($categories))
                                            {
                                                $cat_id = $row['id'];

                                                $catTotal = $evaluation->getCategoryTotal($cat_id);
                                                $termTotal += $catTotal;

                                                ?>
                                                <td> <?php echo $catTotal; ?> </td>
                                                <?php
                                            }

                                            $grandTotal += $termTotal;
                                            echo '<th> ' . $termTotal . ' </th>';
                                             ?>
                                             <th class="text-primary text-center bigger"><?php echo $grandTotal; ?></th>
                                        </tr>
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
