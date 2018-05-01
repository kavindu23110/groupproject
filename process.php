<?php
include "db.php";
include_once "usermodal.php";
include "multiple_remover.php";
//include "Alert.php";
date_default_timezone_set("Asia/Colombo");

if ($_SERVER["REQUEST_METHOD"] === 'POST' && "1" == $_POST["value"]) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passcheck = new db();
    $passcheck->setQuery('SELECT * FROM users  WHERE  user_name="' . $username . '"');
    $hash = $passcheck->fetch();
    if (password_verify($password, $hash ["password"])) {
        if($hash["activation"]==1){
            //  echo"ssssssssssss";
            // echo 'Password is valid!';
            /*  set user modal object*/
            $user = new user();
            $user->setUserName($hash["user_name"]);
            $user->setUserId($hash["user_id"]);
            //  $user->setAddress($hash["address"]);
            $user->setNic($hash["nic"]);
            if ($hash["user_type"] == "1") {
                $passcheck->setQuery('SELECT * FROM admin  WHERE  user_id="' . $hash["user_id"] . '"');
                $type = $passcheck->fetch();
                $user->setDesignation($type["designation"]);
                $user->setUserType("1");
                $user->setEmpId($type["emp_id"]);
                session_start();
                $_SESSION["userdetails"] = serialize($user);
                echo '   <script> window.open("admin.php","_self","",true);  </script>';

            } elseif ($hash["user_type"] == "2") {
                $passcheck->setQuery('SELECT * FROM staff  WHERE  user_id="' . $hash["user_id"] . '"');
                $type = $passcheck->fetch();
                $user->setDesignation($type["designation"]);
                $user->setUserType("2");
                $user->setEmpId($type["emp_id"]);
                session_start();
                $_SESSION["userdetails"] = serialize($user);
                echo '   <script> window.open("staff.php","_self","",true);  </script>';
            } elseif ($hash["user_type"] == "3") {
                $passcheck->setQuery('SELECT * FROM gaugereportes  WHERE  user_id="' . $hash["user_id"] . '"');
                $type = $passcheck->fetch();
                $user->setUserType("3");
                $user->setGaugeNo($type["gauge_no"]);
                $user->setArea($type['area']);
                session_start();
                $_SESSION["userdetails"] = serialize($user);
                echo '   <script> window.open("gauge reporters.php","_self","",true);  </script>';
            } elseif ($hash["user_type"] == "4") {
                $passcheck->setQuery('SELECT * FROM other  WHERE  user_id="' . $hash["user_id"] . '"');
                $type = $passcheck->fetch();
                $user->setDesignation($type["designation"]);
                $user->setUserType("4");
                $user->setOtherId($type["other_id"]);
                echo '   <script> window.open("other.php","_self","",true);  </script>';

            } else {
                echo 'Please contact system adminstrator';
            }

        }else
        {
            echo     "0";
        }


    } else {
        echo 'Invalid username or  password.';

    }

}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "5" == $_POST["value"]) {
    $add = new db();

    if ($_POST["type"] === "update1") {
        if ($add->setmultiQuery("UPDATE users SET name='" . $_POST["name"] . "',address='" . $_POST["address"] . "',tel_no='" . $_POST["telno"] . "'WHERE  user_id='" . $_POST["userid"] . "';UPDATE staff SET designation='" . $_POST["designation"] . "'WHERE  user_id='" . $_POST["userid"] . "'") == false) {
            echo 'No record is changed';
        } else {
            echo "records change successfully";
        }
    } else if


    ($_POST["type"] === "update2"
    ) {

        $add->setmultiQuery("UPDATE users SET name='" . $_POST["name"] . "',address='" . $_POST["address"] . "',tel_no='" . $_POST["telno"] . "'WHERE  user_id='" . $_POST["userid"] . "';UPDATE gaugereporters SET area='" . $_POST["area"] . "'WHERE  user_id='" . $_POST["userid"] . "'");

        if (mysqli_affected_rows($add->getCon()) > 0) {
            echo 'Record change sucessfully';
        } else {
            echo 'No record is changed';
        }
    } else if ($_POST["type"] === "update3") {
        $add->setmultiQuery("UPDATE users SET name='" . $_POST["name"] . "',address='" . $_POST["address"] . "',tel_no='" . $_POST["telno"] . "'WHERE  user_id='" . $_POST["userid"] . "';UPDATE other SET area='" . $_POST["area"] . "'WHERE  designation='" . $_POST["designation"] . "'");

        if (mysqli_affected_rows($add->getCon()) > 0) {
            echo 'Record change sucessfully';
        } else {
            echo 'No record is changed';
        }

    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "9" == $_POST["value"]) {
    //echo "Data successfully added"echo "1";
    session_start();
    $user = unserialize($_SESSION["userdetails"]);
    $gauge = new db();
    // $gauge->setQuery('INSERT INTO gaugeinformation(Date,Time,Area,Method,`Range`)VALUES ("'.date("Y-m-d").'","'.date("H:i:s").'","'.$user->getArea().'","web","'.$_POST['Gaugerange'].'")');

    if ( $gauge->setQuery('INSERT INTO gaugeinformation(Date,Time,Area,Method,`Range`)VALUES ("' . date("Y-m-d") . '","' . date("H:i:s") . '","' . $user->getArea() . '","web","' . $_POST['Gaugerange'] . '")')) {
        echo "1";
        $a = new multiple_remover();
        $a->setArea($user->getArea());
        $a->checkmultiple();
        $alert=new Alert();
        $alert->areasearch();

    }
    else{
        echo "0";
    }
    $gauge->close();


}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "2" == $_POST["value"]) {
    $db = new db();
    session_start();
    $user = unserialize($_SESSION["userdetails"]);
    $arr = str_split($_POST["category"]);
    $numarr = array();
    if (in_array("5", $arr)) {
        $db->setQuery('SELECT tel_no FROM users ');
        $result = $db->getResults();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($numarr, $row["tel_no"]);
            }
        }
    } else {
        foreach ($arr as $a) {
            if ($a == 2) {
                $db->setQuery('SELECT tel_no FROM users where user_type="2"');
            } elseif ($a == 3) {
                $db->setQuery('SELECT tel_no FROM users where user_type="3"');
            } elseif ($a == 4) {
                $db->setQuery('SELECT tel_no FROM users where user_type="4"');
            }
            $result = $db->getResults();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($numarr, $row["tel_no"]);
                }
            }
        }
    }
    array_push($numarr, $_POST['message']);
    $num=json_encode($numarr);
   $a= exec("python a.py $num");

