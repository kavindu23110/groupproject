<?php
include_once "header.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.js"></script>
<link rel="stylesheet" href="css/General.css">
<script src="js/jquery.min.js"></script>
<script src="js/iziModal.min.js"></script>
<link rel="stylesheet" href="test/jquery-confirm.min.css">
<script src="test/jquery-confirm.min.js"></script>
<script src="js/parsley.min.js"></script>
<link rel="stylesheet" href="css/parsley.css">
<div class="row mx-0">
    <script>
\

        $(function () {
            $('form').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                .on('form:submit', function() {
                    return false; // Don't submit form for this demo

                });
        });

        }
    </script>







    <div class="col-lg-2 bg-secondary">
        <table class="btn-group-vertical my-1 m-sm-0 ">
            <tr>
                <button type="button" class="btn btn-default btn-block my-2 " id="a"  >Internal messaging</button>
            </tr>

            <tr>
                <button type="button" class="btn btn-default btn-block">Stakeholder Information</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Gauge Reporters Contacts</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Documents</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Rain Graphs</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Message history</button>
            </tr>
            <tr>
                <button type="button" id="users" class="btn btn-default btn-block">Users</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Settings</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Advanced options</button>
            </tr>


        </table>
    </div>

    <div class="col-lg-8 col-sm-12 d-flex justify-content-center">

        <div class="col-lg-6 my-2 admin_msg_win  ">

            <form style="font-size: medium" action="process.php" id="adminmsg" method="POST" role="form">
                <legend class="legends">Messaging Service</legend>

                <div class="form-group">
                    <label for="message">Message</label>
                    <input type="text" required class="form-control" name="message" id="message"
                           placeholder="type your message here">
                    <div style="margin-top: 10px;">
                        <div class="row justify-content-center ">

                            <div class="col-sm-8 col-sm-offset-2   ">
                                <table class="table-responsive table table-hover " style="line-height:0.5rem">
                                    <tr>
                                        <td><label class=" ">Staff</label></td>
                                        <td><input type="checkbox" id="staffcheck"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="">Officers</label></td>
                                        <td><input type="checkbox" id="officerscheck"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="">Gauge rangers</label></td>
                                        <td><input type="checkbox" id="gaugecheck"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="">Public</label></td>
                                        <td><input type="checkbox" id="publiccheck"></td>
                                    </tr>
                                </table>
                                <p id="noncheck" class=" text-danger ">Please check atleast one category</p>
                            </div>

                        </div>


                    </div>
                </div>


                <button type="submit" class="btn btn-primary admin_msg_submit ">Submit</button>
            </form>
            <a href="#" style="position:relative;margin-bottom:1px;"> Settings <span class="glyphicon glyphicon-cog"
                                                                                     style="font-size: medium;"></span></a>
        </div>


    </div>
    <div class="col-lg-2 col-sm-12 px-0 bg-secondary">

        <div class="col-lg-12 col-sm-12 px-0">
            <button type="button" class="btn btn-primary my-2 mx-2">
                Inbox&nbsp; <span class="badge badge-light" id="activationspan">4</span>
            </button>
            <button type="button" class="btn btn-primary my-2 mx-2 ">
                Requests&nbsp; <span class="badge badge-light" id="updatespan">4</span>
            </button>

            <button type="button" class="btn btn-primary my-2 mx-2 ">
                Alerts&nbsp;<span class="badge badge-light " id="deletespan">4</span>
            </button>


        </div>
    </div>
</div>
<link rel="stylesheet" href="css/jquery.loadingModal.css">
<script src="js/jquery.loadingModal.min.js"></script>

<script>
    var type;
    var val = $("#1");
</script>

<div id="usersmodal" class="iziModal">
    <div class="iziModal-header ">
        <h3 class="iziModal-header-title text-center">User type</h3>
        <div class="iziModal-header-buttons"><a href="javascript:void(0)" class="iziModal-button iziModal-button-close" data-izimodal-close=""></a><a href="javascript:void(0)" class="iziModal-button iziModal-button-fullscreen" data-izimodal-fullscreen=""></a></div>
    </div>
    <div class="iziModal-content my-4">
        <div class="row ">
            <div class="col-lg-3ext-lg-center page-link"><a onclick="type=1;ut1();"><img src="img/Admin.png"
                                                                                         height="128"
                                                                                         width="128"/></a></div>
            <div class="col-lg-3 text-lg-center page-link"><a onclick="type=2;ut2();"><img src="img/staff.jpg"
                                                                                           height="128"
                                                                                           width="128"/></a>
            </div>
            <div class="col-lg-3 text-lg-center page-link"><a onclick="type=3;ut3();"><img src="img/gauge.png"
                                                                                           height="128"
                                                                                           width="128"/></a>
            </div>
            <div class="col-lg-3 text-lg-center page-link"><a onclick="type=4;ut4();"><img
                        src="img/otherofficers.png" height="128" width="128"/></a></div>
        </div>
    </div>
