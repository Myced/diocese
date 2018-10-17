<?php
include_once '../../classes/class.Company.php';
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';
include_once '../../classes/class.Requisition.php';

$db = new dbc();
$dbc = $db->get_instance();

if(isset($_GET['code']))
{
    $code = filter($_GET['code']);
}
else {
    $code = '-1'; //invalid number
}

function getSchool($id)
{
    global $dbc;

    $query = "SELECT `name` FROM `schools` WHERE `id` = '$id' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    list($school) = mysqli_fetch_array($result);

    return $school;
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Requisition - <?php echo $code; ?> </title>

        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/print.css">
    </head>
    <body>
        <div class="page">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">

                            <?php
                            $count = 1;
                            $requisition = new Requisition($dbc, $code);
                            $items = $requisition->getContent();

                            $query = "SELECT * FROM `req_count`
                                  WHERE `req_code` = '$code' ";
                            $result  = mysqli_query($dbc, $query)
                              or die("Error");

                          if(mysqli_num_rows($result) == 0)
                          {
                              $school = '';
                              $inputer = '';
                              $authoriser = '';
                              $month = '';
                          }
                          else {
                              while($row = mysqli_fetch_array($result))
                              {
                                  $school = getSchool($row['school']);
                                  $inputer = $row['inputer'];
                                  $authoriser = $row['authoriser'];
                                  $month = $row['month'];
                                  $date_added = $row['time_added'];
                              }
                          }
                             ?>

                             <div class="row">
                                 <div class="col-md-6">

                                 </div>

                                 <div class="col-md-6">
                                     <div class="row">
                                         <dt class="col-sm-4 right-align">Added On: </dt>
                                         <dd class="col-sm-8"><?php echo date_from_timestamp($date_added); ?></dd>

                                         <dt class="col-sm-4 right-align">At: </dt>
                                         <dd class="col-sm-8"><?php echo time_from_timestamp($date_added); ?></dd>
                                     </div>
                                 </div>
                             </div>

                             <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <dt class="col-sm-4 right-align">Name of School: </dt>
                                        <dd class="col-sm-8"><?php echo $school; ?></dd>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <dt class="col-sm-4 right-align">Inputer: </dt>
                                        <dd class="col-sm-8"><?php echo $inputer; ?></dd>

                                        <dt class="col-sm-4 right-align">Authoriser: </dt>
                                        <dd class="col-sm-8"><?php echo $authoriser; ?></dd>

                                        <dt class="col-sm-4 right-align">Month: </dt>
                                        <dd class="col-sm-8"><?php echo $month; ?></dd>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h3 style="font-family: serif;" class="underline"><?php echo $code; ?></h3>
                                        <input type="hidden" name="" value="<?php echo $code; ?>" id="code">
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Amount</th>
                                                <th>Justification</th>
                                            </tr>

                                            <?php
                                            if($items->num_rows == 0)
                                            {
                                                ?>
                                          <tr>
                                              <td class="text-center" colspan="9">
                                                  <strong class="text-primary">No Items In this Requisition Request</strong>
                                              </td>
                                          </tr>
                                                <?php
                                            }
                                            else {
                                                while($row = $items->fetch_object())
                                                {
                                                    ?>
                                                  <tr>
                                                      <td><?php echo $count++; ?></td>
                                                      <td><?php echo $row->item_code; ?></td>
                                                      <td><?php echo $row->item_name ?></td>
                                                      <td><?php echo $row->amount; ?></td>
                                                      <td><?php echo $row->justification; ?></td>

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
            </div>

            <div class="divFooter">
                Printed On
                <span class="text-italics">
                    <?php echo date("d/m/Y"); ?>
                </span>
                At
                <span class="text-italics">
                    <?php echo date("h:i a"); ?>
                </span>
            </div>

        </div>
    </body>
</html>
