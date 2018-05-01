<?php
include 'db.php';



/**********alert listing ***********/
/*
 *
 * 0=no data
 * 1=normal   <   130mm
 * 2=warning  >==130mm
 * 3=Danger   >==150mm
 *
 *
 /* ******End alert listing*********/


class Alert
{
    protected $old_alert;
    protected $todayold;
    protected $alert;
    protected $area;
    protected $db;
    protected $date;
    protected $arr2;
    protected $dailydata;
protected  $acceptnewday=0;
protected $telnoarray=array();
protected $message;
    public function __construct()
    {
        $this->date = date('Y-m-d');
        $this->db = new db();
       // $this->alert=5 ;
        // $this->dailydata=0;
       // $this->area = "MH";

    }

    /**
     * @return mixed
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * @return mixed
     */
    public function getArr2()
    {
        return $this->arr2;
    }


    public function areasearch()
    {
        $this->db->setQuery("SELECT area FROM gaugereportes");
        $allareas = $this->db->getResults();
        if (mysqli_num_rows($allareas) > 0) {
            while ($array_areas = mysqli_fetch_assoc($allareas)) {
                $this->area = $array_areas["area"];
                $this->allareadata();
            }
        }

    }



    public function allareadata()
    {

        $this->db->setQuery('SELECT * from gaugeinformation WHERE Area="' . $this->area . '" AND  Date BETWEEN "' . date("Y-m-d", strtotime("-4 day", strtotime(date("Y-m-d")))) . '" AND "' . $this->date . '"');
        $alldata = $this->db->getResults();
        if (mysqli_num_rows($alldata) > 0) {


            $arr = array(array(), array());
            $this->arr2 = array();
            while ($array_alldata = mysqli_fetch_assoc($alldata)) {

                array_push($arr[0], $array_alldata["Date"]);
                array_push($arr[1], $array_alldata["Range"]);
                if ($array_alldata["Date"] == date("Y-m-d")) {
                    $this->dailydata = 1;
                    array_push($this->arr2, (int)$array_alldata["Range"]);
                }
            }

            $count = count($arr[0]);
            for ($b = 1; $b < 5; $b++) {
                $c = 0;
                for ($a = 0; $a < $count; $a++) {
                    if (date("Y-m-d", strtotime("-". $b ." day", strtotime(date("Y-m-d")))) == $arr[0][$a]) {
                        array_push($this->arr2,(int)$arr[1][$a]);

                    }else
                        $c++;

                }
                if($c==$count){
                    array_push($this->arr2,0);
                }
            }
$this->oldalert();
$this->alert_creation();

            $this->db->setQuery('SELECT * FROM alert where Date="' . date("Y-m-d") . '" AND Area="' . $this->area . '"');
            if (mysqli_num_rows($this->db->getResults()) == 0) {

                $this->db->setQuery('  INSERT  INTO alert (Date, Area, status, Dailydata) VALUES ("' . date("Y-m-d") . '","' . $this->area . '","' .$this->alert . '","' . $this->dailydata . '") ');
$this->todayold=0;
            }
            else {
                /***get todayold data***/



             $this->db->setQuery('SELECT status FROM alert WHERE Area="' . $this->area . '" AND Date="' . date("Y-m-d") . '"');
                $result = $this->db->getResults();
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $this->todayold = $row["status"];
                    }


               }

               /*****end set  today old alert***/

               $this->db->setQuery('UPDATE alert SET  Dailydata="' . $this->dailydata . '" WHERE Date="' . date("Y-m-d") . '" AND Area="' . $this->area . '"');
                $this->db->setQuery('UPDATE alert SET  status ="' . $this->alert . '" WHERE Date="' . date("Y-m-d") . '" AND Area="' . $this->area . '"');
            }

