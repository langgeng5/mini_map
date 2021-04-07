<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_SP
{
    private $CI;
    
    /**
      * The constructor
    */
    public function __construct() 
    {
        $this->CI = & get_instance();
    }
    

public function GetMultipleQueryResult($queryString)
{
    if (empty($queryString)) {
                return false;
            }

    $index     = 0;
    $ResultSet = array();

    /* execute multi query */
    if (mysqli_multi_query($this->db->conn_id, $queryString)) {
        do {
            if (false != $result = mysqli_store_result($this->db->conn_id)) {
                $rowID = 0;
                while ($row = $result->fetch_assoc()) {
                    $ResultSet[$index][$rowID] = $row;
                    $rowID++;
                }
            }
            $index++;
        } while (mysqli_next_result($this->db->conn_id));
    }

    return $ResultSet;
}    

}
?>