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
    $result = mysqli_query($dbc, $query)
        or die('Error');

    $page_number  = 1;
    $page_count = 1;
    $count = 1;
}
else {
    //pageinate
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

//functions here
function getFunction($id)
{
    global $dbc;

    $query = "SELECT `function` FROM `functions` WHERE `id` = '$id' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    list($function)  = mysqli_fetch_array($result);

    return $function;
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

function deleteFiles($matricule)
{
    global $dbc;
    $query = "SELECT * FROM `files` WHERE `matricule` = '$matricule' ";
    $result = mysqli_query($dbc, $query)
        or die("Error1" . mysqli_error($dbc));

    while($row = mysqli_fetch_array($result))
    {
        $path = '../' . $row['location'];

        unlink($path);
    }

    $query = "DELETE FROM `files` WHERE `matricule` = '$matricule' ";
    $result = mysqli_query($dbc, $query)
        or die("Error2");

}

//delete employee here
if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
    if(isset($_GET['action']))
    {
        $action = filter($_GET['action']);

        if($action == 'del')
        {
            //delete the employee
            $query = "DELETE FROM `employees` WHERE `matricule` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error1");

            $query = "DELETE FROM `personnel_nok` WHERE `employee_id` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error2");

            $query = "DELETE FROM `personnel_id_card` WHERE `employee_id` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error3");

            $query = "DELETE FROM `medals` WHERE `matricule` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error4");

            $query = "DELETE FROM `schools_attended` WHERE `matricule` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error5");

            $query = "DELETE FROM `work_experience` WHERE `matricule` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error6");

            deleteFiles($matricule);

            $success = "Employee Deleted";
        }
    }
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
                   <h1>Employee List</h1>
               </div>
           </div>

          <div class="row">
              <div class="col-md-12">
                  <div class="card-box">
                      <h2 class="page-header">
                          Filter
                      </h2>

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
          </div>

          <div class="row">
              <div class="col-md-6 col-md-offset-6">
                  <input type="text" name="" value="" class="form-control search-box"
                  placeholder="Enter Name or Matricule" id="search" autocomplete="off">
              </div>
          </div>
          <br>

          <div class="row" id="data">

              <?php
              while($row = mysqli_fetch_array($result))
              {
                  $defaultUser = '../' . Constants::DEFAULT_AVATAR;
                  $avatar = $row['profile'];
                  if(!empty($avatar))
                  {
                      if(file_exists('../' . $avatar))
                      {
                          $avatar = '../' . $avatar;
                      }
                      else {
                          $avatar = $defaultUser;
                      }
                  }
                  else {
                      $avatar = $defaultUser;
                  }


                  ?>
                  <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-yellow">
                        <div class="widget-user-image">
                          <img class="img-circle" src="<?php echo $avatar; ?>" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><?php echo $row['fname']; ?></h3>
                        <h4 class="widget-user-desc"><?php echo getFunction($row['position']);  ?></h4>
                      </div>
                      <div class="box-footer no-padding">
                        <ul class="nav nav-stacked nav-me">
                            <li>
                                <a href="#">
                                    Matricule :
                                    <strong><?php echo $row['matricule']; ?></strong>
                                </a>
                            </li>
                          <li>
                              <a href="#">Employed : <strong> <?php echo $row['entry_day'] . '/' .
                                    $row['entry_month'] . '/' . $row['entry_year']; ?> </strong>
                              </a>
                         </li>

                          <li>
                              <a href="#">
                                  Current School :
                                  <span class="">
                                      <strong>
                                          <?php echo getSchool($row['school_id']); ?>
                                      </strong>
                                  </span>
                              </a>
                          </li>
                          <li><a href="#">
                              Telephone :
                              <strong class=""><?php echo $row['contact']; ?></strong>
                                </a>
                          </li>
                          <li class="text-center last-list">
                              <span>
                                  <a href="edit_profile.php?matricule=<?php echo $row['matricule']; ?>" class="btn btn-primary">
                                  <i class="fa fa-pencil"></i>
                                  Edit
                                    </a>
                            </span>

                              <span>
                                  <a href="employee_details.php?matricule=<?php echo $row['matricule']; ?>"
                                      class="btn btn-warning">
                                      <i class="fa fa-list-alt"></i>
                                      Details
                                  </a>
                              </span>

                              <span>
                                  <a href="#" class="btn btn-warning biodata"
                                  data-id1="<?php echo $row['matricule']; ?>">
                                      <i class="fa fa-print"></i>
                                      Print Biodata
                                  </a>
                              </span>

                              <span>
                                  <a href="#" class="btn btn-danger delete"
                                  data-id1="<?php echo $row['matricule']; ?>">
                                      <i class="fa fa-trash"></i>
                                      Delete
                                  </a>
                              </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                  </div>
                  <?php
              }
               ?>

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

/**
* Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
* Author: Coderthemes
* SweetAlert
*/

!function ($) {
"use strict";

var SweetAlert = function () {
};

//examples
SweetAlert.prototype.init = function () {

    //Warning Message
    $(document).on('click', '.delete', function () {

        var matricule = $(this).data("id1");

        swal({
            title: 'Are you sure you want to Delete',
            text: "The employee and Related data will be deleted",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-confirm mt-2',
            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
            confirmButtonText: 'Yes, delete it!',

            preConfirm: function(){
                    return new Promise(function(resolve){
                        var url = 'employee_list.php?matricule=' + matricule + "&action=del";

                        window.location.href = url;
                    })
                },
            allowOutsideClick: false
        },
          function(){
              $.ajax({
                type: "post",
                url: "url",
                data: "data",
                success: function(data) {}
              })
              .done(function(data) {
                swal("Deleted!", "Data successfully Deleted!", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
              });
        })
    });



},
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.biodata',function(){
            var matricule = $(this).data("id1");

            var url = "biodata.php?matricule=" + matricule;

            //open a new tab
            window.open(url, '', 'width=1400,height=960')
        });

        //perform the search  here
        $("#search").keyup(function(){
            var key = $(this).val();
            search(key);
        });

        $("#search").change(function(){
            var key = $(this).val();
            search(key);
        })

        function search(key)
        {
            //perform an ajax request
            $.ajax({
                url : 'api/search_employees.php',
                method: 'post',
                data : {key:key},
                success : function(data){
                    $("#data").html(data);
                }
            });
        }
    });
</script>

 <?php
include_once 'includes/end.php';
  ?>