            unset($this->arr);

        }



    else
            {
                $result=$this->db->setQuery('SELECT * FROM alert WHERE Area="' . $this->area . '" AND Date="' . date("Y-m-d") . '"');
if(mysqli_num_rows($result)==0){
    $this->db->setQuery('  INSERT  INTO alert (Date, Area, status, Dailydata) VALUES ("' . date("Y-m-d") . '","' . $this->area . '",0,0) ');

}
                $this->alert = 0;
                $this->todayold=0;

        }
        $this->Compare_alerts();
    }


public function oldalert()
{

    /***get old data***/
    $this->db->setQuery('SELECT status FROM alert WHERE Area="' . $this->area . '" AND Date="' . date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d")))) . '"');
    $result = $this->db->getResults();
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $this->old_alert = $row["status"];
        }
    }
    else
    {
        $this->old_alert = 0;

    }
    /*****end set old alert***/

}
    /*********alerts creating *********/
  public function alert_creation()
    {
        $alert=0;
        if(($this->arr2[0]>150)||(($this->arr2[0]<150)&&(($this->arr2[0]>140))&&($this->arr2[1]<150))
            ||(($this->arr2[0]<140)&&($this->arr2[0]>130)&&($this->arr2[1]>150)&&($this->arr2[2]>150))){
            $this->alert=3;
        }
        elseif(($this->arr2[0]>130)||(($this->arr2[0]>100)&&($this->arr2[0]<130)&&($this->arr2[1]>140)&&($this->arr2[2]>140))){
            $this->alert=2;
        }
        else{
            $this->alert=1;
        }


    }
    /**********end creating alert***********/


    public  function  Compare_alerts(){


if(mysqli_num_rows($this->db->setQuery('SELECT * from alert WHERE Area="'.$this->area.'" AND flag="0" AND Date="'. date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d")))).'"'))>0)
{
$this->db->setQuery('UPDATE alert SET flag=1 WHERE Area="'.$this->area.'"  AND Date="'. date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d")))).'" ');
$this->acceptnewday=1;
}

if($this->acceptnewday=="1"){
    $this->acceptnewday=0;
    $this->message();
}elseif ($this->todayold=="1" ||(($this->todayold=="2")&&($this->alert=="3") ))
{
    $this->message();

}




    }
public function message(){
    if($this->alert=="2"){
        $this->numarr();
     array_push($this->telnoarray,"DMC Badulla\n Warning \n Your area (".$this->area.")  is in a risk\n");
        $num=json_encode($this->telnoarray);
       $x=exec("python a.py $num");
      sleep(5);

    }

    if($this->alert=="3"){
        $this->numarr();

     array_push($this->telnoarray,"DMC Badulla\n Danger \n Your area (".$this->area.")  need to be evacuated\n");

        $num=json_encode($this->telnoarray);
       exec("python a.py $num");
       sleep(5);
       // echo $a;
    }

}
    public function numarr(){
       if(mysqli_num_rows( $gr=$this->db->setQuery('select tel_no FROM users JOIN gaugereportes ON users.user_id = gaugereportes.user_id WHERE area="'.$this->area.'"'))>0){
           while ($row=mysqli_fetch_assoc($gr)){
               array_push($this->telnoarray,$row["tel_no"]);
           }
       }
        if(mysqli_num_rows( $gr=$this->db->setQuery('select tel_no FROM users JOIN other ON users.user_id = other.user_id WHERE area="'.$this->area.'"'))>0){
            while ($row=mysqli_fetch_assoc($gr)){
                array_push($this->telnoarray,$row["tel_no"]);
            }
        }

       /* if(mysqli_num_rows( $gr=$this->db->setQuery('select tel_no FROM users JOIN admin ON users.user_id = admin.user_id'))>0){
            while ($row=mysqli_fetch_assoc($gr)){
                array_push($this->numarr(),$row["tel_no"]);
            }
        }*/
    }

    /**
     * @return array
     */
    public function getTelnoarray(): array
    {
        return $this->telnoarray;
    }


}


$a = new Alert();
$a->areasearch();
print_r($a->getTelnoarray());
print_r(($a->getAlert()));


