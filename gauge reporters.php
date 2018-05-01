<?php
include_once "header.php";
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="js/jquery.loadingModal.min.js"></script>
    <link rel="stylesheet" href="css/jquery.loadingModal.css">
    <link rel="stylesheet" href="test/jquery-confirm.min.css">
    <script src="test/jquery-confirm.min.js"></script>
<div class="row mx-0 ">
    <div class="col-lg-2 bg-secondary navbar_both">
        <table class="btn-group-vertical my-1 m-sm-0 ">

            <tr>
                <button type="button" class="btn btn-default btn-block">Stakeholder Information</button>
            </tr>

            <tr>
                <button type="button" class="btn btn-default btn-block">Documents</button>
            </tr>
            <tr>
                <button type="button" class="btn btn-default btn-block">Rain Graphs</button>
            </tr>

            <tr>
                <button type="button" class="btn btn-default btn-block">Settings</button>
            </tr>



        </table>
    </div>
    <div class="col-lg-8 col-sm-12 col-xs-12 col-md-10 ">

        <nav aria-label="breadcrumb " class="mx-0" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>

        <div class="row col-sm-12 justify-content-lg-center justify-content-center">
            <div class="col-lg-6 col-lg-offset-3 col-md-12 col-sm-12  admin_msg_win">
                <form action="process.php" method="POST" id="gauge" role="form">
                    <legend class="legends">Please Enter Range</legend>


                    <label for="Gaugerange">Gauge Range</label>


                    <div class="input-group" style="margin-bottom: 10px;">

                        <input type="number" class="form-control" min="0"  required name="Gaugerange" id="gaugeranges" placeholder="Range" aria-describedby="basic-addon1">
                        <span class="input-group-addon" id="basic-addon1">mm</span>
                    </div>

                    <button type="submit" id="submitgauge" class="btn btn-primary admin_msg_submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-12 px-0 bg-secondary navbar_both">

        <div class="col-lg-12 col-sm-12 px-0">
            <button type="button" class="btn btn-primary my-2 mx-2">
                Inbox&nbsp; <span class="badge badge-light">4</span>
            </button>
            <button type="button" class="btn btn-primary my-2 mx-2 ">
                Requests&nbsp; <span class="badge badge-light">4</span>
            </button>

            <button type="button" class="btn btn-primary my-2 mx-2 ">
                Alerts&nbsp;<span class="badge badge-light ">4</span>
            </button>
            </button>

        </div>
    </div>
</div>







    <script>

        $("#gauge").submit(
            function (e) {
                e.preventDefault();


                $('body').loadingModal({text: 'please Wait'}).loadingModal('animation', 'fadingCircle');
                $.post(this.action, $(this).serialize() + "&value=9",
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
                                    title: 'Data added sucessfully',
                                    content: 'Please quickly<strong> update <strong>data is their any change ',
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


                            $("#gaugeranges").val(" ");

                        },4000);



                    });
            }
        );

    var out = $( document ).height();
    out=((out/1.5))+"px";
    $(".navbar_both").css("height", out);

</script>


<?php
include_once "footer.php";
?>