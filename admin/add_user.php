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


/////FUNCTION TO GENEREATE A USER ID
function gen_user_id()
{
    global $dbc;

    $query = "SELECT `id` FROM `users` ORDER BY  `id` DESC LIMIT 1";
    $result = mysqli_query($dbc, $query);

    list($id) = mysqli_fetch_array($result);

    $prefix = 'DIOCE-' . date("y") . 'U';

    $idd = $id + 1;

    if($idd < 10)
        $value = '000' . $idd;
    elseif($idd < 100)
        $value = '00' . $idd;
    elseif($idd < 1000)
        $value = '0' . $idd;
    else
        $value = $idd;

    return $prefix . $value;
}

//process page here
if(isset($_POST['worker_name']))
{
    $name = filter($_POST['worker_name']);
    $contact = filter($_POST['contact']);
    $position = filter($_POST['position']);
    $email = filter($_POST['email']);

    $user = filter($_POST['user_id']);
    $username = filter($_POST['username']);
    $password = filter($_POST['password']);
    $repeat_password = filter($_POST['repeat_password']);

    $hash = password_hash($password, PASSWORD_BCRYPT);

    //get the user level
    $level = filter($_POST['level']);
    $school  = filter($_POST['school']);

    //GET THE USER AGENT AND IP ADDRESS
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $destination = '';

    //check that the passwords Match
    if($password != $repeat_password)
    {
        $error = "Sorry. The passwords do not match";
    }

    //validate the username and pasword
    $query = "SELECT `username` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($dbc, $query)
             or die("Error. Could not look up db");
    if(mysqli_num_rows($result) > 0)
    {
        $error = "This Username already exist. Choose another one";
    }

    $query = "SELECT * FROM `users` WHERE `full_name` = '$name'";
    $result = mysqli_query($dbc, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $error = "This worker is already in the database. You can instead update his information";
    }

    //make sure the user_id is not in the database
    $query = "SELECT * FROM `users` WHERE `user_id` = '$user'";
    $result = mysqli_query($dbc, $query)
             or die("Error. Could not look up db");

    if(mysqli_num_rows($result) > 0)
    {
        //generate a new id
        $user = gen_user_id();
    }

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

    //now upload if there is no error.
    if(!isset($error))
    {
        //insert into the db.
        $query = "INSERT INTO `users` ("
                        . " `id`, `user_id`, `username`, `password`, `full_name`, `ip_address`, `user_agent`, "
                        . " `position`, `tel`, `email`, `avatar`, `time_added`, `level`, "
                        . " `day`, `month`, `year`, `date`, `mysql_date`, `school` )"
                        . ""
                        . " VALUES ("
                        . " 0, '$user', '$username', '$hash', '$name', '$ip', '$user_agent',"
                        . " '$position', '$contact', '$email', '$destination', NOW(), '$level', "
                        . " '$day', '$month', '$year', '$date', '$mysql_date', '$school')";
        $result = mysqli_query($dbc, $query)
                or die("Error" . mysqli_error($dbc));

        $success = "User Account Created";
    }
}

//generate the user id
$uid = gen_user_id();

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
                           Create New User Account
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
                                                <input type="text" class="form-control" name="worker_name" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-12">
                                                Position
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="position" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-5">
                                                Contact
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="contact" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-5">
                                                Email

                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="email" >
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
                                                       required="true" value="<?php echo $uid; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-8">
                                                Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="username" required="true"
                                                       placeholder="Username used to login">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-8">
                                                Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" name="password" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label col-md-8">
                                                Repeat Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" name="repeat_password" required="true">
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
                                            <img src="../<?php echo Constants::DEFAULT_AVATAR; ?>" alt="User Photo"
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
                                                        required>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::PERSONNEL_ADMINISTRATOR;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::PERSONNEL_ADMINISTRATOR); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::SCHOOL_ACCOUNTANT; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::SCHOOL_ACCOUNTANT; ?>"
                                                        required>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::SCHOOL_ACCOUNTANT;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::SCHOOL_ACCOUNTANT); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::SCHOOL_PRINCIPAL; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::SCHOOL_PRINCIPAL; ?>"
                                                        required>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::SCHOOL_PRINCIPAL;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::SCHOOL_PRINCIPAL); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::FINANCE_CONTROLLER; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::FINANCE_CONTROLLER; ?>"
                                                        required>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::FINANCE_CONTROLLER;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::FINANCE_CONTROLLER); ?>
                                                        </label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="level" value="<?php echo UserLevel::BISHOP; ?>"
                                                        class="custom-control-input radio" id="<?php echo UserLevel::BISHOP; ?>"
                                                        required>
                                                        <label class="custom-control-label" for="<?php echo UserLevel::BISHOP;  ?>">
                                                            <?php echo UserLevel::getUserLevel(UserLevel::BISHOP); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <br>
                                    <div class="row hide" id="school">
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

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" name="button" class="btn btn-primary">
                                            Add User
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
