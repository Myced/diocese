<?php
/**
 *
 */
class EmployeeStatistics
{
    private $dbc;

    function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    public function getEmployeeCount()
    {
        $query = "SELECT * FROM `employees`";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getAdminstrativeCount()
    {
        /**
        @var teacher = 2 // id of teacher in the database
        **/
        $teacher = '2';

        //get all employees who are not teachers
        $query = "SELECT * FROM `employees` WHERE `position` <> '$teacher' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getNonAdministrativeEmployees()
    {
        $teacher = 2;

        //get all employees who are not teachers
        $query = "SELECT * FROM `employees` WHERE `position` = '$teacher' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getNewEmployeesCount()
    {
        $start_year  = date("Y");

        //the year should be 2 years earlier
        $year = $start_year - 2;

        //get all employees who are not teachers
        $query = "SELECT * FROM `employees` WHERE `entry_year` >= '$year' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getMaleCount()
    {
        $query = "SELECT * FROM `employees` WHERE `sex` = 'M' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getFemaleCount()
    {
        $query = "SELECT * FROM `employees` WHERE `sex` <> 'M' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getClergyCount()
    {
        $query = "SELECT * FROM `employees`
                    WHERE `status` = 'Clergy & Religious'
                    OR `status` = 'Clergy &amp; Religious' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getNonClergyCount()
    {
        $query = "SELECT * FROM `employees`
                    WHERE `status` = 'Non Clergy' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }

    public function getSchoolCount($id)
    {
        $query = "SELECT * FROM `employees` WHERE `school_id` = '$id' ";
        $result = $this->dbc->query($query);

        return $result->num_rows;
    }
}

 ?>
