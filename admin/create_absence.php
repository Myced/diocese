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

//process for here
if(isset($_POST['name']))
{
    $name = filter($_POST['name']);
    $matricule = filter($_POST['matricule']);
    $function = filter($_POST['function']);
    $type = filter($_POST['type']);
    $startDate = filter($_POST['start_date']);
    $endDate = filter($_POST['end_date']);
    $days = filter($_POST['days']);

    $backup = filter($_POST['backup']);
    $backupMatricule = filter($_POST['backup_matricule']);

    //save the stuff
    if($name == '')
    {
        $error = "Sorry, The employee name is needed";
    }

    if(!isset($error))
    {
        //save the request
        $query = "INSERT INTO `leave_requests`
            (`name`, `matricule`, `function`, `type`, `start_date`,
                `end_date`, `days`, `backup`, `backup_matricule`
            )

            VALUES
            ('$name', '$matricule', '$function', '$type', '$startDate',
                '$endDate', '$days', '$backup', '$backupMatricule'
            )
        ";

        $result = mysqli_query($dbc, $query)
            or die('Error');

        $success = "Leave Request Saved";
    }
}

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->
 <link rel="stylesheet" href="../assets/css/lib/bootstrap-datepicker.min.css">

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
                          Create Absense
                      </h2>

                      <form class="" action="" method="post">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          Name of Employee:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="name" class="form-control"
                                          placeholder="Name" value="" autocomplete="off"
                                          required id="name">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">Matricule: </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="matricule" class="form-control"
                                          placeholder="Matricule" value="" readonly
                                          id="matricule">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">Function: </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="function" class="form-control"
                                          placeholder="Function" value="<?php echo ''; ?>"
                                          id="function">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">Absence Type: </label>
                                      <div class="col-sm-8">
                                          <select class="form-control" name="type">
                                              <option value="Sick Leave">Sick Leave</option>
                                              <option value="Annual Leave">Annual Leave</option>
                                              <option value="Permission">Permission</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          Start Date:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="start_date" class="form-control datepicker"
                                          placeholder="dd/mm/YYYY" value="<?php echo ''; ?>"
                                          required>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          End Date:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="end_date" class="form-control datepicker"
                                          placeholder="dd/mm/YYYY" value="<?php echo ''; ?>"
                                          required>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          Number of Days
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="days" class="form-control"
                                          placeholder="" value="<?php echo ''; ?>"
                                          required>
                                      </div>
                                  </div>


                              </div>

                              <div class="col-md-6">
                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          Name of Backup:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="backup" class="form-control"
                                          placeholder="Name of Backup person" value=""
                                          required id="backup">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="" class="col-sm-4 col-form-label">
                                          Matricule:
                                          <span class="required">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                          <input type="text" name="backup_matricule" class="form-control"
                                          placeholder="matricule" value="<?php echo ''; ?>"
                                          required id="backupMatricule">
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-6">

                              </div>

                              <div class="col-md-6">
                                  <input type="submit" name="save" value="Validate Absence"
                                    class="btn btn-primary">
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
<script src="../assets/js/lib/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/lib/typeahead.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $name = $("#name");
        $matricule = $("#matricule");
        $functions = $("#function");

        $backup = $("#backup");
        $backupMatricule = $("#backupMatricule");

        $("#name").typeahead({
		    source: function(key, result){
		        $.ajax({
		            url: "api/get_employee_names.php",
		            method: "POST",
		            data: {key:key},
		            dataType: "json",
		            success: function(data){
                        console.log(data);
		                result($.map(data, function(item){
		                    return item;
		                }));
		            }
		        });
		    }
		});

        //get the employee information once the focus is out
        $name.focusout(function(){
            //get the name
            var empName = $name.val();

            //make an ajax request to get the information
            $.ajax({
                url : 'api/get_employee_details.php',
                method : "POST",
                data : {name: empName},
                success : function(data){

                    var result = JSON.parse(data);

                    var functions = result[1];
                    var matricule = result[0];

                    $functions.val(functions);
                    $matricule.val(matricule);
                }
            });
        });

        //do backup typeahead here
        $backup.typeahead({
		    source: function(key, result){
		        $.ajax({
		            url: "api/get_employee_names.php",
		            method: "POST",
		            data: {key:key},
		            dataType: "json",
		            success: function(data){
                        console.log(data);
		                result($.map(data, function(item){
		                    return item;
		                }));
		            }
		        });
		    }
		});

        //get the matricule of the backup employee
        $backup.focusout(function(){
            //get the name
            var backName = $backup.val();

            //make an ajax request to get the information
            $.ajax({
                url : 'api/get_employee_details.php',
                method : "POST",
                data : {name: backName},
                success : function(data){

                    var result = JSON.parse(data);

                    var functions = result[1];
                    var matricule = result[0];

                    $backupMatricule.val(matricule);
                }
            });
        });

        //setup date picker
        jQuery('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

    });
</script>
 <?php
include_once 'includes/end.php';
  ?>
