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

/**
To show an error, just put the error message in a variable $error
Same goes too for a success message ($success)
=> eg $error = "Could not log in user"
    $success = "You activated your account";
**/


//post process here
if(isset($_POST['name']))
{
    $name = filter($_POST['name']);
    $address = filter($_POST['address']);
    $abbreviation = filter($_POST['abbreviation']);
    $tel = filter($_POST['tel']);
    $email = filter($_POST['email']);
    $website = filter($_POST['website']);

    $imageLocation = '';

    if(empty($name))
    {
        $error = "The School name cannot be empty";
    }

    if(!isset($error))
    {
        //upload image
        if(isset($_FILES['logo']))
        {
            $file_name = $_FILES['logo']['name'];
            $tmp_name  = $_FILES['logo']['tmp_name'];
            $file_type = $_FILES['logo']['type'];
            $file_size = $_FILES['logo']['size'];

            if(!empty($file_name))
            {
                //Now validate the file format
                if($file_type != "image/jpg" && $file_type != "image/jpeg" && $file_type != "image/gif"
                        && $file_type != "image/png" && $file_type != "image/tiff" )
                {
                    $error = "Sorry. Inappropriate File Type.
                        Acceptable Picture formats include \"jpg, jpeg, png, gif\"  ";
                }
                else {
                    //picture destination
                    $destination = Constants::SCHOOL_LOGO_PATH;
                    $date_string = date("Ymdhms") . '_';
                    $final_name = $date_string . $file_name;

                    $photo_location = $destination . $final_name;

                    //tryp uploading the file
                    if(move_uploaded_file($tmp_name, '../' . $photo_location))
                    {
                        $imageLocation = $photo_location;
                    }
                    else {
                        $warning = "Could not upload image";
                        $imageLocation = "";
                    }
                }


            }
        } //checking if the image was uploaded

        //now upload the image
        if(!isset($error))
        {
            //insert into the database
            $query = "INSERT INTO `schools` (
                `name`, `address`, `abbreviation`, `tel`,
                `email`, `website`, `logo`
            )
            VALUES(
                '$name', '$address', '$abbreviation', '$tel',
                '$email', '$website', '$imageLocation'
            )
            ";

            $result = mysqli_query($dbc, $query)
                or die("Error. Could not add School");

            $success = "School Added";
        }
    }
}

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
                          Add School
                      </h2>

                      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          <br>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-4 col-form-label bold">Name of School:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="name" id="name" class="form-control"
                                            placeholder="St Paul College " required>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Address:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="address" id="name" class="form-control"
                                            placeholder="Addrss">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Name Abbreviation:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="abbreviation" id="name" class="form-control"
                                            placeholder="E.g. BIROCOL">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Telephone:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="tel" id="name" class="form-control"
                                            placeholder="677-089-963">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Email:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="email"  class="form-control"
                                            placeholder="example@email.com">
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-5">
                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Website:</label>
                                      <div class="col-sm-8">
                                          <input type="text"  name="website" id="name" class="form-control"
                                            placeholder="www.school.com">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label  class="col-sm-4 col-form-label bold">Logo:</label>
                                      <div class="col-sm-8">
                                          <input type="file"  name="logo" id="logo" class="form-control">

                                            <br>
                                            <img src="<?php echo Constants::DEFAULT_SCHOOL_LOGO; ?>"
                                                alt="SCHOOL LOGO" id="img" width="250px" height="250px">
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="text-center">
                                      <button type="submit" name="add" class="btn btn-primary">
                                          Add School
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

        $("#logo").change(function() {
          readURL(this);
        });
     })
 </script>

 <?php
include_once 'includes/end.php';
  ?>
