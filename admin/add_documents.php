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
$current = 8;

//page logic
if(isset($_POST['add']))
{

}
else {
    $name = "Cedric";
    $matricule = "334-dfj4";
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

                      <form class="form-horizontal" action="add_documents.php" method="post"
                       id="form" enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Upload Documents</h3>

                                  <div class="row">
                                      <div class="col-md-10">

                                          <input type="hidden" name="namtricule" value="<?php echo $matricule; ?>"
                                          id="matricule">

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label">Upload File: </label>
                                              <div class="col-sm-8">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <input type="file" name="file"  id="file"
                                                          class="form-control" >
                                                      </div>

                                                      <div class="col-md-5">
                                                          <select name="document-type" id="type" class="form-control">
                                                                <option value="---">Select Document Type you are uploading</option>
                                                                <option value="Picture">Employee Picture</option>
                                                                <option value="ID Card (Face Up)"> ID Card (Face Up)</option>
                                                                <option value="ID Card (Face Down)"> ID Card (Face Down) </option>
                                                                <option value="Birth Certificate"> Birth Certificate</option>
                                                                <optgroup label="Certificates">
                                                                    <option value="FSLC">FSLC</option>
                                                                    <option value="GCE O Level">GCE Ordinary Level</option>
                                                                    <option value="GCE A Level"> GCE Advanced Level</option>
                                                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                                                    <option value="Other Certificate">Other Certificte</option>
                                                                </optgroup>
                                                                <optgroup label="Other Documents">
                                                                    <option value="Marraige Certificate"> Marraige Certificate</option>
                                                                    <option value="Contract">Contract</option>
                                                                    <option value="Other Document">Other Document</option>
                                                                </optgroup>

                                                        </select>
                                                      </div>

                                                      <div class="col-md-1">
                                                          <button type="submit" name="add_medal"
                                                          class="btn btn-primary" id="add">
                                                              <i class="fa fa-upload"></i>
                                                              Upload
                                                          </button>
                                                      </div>
                                                  </div>

                                                  <div class="row hide" id="nameField" >
                                                      <div class="col-md-5">

                                                      </div>

                                                      <div class="col-md-5">
                                                          <input type="text" name="name" value="" class="form-control"
                                                          placeholder="Certificate or Document Name" id="docname">
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="" class="col-sm-4 col-form-label"></label>
                                              <div class="col-md-8">
                                                  <div class="table-responsive" id="table">
                                                      <table class="table table-bordered">
                                                          <tr>
                                                              <th>S/N</th>
                                                              <th>Preview</th>
                                                              <th>Document Name</th>
                                                              <th>Action</th>
                                                          </tr>

                                                          <?php
                                                          $count = 1;

                                                          $query = "SELECT * FROM `files` WHERE `matricule` = '$matricule' ";
                                                          $result = mysqli_query($dbc, $query)
                                                            or die("Error");

                                                            while($row = mysqli_fetch_array($result))
                                                            {
                                                                ?>
                                                            <tr>
                                                                <td><?php echo $count++; ?></td>
                                                            </tr>
                                                                <?php
                                                            }
                                                           ?>
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
                                  <button type="submit" name="add_first" class="btn btn-success">
                                      <i class="fa fa-check"></i>
                                      Complete

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
        $("#type").click(function(){

            //get the upload fiel
            var $selected = $("#type option:selected").val();


            if($selected == "Other Certificate" || $selected == "Other Document")
            {
                //make the other input form visible
                $("#nameField").removeClass("hide");
            }
            else
            {
                if($("#nameField").hasClass("show"))
                {
                    //make it invisible
                    $("#nameField").removeClass("show");

                }
                $("#nameField").addClass("hide");
            }

        });

        //now if the form is submitted . type must be set
        $("#form").submit(function(e){


            //check if the file upload type has been set
            $file = $("#file");
            var $selected = $("#type option:selected").val();
            var docname = $("#docname").val();

            if($file.val() == "")
            {
                alert("Please You must choose a file before you can submit");
                e.preventDefault();
            }
            else
            {
                //do same with upload type
                if($selected == "---")
                {
                    alert("Please You must choose the file type");
                    e.preventDefault();
                }
                else if($selected == "Other Certificate" || $selected == "Other Document")
                {
                    if(docname == '')
                    {
                        alert("Please enter the document name");
                        e.preventDefault();
                    }
                    else {
                        return true;
                    }
                }
                else
                {
                    return true;
                }


            }


            return true;
        });
    });
</script>

<?php
include_once 'includes/end.php';
 ?>