</div>



<!--admin-->
<div id="1" class="iziModal">
    <div class="iziModal-header"><h3 class="iziModal-header-title text-center">Select the Process</h3>
        <div class="iziModal-header-buttons"><a href="javascript:void(0)" class="iziModal-button iziModal-button-close" data-izimodal-close=""></a><a href="javascript:void(0)" class="iziModal-button iziModal-button-fullscreen" data-izimodal-fullscreen=""></a></div>
    </div>
    <div class="iziModal-content">


        <div class="container">

            <ul class="nav nav-tabs  justify-content-between">
                <li class="active nav-item "><a data-toggle="tab" href="#home" class="nav-link">Addition</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu1" class="nav-link">Update</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu2" class="nav-link">Delete</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="pb-5 admin_msg_win my-2">
                        <form action="process.php"  class="form" id="adminadd" method="POST" role="form">
                            <legend class="legends">Addition</legend>

                            <div class="form-group  my-2">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="">First name</label>
                                        <input type="text"   class="form-control "  data-parsley-pattern="^[a-zA-Z]+$" data-parseley required="true" name="firstname"
                                               placeholder="Input...">
                                    </div>
                                    <div class="col">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control"  data-parsley-trigger="focusin focusout  " data-parsley-pattern="^[a-zA-Z]+$" required="true" name="lastname" id=""
                                               placeholder="Input...">
                                    </div>
                                </div>
                                <label for="">NIC no</label>
                                <input type="text" autocomplete="off" required="true" class="form-control" name="nicno" id="" placeholder="Input...">
                                <label for="">EMP ID</label>
                                <input type="text" autocomplete="off" class="form-control"required="true" name="empid" aria-required="" id="" placeholder="Input...">
                                <label for="">Designation</label>
                                <input type="text"  data-parsley-trigger="focusin focusout " data-parseley-minlength="5" data-parsley-pattern="[a-zA-Z ]" class="form-control"  name="designation" required="true"  id="" placeholder="Input...">
                                <label for="">Username</label>
                                <input type="text" class="form-control" autocomplete="off" required="true" onkeyup="searchusername()" name="username" id="username" placeholder="Input...">
                                <p class="alert-danger mt-1 wrongusername">User name exits</p>
                                <label for="">Password</label>
                                <input type="text" class="form-control" required autocomplete="off" name="password" id="" placeholder="Input...">
                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="" placeholder="Input...">
                                <label for="">Tel-No</label>
                                <input type="tel" required class="form-control" name="telno" id="" placeholder="Input...">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Submit</button>
                        </form>
                    </div>


                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



               <div class="mb-4 pb-2">

                   <form action="" method="POST" role="form" id="empserachform1" class="py-2">

                       <div class="form-group">
                           <label for="">EMP ID</label>
                           <input type="text" autocomplete="off" onblur="" class="form-control" name="empid" id="empidupdate1" placeholder="Input...">


                       </div>
                       <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                   </form>
               </div>




                        <form action="process2.php" method="POST" id="adupform" role="form">
                            <legend class="legends">Update</legend>

                            <div class="form-group  my-2">




                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" id="adupname"
                                               placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" name="nicno" id="adupnic" placeholder="Input...">


                                <label for="">Designation</label>
                                <input type="text" class="form-control" name="designation" id="adupdesig" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="adupemail" placeholder="Input...">
<input type="text" hidden name="user_id" id="adupuid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Update</button>
                        </form>
                    </div>


                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="empserachform2" class="py-2">

                                <div class="form-group">
                                    <label for="">EMP ID</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="empid" id="empidupdate2" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="addelform" role="form">
                            <legend class="legends">Remove</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" disabled  name="name" id="addelname"
                                       placeholder="Input...">

                                <input type="text" hidden name="user_id" id="addeluid">


                                <label for="">NIC no</label>
                                <input type="text" class="form-control" disabled  name="nicno" id="addelnic" placeholder="Input...">


                                <label for="">Designation</label>
                                <input type="text" class="form-control" disabled name="designation" id="addeldesig" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required disabled class="form-control" required name="email" id="addelemail" placeholder="Input...">
                                <input type="text" hidden name="user_id" id="addeluid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Delete</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>


    </div>
</div>

<!--Staff-->

