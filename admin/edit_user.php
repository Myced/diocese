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
include_once '../classes/class.User.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
}
else {
    $id = '-1';
}

//update information here
if(isset($_POST['worker_name']))
{
    $name = filter($_POST['worker_name']);
    $contact = filter($_POST['contact']);
    $position = filter($_POST['position']);
    $email = filter($_POST['email']);

    $user = filter($_POST['user_id']);
    $username = filter($_POST['username']);

    //get the user level
    $level = filter($_POST['level']);
    $school  = filter($_POST['school']);

    $destination = '';



    //upload photo
    //now if the image is uploaded. then send it to the server
    if($_FILES['image']['name'] != '')
    {
        //first get the files details.
        $file_name = filter($_FILES['image']['name']);
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $name_part = date("Ymdhis");

        $uploaded_name = $name_part . '_' . $file_name;

        $dest = "uploads/avatars/";

        //now get the destination location
        $destination = $dest . $uploaded_name;

        //now we validate our image here.
        define('MAX_FILE_SIZE', 20000000);

        // 1. Check the image size
        if($file_size > MAX_FILE_SIZE)
        {
            //Set an error alerting the user.
            $error = "File size is too large. Limit is 20Mb";
        }

        // 2. Check the file type.
        if($file_type != 'image/jpeg'  && $file_type != 'image/jpg'
                && $file_type != 'image/gif' && $file_type != 'image/png')
        {
            $error = "Sorry. The image type is not supported. Please use either jpg or png or gif";
        }

        if(!isset($error) || count($errors) == 0)
        {
            //we upload the photo
            if(move_uploaded_file($tmp_name, '../' . $destination))
            {
                //upload was successful
            }
            else
            {
                //uploading failed. so warn user and set destination to null
                $warning = "Logo could not be uploaded";
                $destination = '';
            }
        }
    }
    else {
        $user = new User($id);
        $destination = $user->photo;
    }

    //now upload if there is no error.
    if(!isset($error))
    {
        //insert into the db.
        $query = "UPDATE `users` SET "
                        . " `username` = '$username',  `full_name` = '$name', "
                        . " `position` = '$position', `tel` = '$contact', "
                        . " `email` = '$email', `avatar` = '$destination', "
                        . " `level` = '$level', `school` = '$school' "
                        . " WHERE `user_id` = '$id' ";
        $result = mysqli_query($dbc, $query)
                or die("Error" . mysqli_error($dbc));

        $success = "User Account Updated";
    }
}


$user = new User($id);

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
                          Edit User Information
                      </h2>

                      <br>
                      <form class="" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-12">
                                                Name of Worker
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="worker_name"
                                                required value="<?php echo $user->name; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-12">
                                                Position
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="position"
                                                required="true" value="<?php echo $user->position; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-5">
                                                Contact
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="contact"
                                                required="true" value="<?php echo $user->tel; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-5">
                                                Email

                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="email"
                                                value="<?php echo $user->email; ?>">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-8">
                                                User ID
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="user_id" readonly="true"
                                                       required="true" value="<?php echo $id; ?>" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-8">
                                                Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="username" required="true"
                                                       placeholder="Username used to login"
                                                       value="<?php echo $user->username; ?>" readonly>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-3">
                            <!--            <div style="margin-top:10px; float:left; width: 100px; height: 105px; border:1px solid #ccc; text-align: center; margin-left: 30px;">

                                        <input type="file" name="photo" class="form-control">
                                    </div>-->


                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="<?php echo $user->avatar; ?>" alt="User Photo"
                                            width="100px" height="100px" id="img">
                                        </div>

                                        <br>
                                        <br>
                                        <div class="col-md-9">
                                          <h6 class="page-title"> <strong>User Level <strong> </h6>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::PERSONNEL_ADMINISTRATOR; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::PERSONNEL_ADMINISTRATOR; ?>"
                                                        required <?php if($user->level == UserLevel::PERSONNEL_ADMINISTRATOR) { echo 'checked'; } ?> >
                                                        <label class="custom-control-label" for="<?php echo UserLevel::PERSONNEL_ADMINISTRATOR;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::PERSONNEL_ADMINISTRATOR); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::SCHOOL_ACCOUNTANT; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::SCHOOL_ACCOUNTANT; ?>"
                                                        required <?php if($user->level == UserLevel::SCHOOL_ACCOUNTANT) { echo 'checked'; } ?>>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::SCHOOL_ACCOUNTANT;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::SCHOOL_ACCOUNTANT); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::SCHOOL_PRINCIPAL; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::SCHOOL_PRINCIPAL; ?>"
                                                        required <?php if($user->level == UserLevel::SCHOOL_PRINCIPAL) { echo 'checked'; } ?>>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::SCHOOL_PRINCIPAL;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::SCHOOL_PRINCIPAL); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::FINANCE_CONTROLLER; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::FINANCE_CONTROLLER; ?>"
                                                        required <?php if($user->level == UserLevel::FINANCE_CONTROLLER) { echo 'checked'; } ?>>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::FINANCE_CONTROLLER;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::FINANCE_CONTROLLER); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::BISHOP; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::BISHOP; ?>"
                                                        required <?php if($user->level == UserLevel::BISHOP) { echo 'checked'; } ?>>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::BISHOP;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::BISHOP); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <br>
                                    <div class="row
                                    <?php
                                    if($user->level == UserLevel::PERSONNEL_ADMINISTRATOR
                                            || $user->level == UserLevel::BISHOP)
                                    {
                                        echo 'hide';
                                    }
                                    else {
                                        echo 'show';
                                    }
                                     ?>
                                    " id="school">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name" class="control-label col-md-8">
                                                    School
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-md-12">
                                                    <select class="form-control" name="school" >
                                                        <option value=""></option>
                                                        <?php
                                                        $query = "SELECT * FROM `schools` ";
                                                        $res = mysqli_query($dbc, $query);

                                                        while($row = mysqli_fetch_array($res))
                                                        {
                                                            ?>
                                                        <option value="<?php echo $row['id']; ?>"
                                                            <?php if($user->school == $row['id']) { echo 'selected'; } ?> >
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

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" name="button" class="btn btn-primary">
                                            Update Account
                                        </button>
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

         //declare constants
         const PERSONNEL_ADMINISTRATOR = 1;
         const SCHOOL_ACCOUNTANT = 2;
         const SCHOOL_PRINCIPAL = 3;
         const FINANCE_CONTROLLER = 4;
         const BISHOP = 10;

         //normal variables
         $school = $("#school");

         $('.radio').click(function(){
             var value = $(this).val();

             if(value == PERSONNEL_ADMINISTRATOR
                || value == BISHOP )
            {
                hideSchool();
            }
            else {
                showSchool();
            }
         });

         function showSchool()
         {
             if($school.hasClass("hide"))
             {
                 $school.removeClass("hide");
             }

             $school.addClass("show");
         }

         function hideSchool()
         {
             if($school.hasClass("show"))
             {
                 $school.removeClass("show");
             }

             $school.addClass("hide");
         }

         function readURL(input) {

          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#img').attr('src', e.target.result);

              $('#img').hide();
              $('#img').fadeIn(650);

            }

            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#image").change(function() {
          readURL(this);
        });
     });
 </script>
 <?php
include_once 'includes/end.php';
  ?>
