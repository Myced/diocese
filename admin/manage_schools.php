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

//page application logic
if(isset($_GET['id']))
{
    $id = filter($_GET['id']);
    $action = filter($_GET['action']);

    if($action == "del")
    {
        //delete the school
        $query = "DELETE FROM `schools` WHERE `id` = '$id' ";
        $result = mysqli_query($dbc, $query)
            or die("Could not delete school");

        $success = "School Deleted";
    }
}

/**
To show an error, just put the error message in a variable $error
Same goes too for a success message ($success)
=> eg $error = "Could not log in user"
    $success = "You activated your account";
**/

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
                          Manage Schools
                      </h2>

                      <br><br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="table-responsive">

                                  <?php

                                  $count = 1;
                                  //get the schools
                                  $query = "SELECT * FROM `schools` ";
                                  $result = mysqli_query($dbc, $query)
                                    or die("Error, Could not get the schools");

                                   ?>

                                   <table class="table table-hover">
                                       <tr>
                                           <th>S/N</th>
                                           <th>Logo</th>
                                           <th>Name</th>
                                           <th>Abbreviation</th>
                                           <th>Address</th>
                                           <th>Telephone</th>
                                           <th>Email</th>
                                           <th>Website</th>
                                           <th>Action</th>
                                       </tr>

                                       <?php
                                       if(mysqli_num_rows($result) == 0)
                                       {
                                           ?>
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <strong class="text-primary">No Schools added yet</strong>
                                            </td>
                                        </tr>
                                           <?php
                                       }
                                       else {
                                           while($row = mysqli_fetch_array($result))
                                           {
                                               $log = $row['logo'];
                                               if(empty($log))
                                               {
                                                   $logo = Constants::DEFAULT_SCHOOL_LOGO;
                                               }
                                               else {
                                                   $logo = '../' . $log;
                                               }
                                               ?>
                                             <tr>
                                                 <td> <?php echo $count++; ?> </td>
                                                 <td>
                                                     <img src="<?php echo $logo; ?>" alt="School Logo"
                                                        width="100px" height="100px">
                                                 </td>

                                                 <td> <strong><?php echo $row['name']; ?></strong> </td>
                                                 <td> <?php echo $row['abbreviation']; ?> </td>
                                                 <td> <?php echo $row['address']; ?> </td>
                                                 <td> <?php echo $row['tel']; ?> </td>
                                                 <td> <?php echo $row['email']; ?> </td>
                                                 <td> <?php echo $row['website']; ?> </td>
                                                 <td>
                                                     <a href="edit_school.php?id=<?php echo $row['id']; ?>"
                                                         class="btn btn-xs btn-primary" title="Edit School">
                                                         <i class="fa fa-pencil"></i>
                                                         Edit
                                                     </a>

                                                     <a href="#" data-id1="<?php echo $row['id']; ?>"
                                                         class="btn btn-xs btn-danger delete" title="Delete School" >
                                                         <i class="fa fa-trash"></i>
                                                         Del
                                                     </a>
                                                 </td>
                                             </tr>
                                               <?php
                                           }
                                       }
                                        ?>

                                   </table>
                              </div>
                          </div>
                      </div>
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
        var url = "manage_schools.php?action=del&id=";

        $(".delete").click(function(){
            var data = $(this).data("id1");
            url += data;
            if(confirm("Do you want to delete this school ?"))
            {
                window.location.href=url;
            }
        });
    });
</script>
 <?php
include_once 'includes/end.php';
  ?>