<div id="2" class="iziModal-wrap iziModal">
    <div class="iziModal-header">
        <h3 class="iziModal-header-title text-center">Select the Process</h3>
        <div class="iziModal-header-buttons"><a href="javascript:void(0)" class="iziModal-button iziModal-button-close" data-izimodal-close=""></a><a href="javascript:void(0)" class="iziModal-button iziModal-button-fullscreen" data-izimodal-fullscreen=""></a></div>
    </div>
    <div class="iziModal-content">


        <div class="container">

            <ul class="nav nav-tabs  justify-content-between">
                <li class="active nav-item "><a data-toggle="tab" href="#home2" class="nav-link">Addition</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu12" class="nav-link">Update</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu22" class="nav-link">Delete</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="home2" class="tab-pane fade in active">
                    <div class="pb-5 admin_msg_win my-2">
                        <form action="process.php" id="staffadd" method="POST" role="form">
                            <legend class="legends">Addition</legend>

                            <div class="form-group  my-2">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" name="firstname" id=""
                                               placeholder="Input...">
                                    </div>
                                    <div class="col">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" name="lastname" id=""
                                               placeholder="Input...">
                                    </div>
                                </div>
                                <label for="">NIC-No</label>
                                <input type="text" class="form-control" name="nicno" id="" placeholder="Input...">
                                <label for="">EMP ID</label>
                                <input type="text" autocomplete="off"  class="form-control" name="empid" id="" placeholder="Input...">
                                <label for="">Designation</label>
                                <input type="text" class="form-control" name="designation" required="true"  id="" placeholder="Input...">
                                <label for="">Username</label>
                                <input type="text" onkeyup="searchusername()" autocomplete="off"  class="form-control" name="username" id="username2" placeholder="Input...">
                                <p class="alert-danger mt-1 wrongusername">User name exits</p>
                                <label for="">Password</label>
                                <input type="text" autocomplete="off"  class="form-control" name="password" id="" placeholder="Input...">
                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="" placeholder="Input...">
                                <label for="">Tel-No</label>
                                <input type="tel" required class="form-control" name="telno" id="" placeholder="Input...">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Submit</button>
                        </form>
                    </div>


                </div>
                <div id="menu12" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="empserachform3" class="py-2">

                                <div class="form-group">
                                    <label for="">EMP ID</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="empid" id="empidupdate3" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="staffupform" role="form">
                            <legend class="legends">Update</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="staffupname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" name="nicno" id="staffupnic" placeholder="Input...">


                                <label for="">Designation</label>
                                <input type="text" class="form-control" name="designation" id="staffupdesig" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="staffupemail" placeholder="Input...">
                                <input type="text" hidden name="user_id" id="staffupuid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Update</button>
                        </form>
                    </div>


                </div>
                <div id="menu22" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="empserachform4" class="py-2">

                                <div class="form-group">
                                    <label for="">EMP ID</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="empid" id="empidupdate4" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="staffdelform" role="form">
                            <legend class="legends">Remove</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" readonly name="name" id="staffdelname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" readonly  name="nicno" id="staffdelnic" placeholder="Input...">


                                <label for="">Designation</label>
                                <input type="text" class="form-control" readonly name="designation" id="staffdeldesig" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required readonly class="form-control" required name="email" id="staffdelemail" placeholder="Input...">
                                <input type="text" hidden name="user_id" id="staffdeluid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<!--gauge-->

<div id="3" class="iziModal-wrap iziModal">
    <div class="iziModal-header">
        <h3 class="iziModal-header-title text-center">Select the Process</h3>
        <div class="iziModal-header-buttons"><a href="javascript:void(0)" class="iziModal-button iziModal-button-close" data-izimodal-close=""></a><a href="javascript:void(0)" class="iziModal-button iziModal-button-fullscreen" data-izimodal-fullscreen=""></a></div>
    </div>
    <div class="iziModal-content">


        <div class="container">

            <ul class="nav nav-tabs  justify-content-between">
                <li class="active nav-item "><a data-toggle="tab" href="#home3" class="nav-link">Addition</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu13" class="nav-link">Update</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu23" class="nav-link">Delete</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="home3" class="tab-pane fade in active">
                    <div class="pb-5 admin_msg_win my-2">
                        <form action="process.php" id="gaugeadd" method="POST" role="form">
                            <legend class="legends">Addition</legend>

                            <div class="form-group  my-2">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" name="firstname" id=""
                                               placeholder="Input...">
                                    </div>
                                    <div class="col">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" name="lastname" id=""
                                               placeholder="Input...">
                                    </div>
                                </div>



                                <label for="">NIC-No</label>
                                <input type="text" class="form-control" name="nicno" id="" placeholder="Input...">
                                <label for="">Area</label>
                                <input type="text"  style="text-transform:uppercase" autocomplete="off"  class="form-control" name="Area" id="" placeholder="Input...">

                                <label for="">Username</label>
                                <input type="text" onkeyup="searchusername()" autocomplete="off"  class="form-control" name="username" id="username3" placeholder="Input...">
                                <p class="alert-danger mt-1 wrongusername">User name exits</p>
                                <label for="">Password</label>
                                <input type="text" autocomplete="off"  class="form-control" name="password" id="" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="" placeholder="Input...">
                                <label for="">Tel-No</label>
                                <input type="tel" required class="form-control" name="telno" id="" placeholder="Input...">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Submit</button>
                        </form>
                    </div>


                </div>
                <div id="menu13" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="nicserachform1" class="py-2">

                                <div class="form-group">
                                    <label for="">NIC no</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="nic" id="nicsearcharea1" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="gaugeupform" role="form">
                            <legend class="legends">Update</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="gaugeupname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" name="nic" id="gaugeupnic" placeholder="Input...">


                                <label for="">Area</label>
                                <input type="text" class="form-control" name="area" id="gaugeuparea" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="gaugeupemail" placeholder="Input...">

                                <label for="">Tel-no</label>
                                <input type="text" class="form-control" name="telno" id="gaugeuptelno" placeholder="Input...">

                                <input type="text" hidden name="user_id" id="gaugeupuid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Update</button>
                        </form>
                    </div>

                </div>
                <div id="menu23" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="nicserachform2" class="py-2">

                                <div class="form-group">
                                    <label for="">NIC no</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="nic" id="nicsearcharea2" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="gaugedelform" role="form">
                            <legend class="legends">Remove</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" readonly name="name" id="gaugedelname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" readonly name="nic" id="gaugedelnic" placeholder="Input...">


                                <label for="">Area</label>
                                <input type="text" class="form-control" readonly name="area" id="gaugedelarea" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" readonly required name="email" id="gaugedelemail" placeholder="Input...">

                                <label for="">Tel-no</label>
                                <input type="text" class="form-control" readonly name="telno" id="gaugedeltelno" placeholder="Input...">

                                <input type="text" hidden name="user_id" id="gaugedeluid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Delete</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>


    </div>