echo $a;
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "23" == $_POST["value"]) {

    $db = new db();
    if (!empty($_POST["name"])) {
        $db->setQuery('SELECT user_id,user_type FROM users where name="' . $_POST["name"] . '"');
        $result = $db->getResults();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["user_type"] == "1") {
                    $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
  INNER JOIN admin on users.user_id = admin.user_id WHERE name="' . $_POST["name"] . '"');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary  m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Admin</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
      <tr >
        <td>Designation :</td>
        <td>' . $obj->designation . '</td>
        
      </tr>
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
      </tr>
      <tr>
        <td>EMP ID:</td>
        <td>' . $obj->emp_id . '</td>
      </tr>
       <tr>
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
      
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';


                } elseif ($row["user_type"] == "2") {
                    $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
  INNER JOIN staff on users.user_id = staff.user_id WHERE name="' . $_POST["name"] . '"');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2  m-auto" style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Staff</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
      <tr >
        <td>Designation :</td>
        <td>' . $obj->designation . '</td>
        
      </tr>
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
      </tr>
      <tr>
        <td>EMP ID:</td>
        <td>' . $obj->emp_id . '</td>
      </tr>
       <tr>
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
      
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                } elseif ($row["user_type"] == "3") {
                    $db->setQuery('SELECT name,user_name,tel_no,area,nic,email FROM users
  INNER JOIN gaugereportes on users.user_id = gaugereportes.user_id WHERE name="' . $_POST["name"] . '"');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2  m-auto" style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Gauge Reporter</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
   
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
      </tr>
   
       <tr>
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
         <tr >
        <td>Area :</td>
        <td>' . $obj->area . '</td>
        
      </tr>
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                } else {
                    $db->setQuery('SELECT name,user_name,tel_no,area,nic,email,designation FROM users
  INNER JOIN other on users.user_id = other.user_id WHERE name="' . $_POST["name"] . '"  ');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2  m-auto" style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Other officers</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
   
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
    
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
         <tr >
        <td>Area :</td>
        <td>' . $obj->area . '</td>
        
      </tr>
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                }

            }

        } else {
            echo "sorry";
        }

    }

    elseif (!empty($_POST["area"])) {
        $db->setQuery('SELECT user_id FROM gaugereportes where area="' . $_POST["area"] . '" ');
        $result = $db->getResults();
        $db->setQuery('SELECT user_id FROM other where area="' . $_POST["area"] . '" ');
        $result2 = $db->getResults();

        if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $db->setQuery('SELECT name,user_name,tel_no,nic,email,area FROM users  JOIN gaugereportes ON users.user_id = gaugereportes.user_id WHERE users.user_id =' . $row["user_id"] . ' ');
                    $result3 = $db->getResults();

                    /** @var TYPE_NAME $result3 */
                    $obj = mysqli_fetch_object($result3);

                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Gauge Ranger</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
   
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
    
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
         <tr >
        <td>Area :</td>
        <td>' . $obj->area . '</td>
        
      </tr>
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                }

                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $db->setQuery('SELECT name,user_name,tel_no,nic,email,area FROM users  JOIN other ON users.user_id = other.user_id  WHERE users.user_id =' . $row["user_id"] . ' ');
                        $result3 = $db->getResults();

                        /** @var TYPE_NAME $result3 */
                        $obj = mysqli_fetch_object($result3);

                        echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Other officers</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
   
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
    
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
         <tr >
        <td>Area :</td>
        <td>' . $obj->area . '</td>
        
      </tr>
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                    }
                }
            }else {
                echo "sorry";
            }

        } else {
            echo "sorry";
        }

    }

    elseif (!empty($_POST["empid"])) {
        $db->setQuery('SELECT user_id FROM admin where emp_id="' . $_POST["empid"] . '" ');
        $result = $db->getResults();
        $db->setQuery('SELECT user_id FROM staff where emp_id="' . $_POST["empid"] . '" ');
        $result2 = $db->getResults();

        if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
  INNER JOIN admin on users.user_id = admin.user_id WHERE  users.user_id =' . $row["user_id"] . '');
                    $result3 = $db->getResults();

                    /** @var TYPE_NAME $result3 */
                    $obj = mysqli_fetch_object($result3);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Admin</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
      <tr >
        <td>Designation :</td>
        <td>' . $obj->designation . '</td>
        
      </tr>
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
      </tr>
      <tr>
        <td>EMP ID:</td>
        <td>' . $obj->emp_id . '</td>
      </tr>
       <tr>
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
      
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                }

                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
  INNER JOIN staff on users.user_id = staff.user_id WHERE  users.user_id =' . $row["user_id"] . '');
                        $result3 = $db->getResults();

                        /** @var TYPE_NAME $result3 */
                        $obj = mysqli_fetch_object($result3);

                        echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

                <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
                <h6 class="  text-muted" >Admin</h5>
                </div>
                <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
 <table class="table table-responsive  table-active">
    
    <tbody>
      <tr >
        <td>Designation :</td>
        <td>' . $obj->designation . '</td>
        
      </tr>
      <tr>
        <td>NIC no:</td>
        <td>' . $obj->nic . '</td>
       
      </tr>
      <tr>
        <td>EMP ID:</td>
        <td>' . $obj->emp_id . '</td>
      </tr>
       <tr>
        <td>Tel no:</td>
        <td>' . $obj->tel_no . '</td>
      </tr>
       <tr>
        <td>Email:</td>
        <td>' . $obj->email . '</td>
      </tr>
      
    </tbody>
  </table>
                 
                </div>
                <div class="card-footer"></div>
            </div>';
                    }
                }
            }
        }else {
            echo "sorry";
        }


    }

    elseif (!empty($_POST["nicno"])) {

        $db->setQuery('SELECT user_id,user_type FROM users where nic="'. $_POST['nicno'] .'"');
        $result = $db->getResults();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                if ($row["user_type"] == "1") {
                    $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
INNER JOIN admin on users.user_id = admin.user_id WHERE users.user_id=' . $row["user_id"] . '');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2  m-auto" style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

    <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
        <h6 class="  text-muted" >Admin</h5>
    </div>
    <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
        <table class="table table-responsive  table-active">

            <tbody>
            <tr >
                <td>Designation :</td>
                <td>' . $obj->designation . '</td>

            </tr>
            <tr>
                <td>NIC no:</td>
                <td>' . $obj->nic . '</td>

            </tr>
            <tr>
                <td>EMP ID:</td>
                <td>' . $obj->emp_id . '</td>
            </tr>
            <tr>
                <td>Tel no:</td>
                <td>' . $obj->tel_no . '</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>' . $obj->email . '</td>
            </tr>

            </tbody>
        </table>

    </div>
    <div class="card-footer"></div>
</div>';


                } elseif ($row["user_type"] == "2") {
                    $db->setQuery('SELECT name,user_name,tel_no,designation,emp_id,nic,email FROM users
INNER JOIN staff on users.user_id = staff.user_id WHERE users.user_id=' . $row["user_id"] . '');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

    <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
        <h6 class="  text-muted" >Staff</h5>
    </div>
    <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
        <table class="table table-responsive  table-active">

            <tbody>
            <tr >
                <td>Designation :</td>
                <td>' . $obj->designation . '</td>

            </tr>
            <tr>
                <td>NIC no:</td>
                <td>' . $obj->nic . '</td>

            </tr>
            <tr>
                <td>EMP ID:</td>
                <td>' . $obj->emp_id . '</td>
            </tr>
            <tr>
                <td>Tel no:</td>
                <td>' . $obj->tel_no . '</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>' . $obj->email . '</td>
            </tr>

            </tbody>
        </table>

    </div>
    <div class="card-footer"></div>
</div>';
                } elseif ($row["user_type"] == "3") {
                    $db->setQuery('SELECT name,user_name,tel_no,area,nic,email FROM users
INNER JOIN gaugereportes on users.user_id = gaugereportes.user_id WHERE users.user_id=' . $row["user_id"] . '');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2  m-auto" style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

    <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
        <h6 class="  text-muted" >Gauge Reporter</h5>
    </div>
    <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
        <table class="table table-responsive  table-active">

            <tbody>

            <tr>
                <td>NIC no:</td>
                <td>' . $obj->nic . '</td>

            </tr>

            <tr>
                <td>Tel no:</td>
                <td>' . $obj->tel_no . '</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>' . $obj->email . '</td>
            </tr>
            <tr >
                <td>Area :</td>
                <td>' . $obj->area . '</td>

            </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer"></div>
</div>';
                } elseif ($row["user_type"] == "4"){


                    $db->setQuery('SELECT name,user_name,tel_no,area,nic,email,designation FROM users
INNER JOIN other on users.user_id = other.user_id WHERE users.user_id='.$row["user_id"] .'');
                    $result2 = $db->getResults();
                    $obj = mysqli_fetch_object($result2);
                    echo '  <div class=" flex-lg-wrap w-75 border-primary my-2 m-auto " style="border-radius: 10px; border:inset 5px;border-color:rgba(178, 193, 227, 0.74) !important   " >

    <div class="card-header col-auto " style="overflow: auto;hsl(196, 43%, 87%)"><h4 class="text-success lead " style="font-family: fantasy">' . $obj->name . '</h4>
        <h6 class="  text-muted" >Other officers</h5>
    </div>
    <div class="card-body  " style="background-color: rgba(190, 224, 234, 0.43)">
        <table class="table table-responsive  table-active">

            <tbody>

            <tr>
                <td>NIC no:</td>
                <td>' . $obj->nic . '</td>


                <td>Tel no:</td>
                <td>' . $obj->tel_no . '</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>' . $obj->email . '</td>
            </tr>
            <tr >
                <td>Area :</td>
                <td>' . $obj->area . '</td>

            </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer"></div>
</div>';
                }

            }

        } else {
            echo "sorry";
        }

    }


    else {
        echo "sorry";
    }

}
if ($_SERVER["REQUEST_METHOD"] === 'GET' && "10" == $_GET["value"]){
    $db=new db();
    $result=$db->setQuery('SELECT name,nic,designation,email,users.user_id,tel_no FROM users JOIN admin on users.user_id = admin.user_id WHERE emp_id="'.$_GET["emp"].'"');
    if(mysqli_num_rows($result)>0){
        $a=mysqli_fetch_object($result);
        echo json_encode($a);
    }
    else{
        echo "0";
    }
}
if ($_SERVER["REQUEST_METHOD"] === 'GET' && "11" == $_GET["value"]){
    $db=new db();
    $result=$db->setQuery('SELECT name,nic,designation,email,users.user_id,tel_no FROM users JOIN staff on users.user_id = staff.user_id WHERE emp_id="'.$_GET["emp"].'"');
    if(mysqli_num_rows($result)>0){
        $a=mysqli_fetch_object($result);
        echo json_encode($a);
    }
    else{
        echo "0";
    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "4" == $_POST["value"]){
    $db=new db();
    if($db->setQuery('UPDATE users SET name="'.$_POST["name"].'" , users.nic="'.$_POST["nicno"].'"  , users.email="'.$_POST["email"].'" WHERE user_id="'.$_POST["user_id"].'"')){
        if($db->setQuery('UPDATE staff SET designation="'.$_POST["designation"].'" WHERE user_id="'.$_POST["user_id"].'"')){
            echo '1';
        }else
            echo "0";
    }else
        echo "0";
    $db->close();
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "3" == $_POST["value"]){
    $db=new db();
    if($db->setQuery('UPDATE users SET name="'.$_POST["name"].'" , users.nic="'.$_POST["nicno"].'"  , users.email="'.$_POST["email"].'" WHERE user_id="'.$_POST["user_id"].'"')){
        if($db->setQuery('UPDATE admin SET designation="'.$_POST["designation"].'" WHERE user_id="'.$_POST["user_id"].'"')){
            echo '1';
        }else
            echo "0";
    }else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "6" == $_POST["value"])
{
    $db=new db();
    if($db->setQuery(' DELETE FROM users WHERE user_id="'.$_POST["user_id"].'"'))
        echo "1";
    else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'GET' && "7" == $_GET["value"]){
    $db=new db();
    $result=$db->setQuery('SELECT name,nic,area,email,users.user_id,tel_no FROM users JOIN gaugereportes ON users.user_id = gaugereportes.user_id WHERE nic="'.$_GET["nic"].'"');
    if(mysqli_num_rows($result)>0){
        $a=mysqli_fetch_object($result);
        echo json_encode($a);
    }
    else{
        echo "0";
    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "8" == $_POST["value"]){
    $db=new db();
    if($db->setQuery('UPDATE users SET name="'.$_POST["name"].'" , users.nic="'.$_POST["nic"].'"  , users.email="'.$_POST["email"].'" WHERE user_id="'.$_POST["user_id"].'"')){
        if($db->setQuery('UPDATE gaugereportes SET area="'.$_POST["area"].'" WHERE user_id="'.$_POST["user_id"].'"')){
            echo '1';
        }else
            echo "0";
    }else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "12" == $_POST["value"])
{
    $db=new db();
    if($db->setQuery(' DELETE FROM users WHERE user_id="'.$_POST["user_id"].'"'))
        echo "1";
    else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "13" == $_POST["value"]){
    $db=new db();
    if($db->setQuery('UPDATE users SET name="'.$_POST["name"].'" , users.nic="'.$_POST["nic"].'"  , users.email="'.$_POST["email"].'" WHERE user_id="'.$_POST["user_id"].'"')){
        if($db->setQuery('UPDATE gaugereportes SET area="'.$_POST["area"].'" WHERE user_id="'.$_POST["user_id"].'"')){
            echo '1';
        }else
            echo "0";
    }else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'GET' && "14" == $_GET["value"]){
    $db=new db();
    $result=$db->setQuery('SELECT name,nic,area,email,users.user_id,other.designation,tel_no FROM users JOIN other ON users.user_id = other.user_id WHERE nic="'.$_GET["nic"].'"');
    if(mysqli_num_rows($result)>0){
        $a=mysqli_fetch_object($result);
        echo json_encode($a);
    }
    else{
        echo "0";
    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "15" == $_POST["value"]){
    $db=new db();
    if($db->setQuery('UPDATE users SET name="'.$_POST["name"].'" , users.nic="'.$_POST["nic"].'"  , users.email="'.$_POST["email"].'" WHERE user_id="'.$_POST["user_id"].'"')){
        if($db->setQuery('UPDATE other SET  designation="'.$_POST["designation"].'" ,area="'.$_POST["area"].'"  WHERE user_id="'.$_POST["user_id"].'"')){
            echo '1';
        }else
            echo "0";
    }else
        echo "0";
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && "16" == $_POST["value"]){
   /*************************************/
    /*staff update=s1*/
    /*staff delete=s2
    /*gauge update=g1
    /*gauge delete=g2
    /*other update=o1
    /*other delete=o2*/
    /************************************/
    $data="";
    $type=$_POST["type"];
    $user_id=$_POST["user_id"];
if(("s1" == $_POST["type"])||("s2" == $_POST["type"])){
    /****staff update****/
    $data="name=".$_POST["name"]."&nic=".$_POST["nic"]."&email=".$_POST["email"]."&designation=".$_POST["designation"];
}elseif (("g1" == $_POST["type"])||("g2" == $_POST["type"])){
    $data="name=".$_POST["name"]."&nic=".$_POST["nic"]."&email=".$_POST["email"]."&area=".$_POST["area"]."&telno=".$_POST["telno"];
}else{
    $data="name=".$_POST["name"]."&nic=".$_POST["nic"]."&email=".$_POST["email"]."&area=".$_POST["area"]."&telno=".$_POST["telno"]."&designation=".$_POST["designation"];
}
    session_start();
    $user=unserialize($_SESSION["userdetails"]);
$db=new db();
if($db->setQuery('INSERT INTO pendings (request_type, `by`, data,user_id) VALUES ("'.$type.'" ,"'.$user->getEmpId().'","'.$data.'","'.$user_id.'")'))
    echo "1";
else
    echo "0";
$db->close();
}


