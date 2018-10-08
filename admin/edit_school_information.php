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
include_once '../classes/class.Employee.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
}
else {
    $matricule = '';
}

if(isset($_POST['function']))
{
    $school = filter($_POST['school']);
    $function  = filter($_POST['function']);
    $competence = filter($_POST['competence']);
    $residence = filter($_POST['residence']);

    $query = "UPDATE `employees` SET
        `school_id` = '$school',
        `position` = '$function',
        `competence` = '$competence',
        `residence` = '$residence'

        WHERE `matricule` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die("Error" . mysqli_error($dbc));

    $success = "School Function Updted";

}

$employee = new Employee($matricule);
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
                          Edit Employee Information
                      </h2>

                      <br>
                      <div class="row">
                          <div class="col-md-7">
                              <h3 class="page-header">
                                  <?php
                                  echo $employee->name . ' (' . $matricule . ')';
                                   ?>
                              </h3>
                          </div>
                      </div>

                      <form class="form-horizontal" action="" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">School Information</h3>

                                  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>" id="matricule">

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
                                                        <option value="<?php echo $row['id']; ?>"
                                                            <?php if($employee->schoolID == $row['id']) {echo 'selected'; } ?>>
                                                            <?php echo $row['name']; ?>
                                                        </option>
                                                            <?php
                                                        }
                                                       ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">
                                                  Function:
                                                  <span class="required">*</span>
                                              </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="function">
                                                      <option value=""></option>
                                                      <?php
                                                      $query = "SELECT * FROM `functions` ORDER BY `function` ASC ";
                                                      $result = mysqli_query($dbc, $query)
                                                        or die("Error");

                                                        while($row = mysqli_fetch_array($result))
                                                        {
                                                            ?>
                                                        <option value="<?php echo $row['id']; ?>"
                                                            <?php if($employee->functionID == $row['id']) { echo 'selected'; } ?>>
                                                            <?php echo $row['function']; ?>
                                                        </option>
                                                            <?php
                                                        }
                                                       ?>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Area of Competence: </label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="competence" class="form-control"
                                                  placeholder="Area of competence" value="<?php echo $employee->competence; ?>">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Temporal Residence: </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" name="residence">
                                                      <option value="On Campus" <?php if($employee->residence == 'On Campus') {echo 'selected'; } ?> >On Campus</option>
                                                      <option value="Off Campus" <?php if($employee->residence == 'Off Campus') {echo 'selected'; } ?> >Off Campus</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Medals Issued: </label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <select class="form-control" name="" id="medal">
                                                                <option value="--">----</option>
                                                                <option value="SILVER">SILVER</option>
                                                                <option value="BRONZE">BRONZE</option>
                                                                <option value="GOLD">GOLD</option>
                                                                <option value="PLATINIUM">PLATINIUM</option>
                                                                <option value="MVP">MVP</option>
                                                                <option value="LONG SERVING">LONG SERVING</option>
                                                                <option value="NONE">NONE</option>
                                                                <option value="OTHERS">OTHERS</option>
                                                          </select>
                                                      </div>

                                                      <div class="col-md-3">
                                                          <input type="text" name="" value="" id="year"
                                                          class="form-control" placeholder="Year">
                                                      </div>

                                                      <div class="col-md-3">
                                                          <button type="button" name="add_medal"
                                                          class="btn btn-primary" id="add">
                                                              Add
                                                          </button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                      </div>

                                      <div class="col-md-6">

                                          <div class="table-responsive" id="table">
                                              <table class="table table-bordered">
                                                  <tr>
                                                      <th>S/N</th>
                                                      <th>Medal</th>
                                                      <th>Year</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </table>
                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <button type="submit" name="add" class="btn btn-primary">
                                          <i class="fa fa-save"></i>
                                          Save Changes
                                      </button>
                                  </div>
                              </div>

                          </div>
                          <br>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <a href="edit_profile.php?matricule=<?php echo $matricule; ?>"
                                          class="btn btn-warning">
                                          <i class="fa fa-user"></i>
                                          Edit Profile
                                      </a>

                                      <a href="employee_details.php?matricule=<?php echo $matricule; ?>"
                                          class="btn btn-info">
                                          <i class="fa fa-list-alt"></i>
                                          Employee Details
                                      </a>

                                      <a href="employee_list.php"
                                          class="btn btn-info">
                                          <i class="fa fa-list"></i>
                                          Employee List
                                      </a>
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
<script type="text/javascript">
    $(document).ready(function(){

        var matricule = $("#matricule").val();
        getMedals(matricule);

        $("#add").click(function(){
            //get the values first
            var medal = $("#medal option:selected").val();
            var year = $("#year").val();
            var matricule = $("#matricule").val();

            //validate
            if(medal == '--')
            {
                alert("Please select the medal first");
            }
            else
            {
                if(year == '')
                {
                    alert("Please enter the year");
                }
                else {
                    //do the addition here
                    $.ajax({
                        url  : 'api/add_medal.php',
                        method : 'Post',
                        dataType: 'text',
                        data : {matricule: matricule, medal:medal, year:year},
                        success: function(){
                            //make a ajax query to select al this person medal
                            $("#year").val("");
                            $("#medal option:selected").removeAttr('selected');

                            $.ajax({
                                url: 'api/get_medals.php',
                                method: "post",
                                data: {matricule: matricule},
                                dataType: "text",
                                success: function(data)
                                {
                                    $("#table").html(data);
                                }
                            });
                        }
                    });
                }
            }

        });

        function getMedals(matricule)
        {
            $.ajax({
                url: 'api/get_medals.php',
                method: "post",
                data: {matricule: matricule},
                dataType: "text",
                success: function(data)
                {
                    $("#table").html(data);
                }
            });
        }

        $(document).on('click', '.delete', function(){

            var id  = $(this).data("id1");

            var matricule = $("#matricule").val();

            $.ajax({
                url : 'api/del_medal.php',
                method : 'post',
                data : {id:id},
                success : function(){
                    //fetch the medals again
                    $.ajax({
                        url: 'api/get_medals.php',
                        method: "post",
                        data: {matricule: matricule},
                        dataType: "text",
                        success: function(data)
                        {
                            $("#table").html(data);
                        }
                    });
                }
            });
        });
    });
</script>

 <?php
include_once 'includes/end.php';
  ?>