</div>


<!--other-->
<div id="4" class="iziModal-wrap iziModal">
    <div class="iziModal-header">
        <h3 class="iziModal-header-title text-center">Select the Process</h3>
        <div class="iziModal-header-buttons"><a href="javascript:void(0)" class="iziModal-button iziModal-button-close" data-izimodal-close=""></a><a href="javascript:void(0)" class="iziModal-button iziModal-button-fullscreen" data-izimodal-fullscreen=""></a></div>
    </div>
    <div class="iziModal-content">


        <div class="container">

            <ul class="nav nav-tabs  justify-content-between">
                <li class="active nav-item "><a data-toggle="tab" href="#home4" class="nav-link">Addition</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu14" class="nav-link">Update</a>
                </li>
                <li class="nav-item"><a data-toggle="tab" href="#menu24" class="nav-link">Delete</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="home4" class="tab-pane fade in active">
                    <div class="pb-5 admin_msg_win my-2">
                        <form action="process.php" id="otheradd" method="POST" role="form">
                            <legend class="legends">Addition</legend>

                            <div class="form-group  my-2">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" required  name="firstname" id=""
                                               placeholder="Input...">
                                    </div>
                                    <div class="col">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" required name="lastname" id=""
                                               placeholder="Input...">
                                    </div>
                                </div>



                                <label for="">NIC-No</label>
                                <input type="text" class="form-control" required name="nicno" id="" placeholder="Input...">
                                <label for="">Designation</label>
                                <input type="text" class="form-control" autocomplete="off" required name="designation" id="" placeholder="Input...">
                                <label for="">Area</label>
                                <input type="text" autocomplete="off" required class="form-control" name="Area" id="" placeholder="Input...">

                                <label for="">Username</label>
                                <input type="text" onkeyup="searchusername()" autocomplete="off"  required class="form-control" name="username" id="username4" placeholder="Input...">
                                <p class="alert-danger mt-1 wrongusername">User name exits</p>
                                <label for="">Password</label>
                                <input type="text" autocomplete="off"  required class="form-control" name="password" id="" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="" placeholder="Input...">
                                <label for="">Tel-No</label>
                                <input type="tel" required class="form-control" required name="telno" id="" placeholder="Input...">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Submit</button>
                        </form>
                    </div>


                </div>
                <div id="menu14" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">



                        <div class="mb-4 pb-2">

                            <form action="" method="POST" role="form" id="nicserachform3" class="py-2">

                                <div class="form-group">
                                    <label for="">NIC no</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="nic" id="nicsearcharea3" placeholder="Input...">


                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>




                        <form action="process2.php" method="POST" id="otherupform" role="form">
                            <legend class="legends">Update</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="otherupname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control" name="nic" id="otherupnic" placeholder="Input...">
                                <label for="">Desigantion</label>
                                <input type="text" class="form-control" name="designation" id="otherupdesignation" placeholder="Input...">


                                <label for="">Area</label>
                                <input type="text" class="form-control" name="area" id="otheruparea" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control" required name="email" id="otherupemail" placeholder="Input...">

                                <label for="">Tel-no</label>
                                <input type="text" class="form-control" name="telno" id="otheruptelno" placeholder="Input...">

                                <input type="text" hidden name="user_id" id="otherupuid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Update</button>
                        </form>
                    </div>


                </div>

                <div id="menu24" class="tab-pane fade">
                    <div class="pb-5 admin_msg_win my-2">
                        <div class="mb-4 pb-2">
                            <form action="" method="POST" role="form" id="nicserachform4" class="py-2">
                                <div class="form-group">
                                    <label for="">NIC no</label>
                                    <input type="text" autocomplete="off" onblur="" class="form-control" name="nic" id="nicsearcharea4" placeholder="Input...">
                                </div>
                                <button type="submit" class="btn btn-primary admin_msg_submit ">Search</button>
                            </form>
                        </div>



                        <form action="process2.php" method="POST" id="otherdelform" role="form">
                            <legend class="legends">Remove</legend>

                            <div class="form-group  my-2">




                                <label for="">Name</label>
                                <input type="text" class="form-control" readonly name="name" id="otherdelname"
                                       placeholder="Input...">




                                <label for="">NIC no</label>
                                <input type="text" class="form-control"readonly name="nic" id="otherdelnic" placeholder="Input...">
                                <label for="">Desigantion</label>
                                <input type="text" class="form-control"readonly name="designation" id="otherdeldesignation" placeholder="Input...">


                                <label for="">Area</label>
                                <input type="text" class="form-control"readonly name="area" id="otherdelarea" placeholder="Input...">

                                <label for="">E-mail</label>
                                <input type="email" required class="form-control"readonly required name="email" id="otherdelemail" placeholder="Input...">

                                <label for="">Tel-no</label>
                                <input type="text" class="form-control"readonly name="telno" id="otherdeltelno" placeholder="Input...">

                                <input type="text" hidden readonly name="user_id" id="otherdeluid">
                            </div>


                            <button type="submit" class="btn btn-primary admin_msg_submit">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
