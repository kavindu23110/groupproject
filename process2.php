<?php
/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 10/22/2017
 * Time: 9:17 PM
 *
 *
 * gauge=20>
 * search==30>
 * insertreg=10--13
 * chart>21
 *
 *
 */
include_once "db.php";
include "usermodal.php";
date_default_timezone_set("Asia/Colombo");
session_start();
$user = unserialize($_SESSION["userdetails"]);

$usertype;
if ($user->getUserType() == "1") {
    $usertype = 1;
} else {
    $usertype = 0;
}

/*********************************insert start***************************/

if ($_SERVER["REQUEST_METHOD"] === 'POST' && "10" == $_POST["value"]) {

    $sql = "INSERT INTO users(name,nic,tel_no, user_name, password, email, user_type,activation,`by`)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','1'," . $usertype . ",'" . $user->getEmpId() . "')";
    $db = new db();
    if ($db->setQuery($sql)) {
        $id = mysqli_insert_id($db->getCon());
        if ($db->setQuery(' INSERT INTO admin(user_id,emp_id,designation)VALUES ("' . $id . '","' . $_POST["empid"] . '","' . $_POST["designation"] . '")')) {
            $db->close();
            echo "1";
        } else
            echo "0";

    } else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "11" == $_POST["value"]) {
    $db = new db();
    $sql = "INSERT INTO users(name,  nic,tel_no, user_name, password, email, user_type,activation,`by`)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','2'," . $usertype . ",'" . $user->getEmpId() . "')";

    if ($db->setQuery($sql)) {
        $id = mysqli_insert_id($db->getCon());
        if ($db->setQuery('INSERT INTO staff(user_id,emp_id,designation)VALUES ("' . $id . '","' . $_POST["empid"] . '","' . $_POST["designation"] . '")')) {
            $db->close();
            echo "1";

        } else
            echo "0";
    } else
        echo "0";

}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "12" == $_POST["value"]) {
    $db = new db();
    $sql = "INSERT INTO users(name,  nic,tel_no, user_name, password, email, user_type,activation,`by`)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','3'," . $usertype . ",'" . $user->getEmpId() . "')";

    if ($db->setQuery($sql)) {
        $id = mysqli_insert_id($db->getCon());
        if ($db->setQuery('INSERT INTO gaugereportes(user_id,area)VALUES  ("' . $id . '","' . $_POST["Area"] . '")')) {
            $db->close();
            echo "1";
        } else
            echo "0";

    } else
        echo "0";

}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "13" == $_POST["value"]) {
    $db = new db();
    $sql = "INSERT INTO users(name,  nic,tel_no, user_name, password, email, user_type,activation,`by`)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','4'," . $usertype . ",'" . $user->getEmpId() . "')";
    if ($db->setQuery($sql)) {
        $id = mysqli_insert_id($db->getCon());
        if ($db->setQuery('INSERT INTO other(user_id,area,designation)VALUES  ("' . $id . '","' . $_POST["Area"] . '","' . $_POST["designation"] . '")')) {
            $db->close();
            echo "1";
        } else
            echo "0";
    } else
        echo "0";


}

/**********************************insert end*****************************/


if ($_SERVER["REQUEST_METHOD"] === 'GET' && "20" == $_GET["value"]) {

    $search = new db();
    $search->setQuery('SELECT Area FROM gaugereportes');
    $result = $search->getResults();
    $arr = array();
    while ($val = mysqli_fetch_assoc($result)) {
        array_push($arr, $val['Area']);
    }
    $search->close();
    echo json_encode($arr);
}


if ($_SERVER["REQUEST_METHOD"] === 'POST' && "21" == $_POST["value"]) {


    $chart = new db();
    $chart->setQuery('SELECT * FROM gaugeinformation WHERE Date="' . $_POST["date"] . '"');
    $result = $chart->getResults();
    if (mysqli_num_rows($result) > 0) {
        $key = array();
        $value = array();
        $a;
        while ($val = mysqli_fetch_assoc($result)) {
            array_push($key, $val["Area"]);
            array_push($value, $val["Range"]);
        }
        $arr["value"] = $value;
        $arr["key"] = $key;

        echo json_encode($arr);


    } else
        echo "0";


}


