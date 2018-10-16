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
include_once '../classes/class.Employee.php';
include_once '../classes/class.Evaluation.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
}

//get the form submited
if(isset($_POST['button']))
{
    $term = filter($_GET['term']);
    $year = Constants::getAcademicYear($dbc);

    $trainingNeeded = filter($_POST['training_needed']);
    $justification = filter($_POST['justification']);
    $exceptionalWork = filter($_POST['exceptional_work']);
    $generalRemark = filter($_POST['general_remark']);

    //matricule has been gotten above;
    //save the responses
    $query = "SELECT * FROM `evaluation_essays`
        WHERE `matricule` = '$matricule'
        AND `term` = '$term'
        AND `year` = '$year'
    ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    if(mysqli_num_rows($result) == 0)
    {
        //insert
        $query = "INSERT INTO `evaluation_essays`
            (`matricule`, `term`, `year`,
                `training_needed`, `justification`, `exceptional_work`, `general_remark`
            )

            VALUES
            ('$matricule', '$term', '$year',
                '$trainingNeeded', '$justification', '$exceptionalWork', '$generalRemark'
            )
        ";

        $result = mysqli_query($dbc, $query)
            or die('Error' . mysqli_error($dbc));
    }
    else {

        $query = "UPDATE `evaluation_essays`
            SET `training_needed` = '$trainingNeeded',
            `exceptional_work` = '$exceptionalWork',
            `justification` = '$justification',
            `general_remark` = '$generalRemark'

            WHERE `matricule` = '$matricule'
            AND `year` = '$year' AND `term` = '$term'
        ";

        $result = mysqli_query($dbc, $query);
    }

    //create a new evaluation object
    $evaluation = new Evaluation($dbc, $matricule);
    $evaluation->setYear($year);
    $evaluation->setTerm($term);

    //get the question categories
    $query = "SELECT * FROM `evaluation_categories` ";
    $categories = mysqli_query($dbc, $query)
        or die("Error");

    while($row = mysqli_fetch_array($categories))
    {
        $catId = $row['id'];

        //get the questions
        $query = "SELECT * FROM `evaluation_questions`
        WHERE `category_id` = '$catId' ";

        $questions = mysqli_query($dbc, $query)
            or die("Error");

        while($r = mysqli_fetch_array($questions))
        {
            $questionId = $r['id'];

            //check if the response was in the post
            if(isset($_POST['__'. $questionId .'']))
            {
                $mark = filter($_POST['__'. $questionId .'']);

                //then save the answere
                $evaluation->saveResponse($questionId, $mark);
            }
        }
    }

    $success = "Evaluation Saved";

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
                          Edit Perfomance Information
                      </h2>

                      <?php
                      if(!isset($_GET['term']))
                      {
                          ?>
                      <form class="" action="" method="get">
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="form-group row">
                                      <label for="" class="col-sm-2 col-form-label"> </label>
                                      <div class="col-sm-10">
                                          <input type="hidden" name="matricule" value="<?php echo $matricule; ?>">
                                          <select class="form-control text-center" name="term">
                                                <option value="">--SELECT TERM--</option>
                                                <option value="1">Mid Term Evaluation</option>
                                                <option value="2">End of Year Evaluation</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-2">
                                  <input type="submit" name="filter" value="Process" class="btn btn-success">
                              </div>

                          </div>
                      </form>
                          <?php
                      }
                      else {
                          //get everything and work
                          $term = filter($_GET['term']);
                          $year = Constants::getAcademicYear($dbc);
                          $employee = new Employee($matricule);

                          $evaluation = new Evaluation($dbc, $matricule);
                          $evaluation->setTerm($term);
                          $evaluation->setYear($year);

                          $grantTotal = 0;


                          ?>
                          <form class="" action="" method="post">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label for="" class="col-sm-4 col-form-label"> Name of School: </label>
                                          <div class="col-sm-8">
                                              <input type="text" name="school" value="<?php echo $employee->school; ?>"
                                              class="form-control">
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="form-group row">
                                          <label for="" class="col-sm-4 col-form-label"> Employee Name: </label>
                                          <div class="col-sm-8">
                                              <input type="text" name="name" value="<?php echo $employee->name; ?>"
                                              class="form-control">
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group row">
                                          <label for="" class="col-sm-5 col-form-label"> Evaluation Period: </label>
                                          <div class="col-sm-7">
                                              <input type="hidden" name="term" value="<?php echo $term; ?>">
                                              <input type="text" name="t" value="<?php if($term == '1') {echo 'Mid Term Evaluation';}
                                              elseif($term == '2') {echo 'End of Year';}
                                              else{echo 'Unknown Period';}
                                               ?>"
                                              class="form-control">
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                      <div class="form-group row">
                                          <label for="" class="col-sm-4 col-form-label"> Year: </label>
                                          <div class="col-sm-8">
                                              <input type="text" name="year" value="<?php echo $year; ?>"
                                              class="form-control">
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <br>
                              <div class="row">
                                  <div class="col-md-12">
                                      <h3>Key Performace Indicators</h3>
                                  </div>
                              </div>

                              <?php
                              //get all the categories
                              $query = "SELECT * FROM `evaluation_categories` ";
                              $result = mysqli_query($dbc, $query)
                                or die("Error, could not get categoreis");



                              while($row = mysqli_fetch_array($result))
                              {
                                  $cat_id = $row['id'];
                                  $cat_total = 0;
                                  ?>
                                  <div class="row">
                                      <?php
                                      $count = 1;
                                       ?>
                                      <div class="col-md-12">
                                          <h4><?php echo $row['name']; ?></h4>

                                          <div class="table-responsive">
                                              <table class="table table-bordered table-striped">
                                                  <tr>
                                                      <th>S/N</th>
                                                      <th>KFI</th>
                                                      <th>0</th>
                                                      <th>1</th>
                                                      <th>2</th>
                                                      <th>3</th>
                                                      <th>4</th>
                                                      <th>5</th>
                                                  </tr>

                                                  <?php
                                                  $query = "SELECT * FROM `evaluation_questions` WHERE `category_id` = '$cat_id' ";
                                                  $questions = mysqli_query($dbc, $query)
                                                    or die('Error');

                                                 while($row = mysqli_fetch_array($questions))
                                                 {
                                                     //get the response of this question
                                                     $response = $evaluation->getResponse($row['id']);

                                                     if(!is_null($response))
                                                     {
                                                         $cat_total += $response;
                                                     }
                                                     ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['question']; ?></td>
                                                    <?php
                                                    for($i = 0; $i <= 5; $i++)
                                                    {

                                                        ?>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="<?php echo $row['id'] . $i; ?>"
                                                            name="__<?php echo $row['id']; ?>" value="<?php echo $i; ?>"
                                                            class="custom-control-input"
                                                            <?php if(!is_null($response)) { if($response == $i) { echo 'checked'; } }  ?> >
                                                            <label class="custom-control-label" for="<?php echo $row['id'] . $i; ?>">
                                                                <?php //echo $i; ?>
                                                            </label>
                                                        </div>

                                                    </td>
                                                        <?php
                                                    }
                                                    //unset the result
                                                     ?>
                                                </tr>
                                                     <?php
                                                 }
                                                 //add the grand total
                                                 $grantTotal += $cat_total;
                                                   ?>
                                              </table>
                                          </div>
                                      </div>
                                      <!-- end cols md 12 -->

                                      <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-8">

                                              </div>
                                              <div class="col-md-4">
                                                  <h3 class="head">Total : <strong><?php echo $cat_total; ?></strong> </h3>
                                              </div>
                                          </div>
                                      </div>

                                  </div>
                                  <?php
                              }
                                ?>

                                <?php
                                $query = "SELECT * FROM `evaluation_essays`
                                    WHERE `matricule` = '$matricule'
                                    AND `term` = '$term' AND `year` = '$year' ";
                                $result = mysqli_query($dbc, $query)
                                    or die('error');
                                if(mysqli_num_rows($result) == '')
                                {
                                    $trainingNeeded = '';
                                    $justification = '';
                                    $exceptionalWork  = '';
                                    $generalRemark = '';
                                }
                                else {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $trainingNeeded = $row['training_needed'];
                                        $justification = $row['justification'];
                                        $exceptionalWork = $row['exceptional_work'];
                                        $generalRemark = $row['general_remark'];
                                    }
                                }
                                 ?>

                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="text-center">
                                             <h2>Grand Total: <strong><?php echo $grantTotal; ?></strong> </h2>
                                         </div>
                                     </div>
                                 </div>
                                 <br><br>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Training Needed: </label>
                                            <div class="col-sm-8">
                                                <textarea name="training_needed" rows="5"
                                                class="form-control"><?php echo $trainingNeeded; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Justification: </label>
                                            <div class="col-sm-8">
                                                <textarea name="justification" rows="5"
                                                class="form-control"><?php echo $justification; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Exceptional Work Performed or Notification of Excellence : </label>
                                            <div class="col-sm-8">
                                                <textarea name="exceptional_work" rows="5"
                                                class="form-control"><?php echo $exceptionalWork; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">General Remark: </label>
                                            <div class="col-sm-8">
                                                <textarea name="general_remark" rows="5"
                                                class="form-control"><?php echo $generalRemark; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            
                                            <a href="view_perfomance.php" title="Back to Responses"
                                                class="btn btn-lg btn-warning" >
                                                <i class="fa fa-chevron-left"></i>
                                                Back to Responses
                                            </a>

                                            <button type="submit" name="button"
                                            class="btn btn-lg btn-primary" title="Save Responses">
                                            <i class="fa fa-save"></i>
                                            Save Responses
                                        </button>
                                        </div>
                                    </div>
                                </div>

                          </form>
                          <?php
                      }
                       ?>
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

 <?php
include_once 'includes/end.php';
  ?>
