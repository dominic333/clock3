


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
                <small></small>
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
                            <h3 class="box-title">Mark Attendance</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <!-- html5 video
                            <video autoplay="true" id="videoElement"></video>
                            -->
                              <input type="hidden" name="geolocation" id="geolocation" value=""/>
										<video id="videoElement"  autoplay></video>
										<canvas id="canvas" width="640" height="480" style="display:none"></canvas>
										<select name="vclocktype" id="vclocktype" class="form-control attendance-control">
                               	<?php if ($staff_already_in == "" || $staff_mark_absent != ""){ ?>
                               		<option value="in" selected="selected">Clock In</option>
                               	<?php }else{ ?>
                               			<?php if ($staff_break_state == 0){ ?>
                               				<option value="brkOut">Clock as Taking a Break</option>
                               				<option value="Out">Clock Out</option>
                               			<?php }else{ ?>
                               				<option value="brkin">Clock as Returning from Break</option>
                               			<?php } ?>
                               	<?php } ?>
                              </select>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p><h4>9 September, 2016 - Monday - 00:00:00 AM</h4></p>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                 <a class="btn btn-danger pull-left" id="take_selfie_subt" data-staff_id="<?php echo $this->session->userdata('mid');?>" href="#">
					                     Mark Attendance
					                  </a>
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