$('form').parsley();
    $("#usersmodal").iziModal();
    $("#1").iziModal();
    $("#2").iziModal();
    $("#3").iziModal();
    $("#4").iziModal();


    $("#users").click(
        function () {
            $('form').trigger("reset");
            $("#usersmodal").iziModal('open');
            $(".wrongusername").hide();
        }
    );
    function ut1() {

        $("#1").iziModal('open');


    }
    function ut2() {
        $("#2").iziModal('open');
    }

    function ut3() {
        $("#3").iziModal('open');
    }

    function ut4() {
        $("#4").iziModal('open');
    }

    function select(e) {

    }

    function searchusername() {
        var arr = [ $("#username").val(),$("#username1").val(),$("#username2").val(),$("#username3").val(),$("#username4").val()];

      var arr2=( arr.filter(function(n){ return n != undefined }));
        var username  = $.grep(arr2,function(n){
            return(n);
        });


        $.get("process2.php?value=30&username="+username, function(data, status){

            if(data=="exits")

                $(".wrongusername").show()


            else
                $(".wrongusername").hide();

        });

    }


</script>
<script>


    $("#adminadd").submit(function (e) {

        e.preventDefault();
        if($("#adminadd").parsley().isValid())
        {
            $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
            $.post("process2.php", $(this).serialize()+"&value=10",
                function (data, status) {

                    setTimeout(function () {
                        $('body').loadingModal('destroy') ;

                    },4000);

                    setTimeout(function () {
                        if(data=="0"){
                            $.alert({
                                title: 'Error',
                                icon: 'fa fa-warning',
                                type: 'orange',
                                content: 'Something went wrong, please retry again after sometime.' +
                                '<hr>' +
                                '', });

                        }
                        else {
                            $.alert({
                                title: 'Registered sucessfully',
                                content: 'User registered sucessfully.',
                                icon: 'fa fa-rocket',
                                animation: 'scale',
                                closeAnimation: 'scale',
                                closeIcon: true,
                                buttons: {
                                    okay: {
                                        text: 'Okay',
                                        btnClass: 'btn-green'
                                    },
                                }
                            });


                        }

                        $("#adminadd").trigger('reset');


                    },4000);

                });


        }



    });
