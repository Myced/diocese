<?php
/**
 *
 */
class Requisition
{
    public $dbc;
    public $code;

    function __construct($dbc, $code)
    {
        $this->code = $code;
        $this->dbc = $dbc;
    }

    public function getAmount($itemCode)
    {
        $query = "SELECT `amount` FROM `req_content`
            WHERE `req_code` = '$this->code'
            AND `item_code` = '$itemCode' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        if(mysqli_num_rows($result) == 0)
        {
            return NULL;
        }
        else {
            list($amount) = mysqli_fetch_array($result);
            return $amount;
        }
    }

    public function getJustification($itemCode)
    {
        $query = "SELECT `justification` FROM `req_content`
            WHERE `req_code` = '$this->code'
            AND `item_code` = '$itemCode' ";
        $result = mysqli_query($this->dbc, $query)
            or die("Error");

        if(mysqli_num_rows($result) == 0)
        {
            return NULL;
        }
        else {
            list($justification) = mysqli_fetch_array($result);
            return $justification;
        }
    }

    public function saveResponse($itemCode, $itemName, $amount, $justification)
    {
        //check the response
        $dbc = $this->dbc;

        $response = $this->getAmount($itemCode);

        if($response == NULL)
        {
            //insert
            $this->insert($itemCode, $itemName, $amount, $justification);
        }
        else {
            if($response == $amount)
            {
                if($justification == $this->getJustification($itemCode))
                {
                    //do nothing
                }
                else {
                    $this->update($itemCode, $amount, $justification);
                }
            }
            else {
                $this->update($itemCode, $amount, $justification);
            }
        }
    }

    public function insert($code, $name, $amount, $justification)
    {
        $query = "INSERT INTO `req_content`
            (`req_code`, `item_code`, `item_name`,
                `amount`, `justification`
            )

            VALUES
            ('$this->code', '$code', '$name',
                '$amount', '$justification'
            )
        ";

        $this->dbc->query($query);
    }

    public function update ($code, $amount, $justification)
    {
        $query = "UPDATE  `req_content` SET
                `amount` = '$amount',
                `justification` = '$justification'
            WHERE `req_code` = '$this->code'
            AND `item_code` = '$code'

        ";

        $this->dbc->query($query);
    }

    public function getContent()
    {
        $query = "SELECT * FROM `req_content`
                WHERE `req_code` = '$this->code' ";

        $result = $this->dbc->query($query);
        return $result;
    }
}

 ?>
