<?php
/**
 *
 */
class Evaluation
{

    private $dbc;
    public $matricule;
    public $term;
    public $year;


    function __construct($dbc, $matricule)
    {
        $this->dbc = $dbc;
        $this->matricule = $matricule;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function setTerm($term)
    {
        $this->term = $term;
    }

    public function getResponse($question)
    {
        $term = $this->term;
        $year = $this->year;

        $query = "SELECT `mark` FROM `evaluation_responses` WHERE
            `matricule` = '$this->matricule' AND `term` = '$term'
            AND `year` = '$year' AND `question_id` = '$question'   ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error cannot get the response");

        if(mysqli_num_rows($result) == 0)
        {
            $mark =  NULL;
        }
        else {
            list($mark) = mysqli_fetch_array($result);
        }

        return $mark;
    }

    public function saveResponse($question, $mark)
    {
        //check if there is response
        $response = $this->getResponse($question);

        if(is_null($response))
        {
            $this->insertResponse($question, $mark);
        }
        else {
            if($response == $mark)
            {
                //do nothing
            }
            else {
                $this->updateResponse($question, $mark);
            }
        }

    }

    public function insertResponse($question, $mark)
    {
        $query = "INSERT INTO `evaluation_responses`
            (`matricule`, `question_id`, `mark`, `year`, `term`)
            VALUES
            ('$this->matricule', '$question', '$mark',
                '$this->year', '$this->term'
            )
        ";

        $result = $this->dbc->query($query);
    }

    public function updateResponse($question, $mark)
    {
        $query = "UPDATE `evaluation_responses`
                    SET `mark` = '$mark'
                    WHERE `matricule`  = '$this->matricule'
                    AND `term` = '$this->term'
                    AND `year` = '$this->year'
                    AND `question_id` = '$question'
                    ";

        $result = $this->dbc->query($query);
    }

    public function getCategoryTotal($category)
    {
        $query = "SELECT * FROM `evaluation_questions`
            WHERE `category_id` = '$category' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        $total = 0;

        while($row = mysqli_fetch_array($result))
        {
            $question = $row['id'];
            //get the questions and answers
            $query = "SELECT * FROM `evaluation_responses`
            WHERE `question_id` = '$question'
            AND `year` = '$this->year'
            AND `term` = '$this->term'
            AND `matricule` = '$this->matricule' ";

            $res = mysqli_query($this->dbc, $query)
                or die("Error ");

            while($r = mysqli_fetch_array($res))
            {
                $total += $r['mark'];
            }

        }

        return $total;
    }

    public function getCategoryTotalMark($category)
    {
        $query = "SELECT * FROM `evaluation_questions`
            WHERE `category_id` = '$category' ";
        $result = mysqli_query($this->dbc, $query )
            or die("Error ");
        $num = mysqli_num_rows($result);

        return $num * 5;
    }

}

 ?>
