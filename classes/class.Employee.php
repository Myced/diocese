<?php
/**
 *
 */
class Employee
{
    private $dbc;

    public $matricule;

    public $prefix;
    public $fname;
    public $mname;
    public $lname;
    public $oname;

    public $name;

    public $nationality;
    public $sex;
    public $tel;
    public $email;
    public $empDay;
    public $empMonth;
    public $empYear;

    public $emptDate;

    public $birthDay;
    public $birthMonth;
    public $birthYear;

    public $birthDate;
    public $birthPlace;

    public $idNumber;
    public $idIssue;

    public $issueDate;
    public $expireDate;

    public $sacramentalStatus;
    public $maritalStatus;
    public $maritalStatusID;
    public $personalStatus;

    public $children;
    public $dependents;
    public $adopted;

    public $ICEName;
    public $ICERelation;
    public $ICETel1;
    public $ICETel2;

    public $schoolID;
    public $school;
    public $functionID;
    public $function;
    public $competence;
    public $residence;

    public $qualificationID;
    public $qualification;

    public $avatar;
    public $photo;

    function __construct($matricule)
    {
        $db = new dbc();
        $dbc = $db->get_instance();

        $this->dbc = $dbc;
        $this->matricule  = $matricule;

        //get the information
        $query = "SELECT * FROM `employees` WHERE `matricule` = '$matricule' ";
        $result = mysqli_query($dbc, $query)
            or die("Error, cannot get the information");

        while($row = mysqli_fetch_array($result))
        {
            $this->prefix = $row['prefix'];
            $this->fname = $row['f_name'];
            $this->mname = $row['m_name'];
            $this->lname = $row['l_name'];
            $this->oname = $row['o_name'];

            $this->name = $this->fname . ' ' . $this->mname . ' '
                . $this->lname . ' ' . $this->oname;

            $this->sex = $row['sex'];
            $this->tel = $row['contact'];
            $this->email = $row['email'];
            $this->empDay = $row['entry_day'];
            $this->empMonth = $row['entry_month'];
            $this->empYear = $row['entry_year'];
            $this->nationality = $row['nationality'];

            $this->empDate = $row['entry_day'] . '/' .
                $row['entry_month'] . '/' . $row['entry_year'];

            $this->birthDay = $row['day'];
            $this->birthMonth = $row['month'];
            $this->birthYear = $row['year'];

            $this->birthDate = $row['day'] . '/' . $row['month'] . '/' .
                        $row['year'];

            $this->birthPlace = $row['birth_place'];
            $this->idNumber = $row['idcard'];
            $this->idIssue = $row['id_issue'];
            $this->issueDate = $row['date_issue'];
            $this->expireDate = $row['date_expire'];

            $this->sacramentalStatus = $row['sac'];
            $this->maritalStatusID = $row['married'];
            $this->setMaritalStatus($row['married']);
            $this->personalStatus = $row['status'];

            $this->children = $row['children'];
            $this->dependents = $row['dependent'];
            $this->adopted = $row['achildren'];

            $this->setICE();

            $this->schoolID = $row['school_id'];
            $this->setSchool($row['school_id']);

            $this->functionID  = $row['position'];
            $this->setFunction($row['position']);

            $this->competence = $row['competence'];
            $this->residence = $row['residence'];

            $this->qualificationID = $row['hqual'];
            $this->setQualification($row['hqual']);

            $this->photo = $row['profile'];

            $this->setAvatar($row['profile']);
        }
    }

    private function setMaritalStatus($status)
    {
        if($status == '1')
        {
            $maritalStatus = 'Single';
        }
        elseif($status == '2')
        {
            $maritalStatus = "Married";
        }
        elseif($status == '3')
            $maritalStatus = "Divorced";
        elseif($status == '4')
            $maritalStatus = 'Separated';
        elseif($status == '5')
            $maritalStatus == 'Fiance';
        elseif($status == '6')
            $maritalStatus = 'Widowed';
        else {
            $maritalStatus = "Unknown";
        }

        $this->maritalStatus = $maritalStatus;
    }

    private function setICE()
    {
        $matricule = $this->matricule;

        $query ="SELECT * FROM `personnel_nok` WHERE `employee_id` = '$matricule' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        while($row = mysqli_fetch_array($result))
        {
            $this->ICEName = $row['name_ice'];
            $this->ICERelation = $row['relation_ice'];
            $this->ICETel1 = $row['tel1_ice'];
            $this->ICETel2 = $row['tel2_ice'];
        }
    }

    private function setQualification($id)
    {
        $query = "SELECT `fname` FROM `qualification` WHERE `id` = '$id' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        list($qualification) = mysqli_fetch_array($result);

        $this->qualification = $qualification;
    }

    private function setSchool($id)
    {
        $query = "SELECT `name` FROM `schools` WHERE `id` = '$id' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        list($school) = mysqli_fetch_array($result);

        $this->school = $school;
    }

    private function setFunction($id)
    {
        $query = "SELECT `function` FROM `functions` WHERE `id` = '$id' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        list($function) = mysqli_fetch_array($result);

        $this->function = $function;
    }

    private function setAvatar($photo)
    {
        $avatar = '';
        if(empty($photo))
        {
            $avatar = Constants::DEFAULT_AVATAR;
        }
        else {
            if(file_exists('../' . $photo))
            {
                $avatar  = $photo;
            }
            else {
                $avatar = Constants::DEFAULT_AVATAR;
            }
        }

        $this->avatar = '../' . $avatar;
    }

    public function getMedals()
    {
        $query = "SELECT * FROM `medals` WHERE `matricule` = '$this->matricule' ";
        $result = $this->dbc->query($query);

        return $result;
    }

    public function getSchoolsAttended()
    {
        $query = "SELECT * FROM `schools_attended` WHERE `matricule` = '$this->matricule'";
        return $this->dbc->query($query);
    }

    public function getWorkExperience()
    {
        $query = "SELECT * FROM `work_experience` WHERE `matricule` = '$this->matricule' ";
        return $this->dbc->query($query);
    }

    public function getFiles()
    {
        $query = "SELECT * FROM `files` WHERE `matricule` = '$this->matricule' ";
        return $this->dbc->query($query);
    }
}

 ?>