function a(e) {

}
    $("#staffadd").submit(function (e) {
        e.preventDefault();
        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
        $.post("process2.php", $(this).serialize()+"&value=11",
            function (data, status) {

                setTimeout(function () {
                    $('body').loadingModal('destroy') ;

                },4000);

                setTimeout(function () {
                    if(data=="0"){
                        $.alert({
                            title: 'Error',
                            icon: 'fa fa-warning',
                            type: 'orange',
                            content: 'Something went wrong, please retry again after sometime.' +
                            '<hr>' +
                            '', });
                    }
                    else {
                        $.alert({
                            title: 'Registered sucessfully',
                            content: 'User registered sucessfully. ',
                            icon: 'fa fa-rocket',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            closeIcon: true,
                            buttons: {
                                okay: {
                                    text: 'Okay',
                                    btnClass: 'btn-green'
                                },
                            }
                        });


                    }


                    $("#staffadd").trigger('reset');

                },4000);alert(data);
            });
    });
    $("#gaugeadd").submit(function (e) {
        e.preventDefault();
        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
        $.post("process2.php", $(this).serialize()+"&value=12",
            function (data, status) {

                setTimeout(function () {
                    $('body').loadingModal('destroy') ;

                },4000);

                setTimeout(function () {
                    if(data=="0"){
                        $.alert({
                            title: 'Error',
                            icon: 'fa fa-warning',
                            type: 'orange',
                            content: 'Something went wrong, please retry again after sometime.' +
                            '<hr>' +
                            '', });
                    }
                    else {
                        $.alert({
                            title: 'Registered sucessfully',
                            content: 'User registered sucessfully. ',
                            icon: 'fa fa-rocket',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            closeIcon: true,
                            buttons: {
                                okay: {
                                    text: 'Okay',
                                    btnClass: 'btn-green'
                                },
                            }
                        });


                    }


                    $("#gaugeadd").trigger('reset');

                },4000);
            });
    });

    $("#otheradd").submit(function (e) {
        e.preventDefault();
        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
        $.post("process2.php", $(this).serialize()+"&value=13",
            function (data, status) {

                setTimeout(function () {
                    $('body').loadingModal('destroy') ;

                },4000);

                setTimeout(function () {
                    if(data=="0"){
                        $.alert({
                            title: 'Error',
                            icon: 'fa fa-warning',
                            type: 'orange',
                            content: 'Something went wrong, please retry again after sometime.' +
                            '<hr>' +
                            '', });
                    }
                    else {
                        $.alert({
                            title: 'Registered sucessfully',
                            content: 'User registered sucessfully.',
                            icon: 'fa fa-rocket',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            closeIcon: true,
                            buttons: {
                                okay: {
                                    text: 'Okay',
                                    btnClass: 'btn-green'
                                },
                            }
                        });


                    }
                    $("#otheradd").trigger('reset');



                },4000);
            });
    });
/****admin update****/
$("#adupform").hide();
$("#empserachform1").submit(function (e) {
    e.preventDefault()
    $.get("process.php?emp="+$("#empidupdate1").val()+"&value=10",function(data,sucess) {
if(data=="0"){
    $.alert({
        title: 'NO Result Found',
        icon: 'fa fa-warning',
        type: 'orange',
        content: 'Sorry their is no emp-id =' +$("#empidupdate1").val()+"is registered for staff."

        , });
    $("#empserachform1,#adupform").trigger('reset');
    $("#adupform").hide();
}
else {
alert(data);
    var obj = JSON.parse(data);
    $("#adupuid").val(obj.user_id);
   $("#adupname").val(obj.name);
   $("#adupnic").val(obj.nic);
   $("#adupdesig").val(obj.designation);
   $("#adupemail").val(obj.email);
    $("#adupform").show();
}
    });
});


    $("#adupform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {
                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $(this).serialize()+"&value=3",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'Registered sucessfully',
                                            content: 'User updated sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#empserachform1,#adupform").trigger('reset');
                                    $("#adupform").hide();

                                },4000);
                            });






                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });

    });

/********admin delete*********/
    $("#addelform").hide();
    $("#empserachform2").submit(function (e) {
        e.preventDefault()
        $.get("process.php?emp="+$("#empidupdate2").val()+"&value=10",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#empidupdate2").val()+"is registered for staff."

                    , });
                $("#empserachform2,#addelform").trigger('reset');
                $("#addelform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#addelname").val(obj.name);
                $("#addelnic").val(obj.nic);
                $("#addeldesig").val(obj.designation);
                $("#addelemail").val(obj.email);
$("#addeluid").val(obj.user_id);
                $("#addelform").show();
            }
        });
    });
    /**************staff update*********/
    $("#staffupform").hide();
    $("#empserachform3").submit(function (e) {
        e.preventDefault()
        $.get("process.php?emp="+$("#empidupdate3").val()+"&value=11",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#empidupdate3").val()+"is registered for staff."

                    , });
                $("#empserachform3,#staffupform").trigger('reset');
                $("#staffupform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);
                $("#staffupuid").val(obj.user_id);
                $("#staffupname").val(obj.name);
                $("#staffupnic").val(obj.nic);
                $("#staffupdesig").val(obj.designation);
                $("#staffupemail").val(obj.email);
                $("#staffupform").show();
            }
        });
    });

    $("#staffupform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {

                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $("#staffupform").serialize()+"&value=4",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'Registered sucessfully',
                                            content: 'User updated sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#empserachform3,#staffupform").trigger('reset');
                                    $("#staffupform").hide();

                                },4000);
                            });




                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });


    });

    /****************staff delete********/
