<?php
/**
 *
 */
class General
{
    private $dbc;

    function __construct()
    {
        $db = new dbc();
        $dbc = $db->get_instance();

        $this->dbc = $dbc;
    }

    function getSchools()
    {
        $query = "SELECT * FROM `schools` ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error, could not get the schools");

        return $result;
    }
}

 ?>
