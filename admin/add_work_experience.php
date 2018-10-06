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

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

//calculate progress bar completion
$total = 9; // ther are nine sections to fill
$current = 7;

//page logic
if(isset($_POST['qualification']))
{
    $matricule = filter($_POST['matricule']);
    $name = filter($_POST['name']);

    $qualification = filter($_POST['qualification']);

    $query = "UPDATE `employees` SET `hqual`  = '$qualification'
            WHERE `matricule` = '$matricule'
    ";

    $result = mysqli_query($dbc, $query)
        or die('Error');

    $success = "Qualification Saved";
}
else {
    $name = "";
    $matricule = "";
}

//calculate percentage
$percentage = ceil( ($current / $total) * 100 );

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
                          Add New Employee
                      </h2>

                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <p><?php echo $percentage . '%'; ?> Complete</p>
                              <div class="progress active">
                                  <div class="progress-bar progress-bar-primary progress-bar-striped"
                                  role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0"
                                  aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
                                      <span class="sr-only"><?php echo $percentage; ?>% Complete</span>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-7">
                              <h3 class="page-header">
                                  <?php
                                  echo $name . ' (' . $matricule . ')';
                                   ?>
                              </h3>
                          </div>
                      </div>

                      <form class="form-horizontal" action="add_documents.php" method="post">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Working Experience</h3>

                                  <div class="row">
                                      <div class="col-md-10">

                                          <input type="hidden" name="matricule" value="<?php echo $matricule; ?>" id="matricule">
                                          <input type="hidden" name="name" value="<?php echo $name; ?>">


                                          <div class="form-group row">
                                              <label for="" class="col-sm-2 col-form-label">Experience: </label>
                                              <div class="col-sm-10">
                                                  <div class="row">
                                                      <div class="col-md-4">
                                                          <input type="text" name="" value="" class="form-control"
                                                          id="institution" placeholder="Name of Insitution">
                                                      </div>

                                                      <div class="col-md-3">
                                                          <input type="text" name="" value="" id="function"
                                                          class="form-control" placeholder="Function">
                                                      </div>

                                                      <div class="col-md-2">
                                                          <input type="text" name="" value="" id="yearStart"
                                                          class="form-control" placeholder="Start Year">
                                                      </div>

                                                      <div class="col-md-2">
                                                          <input type="text" name="" value="" id="yearEnd"
                                                          class="form-control" placeholder="End Year">
                                                      </div>

                                                      <div class="col-md-1">
                                                          <button type="button" name="add_medal"
                                                          class="btn btn-primary" id="add">
                                                              Add
                                                          </button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-2 col-form-label"></label>
                                              <div class="col-md-10">
                                                  <div class="table-responsive" id="table">
                                                      <table class="table table-bordered">
                                                          <tr>
                                                              <th>S/N</th>
                                                              <th>Institution</th>
                                                              <th>Function</th>
                                                              <th>Starting Year</th>
                                                              <th>Ending Year</th>
                                                              <th>Action</th>
                                                          </tr>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>



                                      </div>

                                      <div class="col-md-3">



                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-9">

                              </div>

                              <div class="col-md3">
                                  <button type="submit" name="add_first" class="btn btn-primary">
                                      Next
                                      <i class="fa fa-chevron-right"></i>
                                  </button>
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
        getData();
        $("#add").click(function(){
            var institution = $("#institution").val();
            var functions = $("#function").val();
            var yearStart = $("#yearStart").val();
            var yearEnd = $("#yearEnd").val();

            if(institution == '')
            {
                alert("Please enter the The institution name");
            }
            else {
                //make an ajax to save it
                $.ajax({
                    url : 'api/add_experience.php',
                    method : "post",
                    data : {matricule:matricule, institution:institution, function:functions, yearStart:yearStart, yearEnd:yearEnd},
                    success : function(data){
                        //clear input
                        $("#institution").val("");
                        $("#function").val("");
                        $("#yearStart").val("");
                        $("#yearEnd").val("");

                        getData();
                    }
                });
            }

        });

        function getData()
        {
            matricule = $("#matricule").val();
            $.ajax({
                url : 'api/get_experience.php',
                method : 'post',
                data : {matricule:matricule},
                success : function(data){
                    //fetch the medals again
                    $("#table").html(data);
                }
            });
        }

        $(document).on('click', '.delete', function(){
            var id = $(this).data("id1");

            //perform an ajax request
            $.ajax({
                url : 'api/del_experience.php',
                method : "post",
                dataType : 'text',
                data : { id: id},
                success : function(){
                    getData();
                }
            });
        })
    });
</script>

<?php
include_once 'includes/end.php';
 ?>