$("#staffdelform").hide();
    $("#empserachform4").submit(function (e) {
        e.preventDefault()
        $.get("process.php?emp="+$("#empidupdate4").val()+"&value=11",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#empidupdate4").val()+"is registered for staff."

                    , });
                $("#empserachform4,#staffdelform").trigger('reset');
                $("#staffdelform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#staffdelname").val(obj.name);
                $("#staffdelnic").val(obj.nic);
                $("#staffdeldesig").val(obj.designation);
                $("#staffdelemail").val(obj.email);
                $("#staffdeluid").val(obj.user_id);
                $("#staffdelform").show();
            }
        });
    });

    $("#staffdelform").submit(function (e) {
        e.preventDefault();
        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
        $.post("process.php", $(this).serialize()+"&value=6",
            function (data, status) {

                setTimeout(function () {
                    $('body').loadingModal('destroy') ;

                },4000);

                setTimeout(function () {
                    if(data=="0"){
                        $.alert({
                            title: 'Error',
                            icon: 'fa fa-warning',
                            type: 'orange',
                            content: 'Something went wrong, please retry again after sometime.' +
                            '<hr>' +
                            '', });
                    }
                    else {
                        $.alert({
                            title: 'User Removed',
                            content: 'User Removed sucessfully. ',
                            icon: 'fa fa-rocket',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            closeIcon: true,
                            buttons: {
                                okay: {
                                    text: 'Okay',
                                    btnClass: 'btn-green'
                                },
                            }
                        });


                    }


                    $("#empserachform3,#staffupform").trigger('reset');
                    $("#staffupform").hide();

                },4000);
            });

    });
    /************ gauge update***********/

    $("#gaugeupform").hide();
    $("#nicserachform1").submit(function (e) {
        e.preventDefault()
        $.get("process.php?nic="+$("#nicsearcharea1").val()+"&value=7",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#nicsearcharea1").val()+"is registered for staff."

                    , });
                $("#nicserachform1,#gaugeupform").trigger('reset');
                $("#gaugeupform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#gaugeupname").val(obj.name);
                $("#gaugeupnic").val(obj.nic);
                $("#gaugeuparea").val(obj.area);
                $("#gaugeupemail").val(obj.email);
                $("#gaugeupuid").val(obj.user_id);
                $("#gaugeupform").show();
            }
        });
    });
    $("#gaugeupform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {

                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $("#gaugeupform").serialize()+"&value=8",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'Registered sucessfully',
                                            content: 'User updated sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#nicserachform1,#gaugeupform").trigger('reset');
                                    $("#gaugeupform").hide();

                                },4000);
                            });




                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });


    });

    /*************gauge delete**************/
    $("#gaugedelform").hide();
    $("#nicserachform2").submit(function (e) {
        e.preventDefault()
        $.get("process.php?nic="+$("#nicsearcharea2").val()+"&value=7",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#nicsearcharea2").val()+"is registered for staff."

                    , });
                $("#nicserachform2,#gaugedelform").trigger('reset');
                $("#gaugedelform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#gaugedelname").val(obj.name);
                $("#gaugedelnic").val(obj.nic);
                $("#gaugedelarea").val(obj.area);
                $("#gaugedelemail").val(obj.email);
                $("#gaugedeluid").val(obj.user_id);
                $("#gaugedelform").show();

            }
        });
    });
    $("#gaugedelform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {

                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $("#gaugedelform").serialize()+"&value=12",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'deleted sucessfully',
                                            content: 'User deleted sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#nicserachform2,#gaugedelform").trigger('reset');
                                    $("#gaugedelform").hide();

                                },4000);
                            });




                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });


    });


    /****************other update****************/
    $("#otherupform").hide();
    $("#nicserachform3").submit(function (e) {
        e.preventDefault()
        $.get("process.php?nic="+$("#nicsearcharea3").val()+"&value=14",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#nicsearcharea3").val()+"is registered for staff."

                    , });
                $("#nicserachform3,#otherupform").trigger('reset');
                $("#otherupform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#otherupname").val(obj.name);
                $("#otherupnic").val(obj.nic);
                $("#otheruparea").val(obj.area);
                $("#otherupemail").val(obj.email);
                $("#otherupuid").val(obj.user_id);
                $("#otherupdesignation").val(obj.designation);
                $("#otherupform").show();
            }
        });
    });
    $("#otherupform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {

                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $("#otherupform").serialize()+"&value=15",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'Registered sucessfully',
                                            content: 'User updated sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#nicserachform3,#otherupform").trigger('reset');
                                    $("#otherupform").hide();

                                },4000);
                            });




                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });


    });

/*********************other delete*****************/


