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
if(isset($_POST['name']))
{
    $matricule = filter($_POST['matricule']);
    $name = filter($_POST['name']);

    $success = "Work Experience Saved";
}
else {
    $name = "";
    $matricule = "";
}

if(isset($_POST['document-type']))
{
    $matricule = filter($_POST['matricule']);
    $name = filter($_POST['name']);

    $file = $_FILES ['file'];

    $name1 = $file ['name'];
    $type = $file ['type'];
    $size = $file ['size'];
    $tmppath = $file ['tmp_name'];

    $filename = date("dmYhms") . $name1;

    $filetype = filter($_POST['document-type']);
    $other = filter($_POST['other']);

    if($filetype == 'Other Document' || $filetype == 'Other Certificate')
    {
        $filetype = $other;
    }

    //get the file extenstion
    $spl = new SplFileInfo($name1);
    $extention = strtolower($spl->getExtension());

    $location = 'uploads/employees/documents/' . $filename;

    if(move_uploaded_file ($tmppath, '../' . $location))//image is a folder in which you will save image
    {
        $query = "INSERT INTO `files`
            (`matricule`, `name`, `type`, `location`)
            VALUES
            ('$matricule', '$filetype', '$extention', '$location')
        ";

        $result = mysqli_query($dbc, $query)
            or die("Cannot insert");

        if($filetype == "Picture")
        {
            $query = "UPDATE `employees` SET `profile` = '$location'
            WHERE `matricule` = '$matricule' ";
            $result = mysqli_query($dbc, $query)
                or die("Error");
        }

        $success = "File Uploaded";
    }

    $current = 9;
}

//process file upload here


//calculate percentage
$percentage = ceil( ($current / $total) * 100 );

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->
 <link rel="stylesheet" href="../assets/css/lib/lightbox.css">

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

                      <div class="row hide" id="complete">
                          <div class="col-md-12">
                              <div class="text-center text-success">
                                  <i class="fa fa-check fa-4x"></i>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="text-center">
                                  <br>
                                  <h3 class="text-success">EMPLOYEE REGISTERED</h3>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="text-center">
                                  <a href="add_employee.php" class="btn btn-info">
                                      <i class="fa fa-plus"></i>
                                      Add New Employee
                                  </a>

                                  <a href="employee_list.php" class="btn btn-warning">
                                      <i class="fa fa-list"></i>
                                      Employee List
                                  </a>
                              </div>
                              <br>
                          </div>
                      </div>

                      <form class="form-horizontal" action="add_documents.php" method="post"
                       id="form" enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-md-12">
                                  <h3 class="page-header">Upload Documents</h3>

                                  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>" id="matricule">
                                  <input type="hidden" name="name" value="<?php echo $name; ?>">

                                  <div class="row" id="app" style="border: 1px solid green;">
                                      <div class="col-md-10">

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
                                                          <input type="text" name="other" value="" class="form-control"
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
                                                                <td>
                                                                    <?php
                                                                    if($row['type'] == 'pdf')
                                                                    {
                                                                        ?>
                                                                    <a href="<?php echo '../' . $row['location']; ?>" target="_blank">
                                                                        <img src="../assets/images/pdf.svg" alt="PDF FILE"
                                                                        width="150px" height="150px">
                                                                    </a>
                                                                        <?php
                                                                    }
                                                                    else if($row['type'] == 'png' || $row['type'] == 'jpg'
                                                                     || $row['type'] == 'jpeg' || $row['type'] == 'gif')
                                                                     {
                                                                         ?>
                                                                         <a href="<?php echo '../' . $row['location']; ?>" data-lightbox="gallery"
                                                                             data-title="<?php echo $row['name']; ?>">
                                                                             <img src="<?php echo '../' . $row['location']; ?>" alt="Document"
                                                                                 width="150px" height="150px">
                                                                         </a>
                                                                         <?php
                                                                     }
                                                                     else {
                                                                         ?>
                                                                         <a href="<?php echo '../' . $row['location']; ?>" target="_blank">
                                                                             <img src="../assets/images/doc.svg" alt="PDF FILE"
                                                                             width="150px" height="150px">
                                                                         </a>
                                                                         <?php
                                                                     }
                                                                     ?>

                                                                </td>

                                                                <td><?php echo $row['name']; ?></td>
                                                                <td></td>
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
                                  <button type="button" name="add_first" class="btn btn-success" id="completebtn">
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
<script src="../assets/js/lib/lightbox.js"></script>
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

        $("#completebtn").click(function(){
            $form = $("#form");
            $complete = $("#complete");

            $form.removeClass("show");
            $form.addClass("hide");
            $complete.removeClass("hide");
            $complete.addClass("show");
        });
    });
</script>

<?php
include_once 'includes/end.php';
 ?>
