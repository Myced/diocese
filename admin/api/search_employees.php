<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';
include_once '../../classes/class.Constants.php';

$db  = new dbc();
$dbc  = $db->get_instance();

//functions here
function getFunction($id)
{
    global $dbc;

    $query = "SELECT `function` FROM `functions` WHERE `id` = '$id' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    list($function)  = mysqli_fetch_array($result);

    return $function;
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

$output = '';

$key = filter($_POST['key']);

$query = "SELECT * FROM `employees`
                WHERE `matricule` LIKE '%$key%'
                OR `fname` LIKE '%$key%'
                ORDER BY `fname` ASC LIMIT 50";
$result = mysqli_query($dbc, $query)
    or die("Error");

if(mysqli_num_rows($result) == 0)
{
    $output .= '<br> <br>';
    $output .= '<div class="col-md-12"><h3 class="text-white"> No Results Found </h3></div>';
    $output .= '<br> <br>';
}
else {
    while($row = mysqli_fetch_array($result))
    {
        $defaultUser = '../' . Constants::DEFAULT_AVATAR;
        $avatar = $row['profile'];
        if(!empty($avatar))
        {
            if(file_exists('../../' . $avatar))
            {
                $avatar = '../' . $avatar;
            }
            else {
                $avatar = $defaultUser;
            }
        }
        else {
            $avatar = $defaultUser;
        }

        $output .= '<div class="col-md-4">';
        $output .= '<div class="box box-widget widget-user-2">';
        $output .= '<div class="widget-user-header bg-yellow">';
        $output .= '<div class="widget-user-image">';
        $output .= '<img class="img-circle" src="'. $avatar .'" alt="User Avatar">';
        $output .= '</div>';
        $output .= '<h3 class="widget-user-username">' . $row['fname'] . '</h3>';
        $output .= '<h4 class="widget-user-desc">'. getFunction($row['position']) . '</h4>';
        $output .= '</div>';
        $output .= '<div class="box-footer no-padding">';
        $output .= '<ul class="nav nav-stacked nav-me">';
        $output .= '<li>';
        $output .= '<a href="#">
                        Matricule :
                        <strong> ' . $row['matricule'] . '</strong>
                    </a>';
        $output .= '</li>';
        $output .= '<li>
                        <a href="#">Employed : <strong> ' . $row['entry_day'] . '/' .
                              $row['entry_month'] . '/' . $row['entry_year'] . '</strong>
                        </a>
                   </li>';
        $output .= '<li>
                        <a href="#">
                            Current School :
                            <span class="">
                                <strong>
                                    ' . getSchool($row['school_id']) . '
                                </strong>
                            </span>
                        </a>
                    </li>';
        $output .= '<li><a href="#">
                        Telephone :
                        <strong class=""> ' . $row['contact'] . '</strong>
                          </a>
                    </li>';
        $output .= '<li class="text-center last-list">
                        <span>
                            <a href="edit_profile.php?matricule=' . $row['matricule'] . '" class="btn btn-primary edit">
                            <i class="fa fa-pencil"></i>
                            Edit
                              </a>
                      </span>

                        <span>
                            <a href="employee_details.php?matricule=' . $row['matricule'] . '"
                                class="btn btn-warning">
                                <i class="fa fa-list-alt"></i>
                                Details
                            </a>
                        </span>

                        <span>
                            <a href="#" class="btn btn-warning biodata"
                            data-id1="' . $row['matricule'] . '">
                                <i class="fa fa-print"></i>
                                Print Biodata
                            </a>
                        </span>

                        <span>
                            <a href="#" class="btn btn-danger delete"
                            data-id1="' . $row['matricule'] . '">
                                <i class="fa fa-trash"></i>
                                Delete
                            </a>
                        </span>
                    </li>';

        $output .= '</ul>
                  </div>
                </div>
              </div>';

    }
}


echo $output;


?>
