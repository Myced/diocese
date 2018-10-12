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

//perform filtering here
if(isset($_GET['filter']))
{
    $school = filter($_GET['school']);

    //filter the input
    $query = "SELECT * FROM `employees` WHERE `school_id` = '$school' ";
    $people = mysqli_query($dbc, $query)
        or die('Error');
}
else {
    //pageinate
    //query initialisation
    $results_per_page = 3; //number of results to show on a sigle page

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
    $people = mysqli_query($dbc, $query)
            or die("Error");
}

$count = 1;
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
                          Create Salary (Select Employee)
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
                          <div class="col-md-6">
                              <input type="text" name="search" value="" id="search"
                              class="form-control" placeholder="Enter Name or Matricule">
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive" id="table">
                                  <table class="table table-bordered table-hover table-striped">
                                      <tr>
                                          <th>Action</th>
                                          <th>S/N</th>
                                          <th>Matricule</th>
                                          <th>Name</th>
                                          <th>Basic Salary</th>
                                          <th>CNPS(Worker)</th>
                                          <th>Fiscal <br> Deductions</th>
                                          <th>Allowance</th>
                                          <th>Net Salary</th>
                                      </tr>

                                      <?php
                                      while($row = mysqli_fetch_array($people))
                                      {
                                          ?>
                                         <tr>
                                             <td>
                                                 <a href="create_salary.php?matricule=<?php echo $row['matricule']; ?>"
                                                     class="btn btn-info">Create</a>
                                             </td>
                                             <td><?php echo $count++; ?></td>
                                             <td><?php echo $row['matricule']; ?></td>
                                             <td><?php echo $row['fname']; ?></td>
                                         </tr>
                                          <?php
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
