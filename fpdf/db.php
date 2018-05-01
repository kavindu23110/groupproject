<?php

/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 9/23/2017
 * Time: 3:48 PM
 */
class db
{
/* public  $user="project";
 public  $pass=" ";
 public  $*/

const  dbname="project";
const  username="root";
const  port="3306";
const host='localhost';
    const password=' ';
    protected $con;
    protected $query;
    protected $results;
    /**
     * db constructor.
     * @param $con
     */
public  function __construct()
{
    $this->con=mysqli_connect("localhost","root","","project","3306")or die("error");
}

    public function setQuery($query)
    {

      //  $this->con=mysqli_connect("localhost",username,password,dbname,port)or die("error");

        $this->query = $query;
        $this->results=mysqli_query($this->con,$this->query);
        return $this->results;
    }


    public function getCon()
    {
        return $this->con;
    }


    public function getResults()
    {
        return $this->results;
}


    public function fetch()
    {
     $a= $this->results;
     return $a->fetch_assoc();
    }


    public function close()
    {
        return mysqli_close($this->con);
    }

    /**
     * @return mixed
     */
    public function setmultiQuery($query)
    { $this->con=mysqli_connect("localhost","root","","project","3306")or die("error");
        $this->query = $query;
        $this->results=mysqli_multi_query($this->con,$this->query);

    }

}
/*$passcheck=new  db();
$passcheck->setQuery('SELECT * FROM users  WHERE  user_name="xyz"');
$result=$passcheck->getCon();
echo mysqli_affected_rows($result);*/