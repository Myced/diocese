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
include_once '../classes/class.EmployeeStatistics.php';

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

//create an instance of statitics
$statistics = new EmployeeStatistics($dbc);

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
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-aqua">
                 <div class="inner">
                   <h3><?php echo $statistics->getEmployeeCount(); ?></h3>

                   <p class="text-left bigger">Total Employees</p>
                 </div>
                 <div class="icon">
                   <i class="fa fa-users"></i>
                 </div>
                 <a href="employee_list.php" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-green">
                 <div class="inner">
                   <h3><?php echo $statistics->getAdminstrativeCount(); ?></h3>

                   <p class="text-left">Adminstrative Employees</p>
                 </div>
                 <div class="icon">
                   <i class="fa fa-adn"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-yellow">
                 <div class="inner">
                   <h3><?php echo $statistics->getNonAdministrativeEmployees(); ?></h3>

                   <p class="text-left">Teachers</p>
                 </div>
                 <div class="icon">
                   <i class="fa fa-child"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-red">
                 <div class="inner">
                   <h3><?php echo $statistics->getNewEmployeesCount(); ?></h3>

                   <p class="text-left">New Employees</p>
                 </div>
                 <div class="icon">
                   <i class="fa fa-rocket"></i>
                 </div>
                 <a href="#" class="small-box-footer">
                   More info <i class="fa fa-arrow-circle-right"></i>
                 </a>
               </div>
             </div>
             <!-- ./col -->
           </div>
           <!-- /.row -->

           <!-- //next row  -->
           <div class="row">
                <div class="col-md-3">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">N<sup>o</sup> Male </h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <h3>
                          <?php echo $statistics->getMaleCount(); ?>
                      </h3>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">N<sup>o</sup> Female </h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <h3>
                          <?php echo $statistics->getFemaleCount(); ?>
                      </h3>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">No <sup>o</sup> Clergy</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <h3>
                          <?php echo $statistics->getClergyCount(); ?>
                      </h3>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">Non Clergy</h3>
                    </div>
                    <div class="box-body">
                      <h3>
                          <?php echo  $statistics->getNonClergyCount(); ?>
                      </h3>
                    </div>
                    <!-- /.box-body -->

                    <!-- end loading -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                  <div class="col-md-6">
                      <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">School Employee Statistics</h3>
                            </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text12">
                                    <tr>
                                        <th>S/N</th>
                                        <th>School Name</th>
                                        <th> N<sup>o</sup> Employees </th>
                                    </tr>

                                    <?php
                                    $count = 1;
                                    $query = "SELECT * FROM `schools`";
                                    $schools = $dbc->query($query);
                                    while($row = $schools->fetch_object())
                                    {
                                        ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $statistics->getSchoolCount($row->id); ?></td>
                                    </tr>
                                        <?php
                                    }
                                     ?>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- end loading -->
                      </div>

                  </div>

                  <div class="col-md-6">
                      <!-- DONUT CHART -->
                         <div class="box box-danger">
                           <div class="box-header with-border">
                             <h3 class="box-title">School Employees Chat</h3>

                             <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                               </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                             </div>
                           </div>
                           <div class="box-body">
                             <canvas id="pieChart" style="height:250px"></canvas>
                           </div>
                           <!-- /.box-body -->
                         </div>
                         <!-- /.box -->
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
<script src="../assets/js/lib/Chart.js"></script>
<script type="text/javascript">
//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
<?php
//prepare pie chart decoration
//array of colors
$colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de' ];
$schoolCount = $schools->num_rows;
$count = 1;
 ?>
var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
var pieChart       = new Chart(pieChartCanvas)
var PieData        = [
  <?php
  mysqli_data_seek($schools, 0);

  while($row = $schools->fetch_object())
  {

      $thisColor = rand(0, 4);
      $theColor = $colors[$thisColor];
      ?>
      {
        value    : <?php echo $statistics->getSchoolCount($row->id); ?>,
        color    : '<?php echo $theColor; ?>',
        highlight: '<?php echo $theColor; ?>',
        label    : '<?php echo $row->name; ?>'
      }
      <?php
      if($count == $schoolCount)
      {

      }
      else {
          echo ',';
      }

      $count++;
  }
   ?>
]
var pieOptions     = {
  //Boolean - Whether we should show a stroke on each segment
  segmentShowStroke    : true,
  //String - The colour of each segment stroke
  segmentStrokeColor   : '#fff',
  //Number - The width of each segment stroke
  segmentStrokeWidth   : 2,
  //Number - The percentage of the chart that we cut out of the middle
  percentageInnerCutout: 50, // This is 0 for Pie charts
  //Number - Amount of animation steps
  animationSteps       : 100,
  //String - Animation easing effect
  animationEasing      : 'easeOutBounce',
  //Boolean - Whether we animate the rotation of the Doughnut
  animateRotate        : true,
  //Boolean - Whether we animate scaling the Doughnut from the centre
  animateScale         : false,
  //Boolean - whether to make the chart responsive to window resizing
  responsive           : true,
  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  maintainAspectRatio  : true,
  //String - A legend template
  legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Doughnut(PieData, pieOptions)

</script>
 <?php
include_once 'includes/end.php';
  ?>
