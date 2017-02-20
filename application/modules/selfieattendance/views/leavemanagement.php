<div class="contentfirst">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Leave Calendar
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>selfiemyaccount/account"><i class="fa fa-calendar"></i> Account</a>
            </li>
            <li><a href="<?php echo base_url(); ?>selfieattendance/attendance/leavemanagement"> My Leave Calendar</a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h4>Step 1: Select Dates</h4>
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="leaveCalendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h4>Step 2: Add Note & Select Leave Type</h4>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fill Form</h3>
                    </div>

                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add Note</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Leave Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->


    </section>

</div>