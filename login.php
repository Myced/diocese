<?php
//start by including the scripts required for this page
include_once 'classes/class.Company.php';
include_once 'classes/class.dbc.php';
include_once 'classes/function_login.php'; //contains our filter function and other functions
include_once 'classes/day.php'; //contains values for current day, month and year
include_once 'classes/class.AccountStatus.php';
include_once 'classes/class.User.php'; //instantiates a user object;
include_once 'classes/class.UserLevel.php';
include_once 'classes/class.AccountType.php';

$db = new dbc();
$dbc = $db->get_instance();

if(isset($_POST['username']))
{
    //log the user in
    //grab thee username and passwor
    $user_name = filter($_POST['username']);
    $password = filter($_POST['password']);

    // check these and compare them.
    $query = "SELECT * FROM `users` WHERE `username` = '$user_name'";

    $result = mysqli_query($dbc, $query)
            or die("Cannot query");

    if(mysqli_num_rows($result) == 1)
    {
        //nwo get the persons details.
        while($row = mysqli_fetch_array($result))
        {
            $pass = $row['password'];
            $user_id = $row['user_id'];
            $level = $row['level'];
            $status = $row['account_status'];
            $avatar = $row['avatar'];
            $account_type = $row['account_type'];
            $school = $row['school'];

        }

        //compare the two passwords
        if(password_verify($password, $pass))
        {
            //check that the user is authorised to do the login.

            if($status == AccountStatus::BLOCKED) {
                $error = "Sorry. Your Account has been blocked. Please contact admin";
            }
            elseif($status == AccountStatus::SUSPENDED)
            {
                $error = "Sorry. Your Account has been suspended. Please contact admin";
            }
            else {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['level'] = $level;
                $_SESSION['username'] = $user_name;
                $_SESSION['avatar'] = $avatar;
                $_SESSION['account_type'] = $account_type;
                $_SESSION['school'] = $school;


                //register the login into the login table.
                $query = "INSERT INTO `login` SET `user_id` = '$user_id',
                        `date` = '$date'";
                $result = mysqli_query($dbc, $query)
                    or die("Could not complete login");

                //send the person now to the index page-break-inside
                //check the user level

                if($level == AccountType::GENERAL)
                {
                    //redirect to the general admin page
                    header("Location: admin/index.php");
                }
                else {
                    //redirec to the School
                    header("Location: school/index.php");
                }


              }
        }
        else
        {
            $error = "Invalid Username or Password";
        }
    }
    else
    {
        //error
        $error = "Invalid Username or Password";
    }

}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="assets/css/login.css">
    </head>
    <body style="background-color: #56baed;">

        <!------ Include the above in your HEAD tag ---------->

        <div class="wrapper fadeInDown">
          <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
              <img src="assets/images/logo.png" id="icon" alt="Dioces Logo" class="login-logo" />
            </div>

            <!-- Login Form -->
            <form method="post" action="">
                <?php
                if(isset($error))
                {
                    ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                    <?php
                }
                 ?>

              <input type="text" id="login" class="fadeIn second input" name="username" placeholder="Username">
              <input type="password" id="password" class="fadeIn third input" name="password" placeholder="Password">
              <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
              <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

          </div>
        </div>
    </body>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</html>
