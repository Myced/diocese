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
                                          <select class="form-control select2" name="school">
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
    })
</script>
 <?php
include_once 'includes/end.php';
  ?>
