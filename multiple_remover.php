<?php

/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 10/24/2017
 * Time: 9:36 PM
 */

class multiple_remover
{
protected $db;
protected $area;
protected $date;
protected $result;

    /**
     * @return mixed
     */
    public function __construct()
    {
       $this->date=date("Y-m-d");
       $this->db=new db();

    }

    /**
     * @param mixed $db
     */

    public function setArea($area)
    {
        $this->area = $area;
    }
    public function checksamerange(){

    }
    public function checkmultiple()
    {

        $this->db->setQuery('SELECT * FROM gaugeinformation WHERE Date="'.$this->date.'" AND  Area="'.$this->area.'"');
       $this->result= $this->db->getResults();
      $this->multiaction();
    }

    public function multiaction(){
if(mysqli_num_rows($this->result)>1){
    $arr=array();
    while ($row=mysqli_fetch_assoc($this->result))
    {
        $arr[$row["Time"]]=$row["Range"];
    }
    $maxs = array_keys($arr, max($arr));
    unset($arr[$maxs[0]]);
    foreach ($arr as $key=>$value){
        $this->db->setQuery('DELETE FROM gaugeinformation WHERE Time="'. $key .'" AND Area="'. $this->area .'"  AND Date="'.$this->date.'"');
    }
$this->db->close();


}
}
    }

