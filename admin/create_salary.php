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

//initialise the database variable to use in the application
$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['matricule']))
{
    $matricule = filter($_GET['matricule']);
}
else {
    $matricule = '';
}

$employee = new Employee($matricule);

//then include static html
include_once 'includes/head.php';
 ?>
 <!-- enter custom css files needed for this page here  -->
<style media="screen">
    .form-control{
        color: black;
        font-size: 16px;
    }

    .heading {
        background-color: #41c4f5;
        padding: 10px;
    }
</style>
 <?php
include_once 'includes/top_bar.php'; //for the page title and logo and account information
include_once 'includes/navigation.php'; //page navigations.

  ?>

  <br>
  <div class="wrapper" id="app">
      <div class="container-fluid">

          <?php
          //show errors here
          include_once '../classes/notifications.php';
           ?>

          <div class="row">
              <div class="col-md-12">
                  <div class="card-box">
                      <h2 class="page-header">
                          Create Salary
                      </h2>

                      <br>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Name: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="name" class="form-control"
                                      placeholder="Employee Name" value="<?php echo $employee->name; ?>"
                                      disabled>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Matricule: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="name" class="form-control"
                                      placeholder="Employee Matricule" value="<?php echo $employee->matricule; ?>"
                                      disabled>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Function: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="function" class="form-control"
                                      placeholder="Function" value="<?php echo $employee->function; ?>"
                                      disabled>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- end of row -->

                      <!-- row -->
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Basic Salary: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="name" class="form-control"
                                      placeholder="Basic Salary" value="<?php echo ''; ?>"
                                      v-model="basicSalary" v-on:keyup="doCalculations" >
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">

                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Net Salary: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="name" class="form-control"
                                      placeholder="Net Salary" value="" v-model="netSalary"
                                      >
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- end row -->

                      <!-- row -->
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="heading">National Employment Fund</h4>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">CNPS (Worker): </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="cnps_worker" class="form-control"
                                      placeholder="CNPS Worker" value="<?php echo ''; ?>"
                                      v-model="CNPSWorker">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">CNPS Employer: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="cnps_employer" class="form-control"
                                      placeholder="CNPS Employer" value="<?php echo ''; ?>"
                                      v-model="CNPSEmployer">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- end row -->

                      <br>
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="heading">Fiscal Deductions</h4>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">CFC: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="cfc" class="form-control"
                                      placeholder="Housing Loan Fund" value="<?php echo ''; ?>"
                                      v-model="cfc">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">NEF: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="nef" class="form-control"
                                      placeholder="National Employment Fund" value="<?php echo ''; ?>"
                                      v-model="nef">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">RAV: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="rav" class="form-control"
                                      placeholder="Audio Visual Tax" value="<?php echo ''; ?>"
                                      v-model="rav">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">PIT: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="pit" class="form-control"
                                      placeholder="Personal Income Tax" value="<?php echo ''; ?>"
                                      v-model="pit">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">TC: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="tc" class="form-control"
                                      placeholder="Communal Tax" value="<?php echo ''; ?>"
                                      v-model="tc">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Other: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="other_tax" class="form-control"
                                      placeholder="Other Tax" value="<?php echo ''; ?>"
                                      v-model="otherTax">
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-6">
                              <h4 class="heading">Total Fiscal Deductions: <strong>{{ fiscalDeductions }} FCFA</strong> </h4>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="heading">Allowances</h4>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Admin Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="admin_allow" class="form-control"
                                      placeholder="Administrative Allowance" value="<?php echo ''; ?>"
                                      v-model="adminAllow">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Telephone Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="tel_allow" class="form-control"
                                      placeholder="Telephone Allowance" value="<?php echo ''; ?>"
                                      v-model="telAllow">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Fuel Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="fuel_allowance" class="form-control"
                                      placeholder="Fuel Allowance" value="<?php echo '3000'; ?>"
                                      v-model="fuelAllow">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Housing Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="house_allow" class="form-control"
                                      placeholder="Housing Allowance" value="<?php echo ''; ?>"
                                      v-model="houseAllow">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Duty Post Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="duty_post_allow" class="form-control"
                                      placeholder="Duty Post Allowance" value="<?php echo ''; ?>"
                                      v-model="dutyPost">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Other Allow: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="other_allow" class="form-control"
                                      placeholder="Other Allowances" value="<?php echo ''; ?>"
                                      v-model="otherAllow">
                                  </div>
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-6">
                              <h4 class="heading">Total Allowances: <strong>{{ totalAllow }} FCFA</strong> </h4>
                          </div>
                      </div>

                      <br>
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="heading">Other Deductions</h4>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">CC: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="cc" class="form-control"
                                      placeholder="Church Contributions" value="<?php echo ''; ?>"
                                      v-model="cc">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Water Bill: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="water_bill" class="form-control"
                                      placeholder="Water Bill" value="<?php echo ''; ?>"
                                      v-model="waterBill">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Electricity: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="electricity" class="form-control"
                                      placeholder="Electricity" value="<?php echo ''; ?>"
                                      v-model="electricity">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Penalty: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="penalty" class="form-control"
                                      placeholder="Penalty" value="<?php echo ''; ?>"
                                      v-model="penalty">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Loan: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="loan" class="form-control"
                                      placeholder="Loan" value="<?php echo ''; ?>"
                                      v-model="loan">
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group row">
                                  <label for="" class="col-sm-4 col-form-label">Other: </label>
                                  <div class="col-sm-8">
                                      <input type="text" name="other_deduction" class="form-control"
                                      placeholder="Other Deductions" value="<?php echo ''; ?>"
                                      v-model="otherDeductions">
                                  </div>
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-6">
                              <h4 class="heading">Total Other Deductions: <strong> {{ totalOtherDeductions }} CFA</strong> </h4>
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
<script src="../assets/js/lib/vue.js"></script>
<script type="text/javascript">

//declare all javascript variables here

    $app = new Vue({
        el: "#app",
        data: {
            ced: '00',
            basicSalary: '02',
            CNPSWorker: '',
            CNPSEmployer : '',
            cfc : '',
            nef : '',
            rav : '',
            pit  : '',
            tc  : '',
            otherTax : '',
            adminAllow : '',
            telAllow : '',
            fuelAllow : '',
            houseAllow : '',
            dutyPost : '',
            otherAllow : '',
            cc : '',
            waterBill : '',
            electricity : '',
            penalty : '',
            loan : '',
            otherDeductions : '',

            //calculated values
            netSalary : '',


        },
        methods:{
            saveNetSalary(amount)
            {
                this.netSalary = amount;
            },
            doCalculations(){
                this.CNPSWorker = this.getCNPSWorker;
                var net = ((+this.basicSalary - this.getCNPSWorker - +this.cc)
                        - this.fiscalDeductions) + this.totalAllow;

                console.log(net);
                this.saveNetSalary(net);
            }
        },
        computed:{
            fiscalDeductions()
            {
                 let total = +this.cfc + +this.nef + +this.rav +
                             +this.pit + +this.tc + +this.otherTax;
                 return total;
            },
            totalAllow(){
                return +this.adminAllow + +this.telAllow + +this.fuelAllow
                        + +this.dutyPost + +this.houseAllow + +this.otherAllow;
            },
            totalOtherDeductions()
            {
                return +this.cc + +this.waterBill + +this.electricity +
                       +this.penalty + +this.loan + +this.otherDeductions;
            },
            calcNetSalary(){
                return 0;
            },
            getCNPSWorker(){
                return +this.basicSalary * 0.042;
            }
        }
    })
</script>
 <?php
include_once 'includes/end.php';
  ?>