if ($_SERVER["REQUEST_METHOD"] === 'GET' && $_GET["value"] === '30') {

    $search = new db();
    $search->setQuery('SELECT user_name FROM users WHERE user_name="' . $_GET["username"] . '"');
    $result = $search->getResults();
    if ($result->num_rows > 0) {
        echo "exits";
    } else {
        echo "not exits";
    }
    $search->close();
}

if ($_SERVER["REQUEST_METHOD"] === 'GET' && "22" == $_GET["value"]) {

    $search = new db();
    $search->setQuery('SELECT name FROM users ');
    $result = $search->getResults();
    $arr = array();
    while ($val = mysqli_fetch_assoc($result)) {
        array_push($arr, $val['name']);
    }
    $search->close();
    echo json_encode($arr);
}
if ($_SERVER["REQUEST_METHOD"] === 'GET' && "24" == $_GET["value"]) {

    $search = new db();
    $search->setQuery('SELECT nic FROM users ');
    $result = $search->getResults();
    $arr = array();
    while ($val = mysqli_fetch_assoc($result)) {
        array_push($arr, $val['nic']);
    }
    $search->close();
    echo json_encode($arr);
}

if ($_SERVER["REQUEST_METHOD"] === 'GET' && "25" == $_GET["value"]) {

    $con = new db();
    $con = $con->getCon();
    $sql = "SELECT emp_id FROM staff;";
    $sql .= "SELECT emp_id FROM admin";
    $arr = array();
    if (mysqli_multi_query($con, $sql)) {
        do {
            if ($result = mysqli_store_result($con)) {
                while ($row = mysqli_fetch_row($result)) {
                    array_push($arr, $row[0]);
                }
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($con));
    }
    echo json_encode($arr);
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && "14" == $_POST["value"]) {
    $sql = "INSERT INTO requests (name,nic,tel_no,user_name, password,  email, user_type, designation, emp_id) VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','2','" . $_POST["designation"] . "','" . $_POST["empid"] . "')";
    $db = new db();
    if ($db->setQuery($sql)) {
        echo "Request sent sucessfully ";
    }
    //$id=mysqli_insert_id($db->getCon());
    // $db->setQuery('INSERT INTO staff(user_id,emp_id,designation)VALUES ("' . $id . '","' . $_POST["empid"] . '","' . $_POST["designation"] . '")');
    $db->close();
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "15" == $_POST["value"]) {
    $sql = "INSERT INTO users(name,  nic,tel_no, user_name, password, email, user_type)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','3')";
    $db = new db();
    $db->setQuery($sql);
    $id = mysqli_insert_id($db->getCon());
    $db->setQuery('INSERT INTO gaugereportes(user_id,area)VALUES  ("' . $id . '","' . $_POST["Area"] . '")');
    $db->close();
    echo $id;
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && "16" == $_POST["value"]) {
    $sql = "INSERT INTO users(name,  nic,tel_no, user_name, password, email, user_type)VALUES ('" . $_POST["firstname"] . " " . $_POST["lastname"] . "','" . $_POST["nicno"] . "','" . $_POST["telno"] . "','" . $_POST["username"] . "','" . password_hash($_POST["password"], PASSWORD_BCRYPT) . "','" . $_POST["email"] . "','4')";
    $db = new db();
    $db->setQuery($sql);
    $id = mysqli_insert_id($db->getCon());
    $db->setQuery('INSERT INTO other(user_id,area,designation)VALUES  ("' . $id . '","' . $_POST["Area"] . '","' . $_POST["designation"] . '")');
    $db->close();
    echo $id;
}

