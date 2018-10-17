<?php
include_once '../../classes/class.Company.php';
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db = new dbc();
$dbc = $db->get_instance();


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Print </title>

        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/print.css">
    </head>
    <body>
        <div class="page" id="page">

            <div class="main">
                <!-- /page content -->
            </div>

            <div class="divFooter">
                Printed On
                <span class="text-italics">
                    <?php echo date("d/m/Y"); ?>
                </span>
                At
                <span class="text-italics">
                    <?php echo date("h:i:s"); ?>
                </span>
            </div>
        </div>
    </body>
</html>