$("#otherdelform").hide();
    $("#nicserachform4").submit(function (e) {
        e.preventDefault()
        $.get("process.php?nic="+$("#nicsearcharea4").val()+"&value=14",function(data,sucess) {
            if(data=="0"){
                $.alert({
                    title: 'NO Result Found',
                    icon: 'fa fa-warning',
                    type: 'orange',
                    content: 'Sorry their is no emp-id =' +$("#nicsearcharea4").val()+"is registered for staff."

                    , });
                $("#nicserachform4,#otherdelform").trigger('reset');
                $("#otherdelform").hide();
            }
            else {
                alert(data);
                var obj = JSON.parse(data);

                $("#otherdelname").val(obj.name);
                $("#otherdelnic").val(obj.nic);
                $("#otherdelarea").val(obj.area);
                $("#otherdelemail").val(obj.email);
                $("#otherdeluid").val(obj.user_id);
                $("#otherdeldesignation").val(obj.designation);
                $("#otherdelform").show();

            }
        });
    });
    $("#otherdelform").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: '<strong>Confirmation</strong>',
            content: 'Are you sure this is correct operation',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.9,
            buttons: {
                'confirm': {
                    text: 'Proceed',
                    btnClass: 'btn-blue',
                    action: function () {

                        $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                        $.post("process.php", $("#otherdelform").serialize()+"&value=12",
                            function (data, status) {

                                setTimeout(function () {
                                    $('body').loadingModal('destroy') ;

                                },4000);

                                setTimeout(function () {
                                    if(data=="0"){
                                        $.alert({
                                            title: 'Error',
                                            icon: 'fa fa-warning',
                                            type: 'orange',
                                            content: 'Something went wrong, please retry again after sometime.' +
                                            '<hr>' +
                                            '', });
                                    }
                                    else {
                                        $.alert({
                                            title: 'deleted sucessfully',
                                            content: 'User deleted sucessfully. ',
                                            icon: 'fa fa-rocket',
                                            animation: 'scale',
                                            closeAnimation: 'scale',
                                            closeIcon: true,
                                            buttons: {
                                                okay: {
                                                    text: 'Okay',
                                                    btnClass: 'btn-green'
                                                },
                                            }
                                        });


                                    }


                                    $("#nicserachform4,#otherdelform").trigger('reset');
                                    $("#otherdelform").hide();

                                },4000);
                            });




                    }
                },
                cancel:  {

                    text: 'Cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },

            }
        });


    });


</script>
<script>
    $("#noncheck").hide();
    $("#adminmsg").submit(
        function (e) {     e.preventDefault();
            if ((  (document.getElementById('staffcheck').checked) ||
                    (document.getElementById('gaugecheck').checked)||
                    (document.getElementById('publiccheck').checked)||
                    (document.getElementById('officerscheck').checked)

                )==true)
            {
                var x = "&category=";
                $("#noncheck").hide();

                if (document.getElementById('staffcheck').checked == true) {
                    x = x + "2";

                }
                if (document.getElementById('officerscheck').checked == true) {
                    x = x + "4";

                }
                if (document.getElementById('gaugecheck').checked == true) {
                    x = x + "3";

                }
                if (document.getElementById('publiccheck').checked == true) {
                    x = x + "5";

                }
                $.confirm({

                    title: '<b><center>Confirm<center></b>',
                    content: $("#message").val()+"<br><strong>Please confirm the message.</strong> ",
                    closeAnimation: 'scale',
                    buttons: {
                        confirm: {
                            text: 'Proceed',
                            btnClass: 'btn-blue',

                            action: function () {
                            $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                            $.post("process.php", $("#adminmsg").serialize() + x+"&value=2",
                                function (data, status) {
                                    setTimeout(function () {
                                        $('body').loadingModal('destroy') ;

                                    },4000);
                                    $.alert({title:"Sucessful",content:"Message seny sucessfully",   animation: 'top',
                                        closeAnimation: 'scale',animationSpeed: 1000 });
                                    $("#message").val("");
                                    document.getElementById('staffcheck').checked = false;
                                    document.getElementById('gaugecheck').checked = false;
                                    document.getElementById('publiccheck').checked = false;
                                    document.getElementById('officerscheck').checked = false;


                                });
                           // $.alert('Confirmed!');

                        }},

                        cancel:  {

                            text: 'Cancel',
                            btnClass: 'btn-red',
                            action: function () {
                                $("#message").val("");
                                document.getElementById('staffcheck').checked = false;
                                document.getElementById('gaugecheck').checked = false;
                                document.getElementById('publiccheck').checked = false;
                                document.getElementById('officerscheck').checked = false;
                            }
                        },
                    }
                });

            }
            else
            {
                $("#noncheck").show();
            }
        }
    );


</script>
<script>


    $(function () {
        $('form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
            .on('form:submit', function() {
                return false; // Don't submit form for this demo
            });
    });



/***********get data for alerts**********/
    $.get("process2.php?value=31", function(data, status){
var obj=JSON.parse(data);

      //  alert("Data: \nStatus: " +data);
        var types=["s1","s2","g1","g2","o1","o2","notactivated"];
        var s1size=obj.s1.length;
        var s2size=obj.s2.length;
        var g1size=obj.g1.length;
        var g2size=obj.g2.length;
        var o1size=obj.o1.length;
        var o2size=obj.o2.length;
        var notsize=obj.notactivated.length;
$("#activationspan").text(notsize);
$("#updatespan").text(s1size+g1size+o1size);
$("#deletespan").text(s2size+g2size+o2size);
  });


/************get data end****************/
</script>
<?php
include_once "footer.php";
?>

