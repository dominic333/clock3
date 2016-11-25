


<style>
    #videoElement {
        width: 100%;
        /*height: auto;*/
        height: 375px;
        background-color: #fff;
    }

    /* untuk ukuran 1080px kebawah */
    @media screen and (max-width: 1024px) {
        #videoElement {
            height: auto;
        }
    }

    /* untuk ukuran layar 700px kebawah */
    @media screen and (max-width: 780px) {
        #videoElement {
            /*height: auto;*/
            height: 300px;
        }
    }

</style>


    <div class="contentfirst">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Selfie
                <small>Lorem Ipsum ....</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="my-attendance.php"><i class="fa fa-picture-o"></i> Selfie</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">


            <div class="row">

<!--                <div class="col-md-6 col-md-offset-3">-->
                <div class="col-md-8 col-md-offset-2">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lorem Ipsum.....</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <!-- html5 video-->
                            <video autoplay="true" id="videoElement"></video>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p><h4>9 September, 2016 - Monday - 00:00:00 AM</h4></p>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                    <button class="btn btn-danger pull-left" href="javascript:void(0)">Clock In</button>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                    <button class="btn btn-danger" href="javascript:void(0)">Break
                                        Time</button>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                    <button class="btn btn-danger pull-right" href="javascript:void(0)">Clock Out</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!--/row-->


        </section>
        <!-- /.content -->

    </div>

<!-- footer -->

<script>
    var video = document.querySelector("#videoElement");

    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    if (navigator.getUserMedia) {
        navigator.getUserMedia({video: true}, handleVideo, videoError);
    }

    function handleVideo(stream) {
        video.src = window.URL.createObjectURL(stream);
    }

    function videoError(e) {
        // do something
    }
</script>
