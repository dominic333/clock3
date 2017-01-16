
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reports
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccreports/reports"><i class="fa fa-leanpub"></i> Reports</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <h3 class="box-title"><p>Department / Shift Attendance Report</p></h3>

                        <div class="row">
                         <form  role="form" id="frm_department_attendance" name="frm_department_attendance" action="<?php echo base_url();?>ccreports/reports/" method="post" >
                            <div class="form-group">
                                <div class="col-md-3">

                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpfromdepartment'>
                                        <input type="text" class="form-control" placeholder="From" id="date_from" name="date_from"  value="<?php echo (isset($date_from)) ? $date_from :set_value('date_from'); ?>" data-date-format="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-provide="datepicker"
                                         id='dptodepartment'>
                                        <input type="text" class="form-control" placeholder="To" id="date_to"  name="date_to"  value="<?php echo (isset($date_to)) ? $date_to :set_value('date_to'); ?>" data-date-format="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control select2" style="width: 100%;" id="multiSelect" name="multiSelect" >
                                       <option value="">-- Select a shift --</option>
							                  <?php foreach($company_shifts as $shift){?>
							                  <option value="<?php echo $shift->shift_id;?>" <?php echo (isset($multiSelect) && ($multiSelect==$shift->shift_id)? 'selected="selected"' : set_select('multiSelect',$shift->shift_id));?> >
							                  <?php echo $shift->shift_name;?>
							                  </option>
							                  <?php } ?> 
                                    </select>
                                </div>
											<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                                <div class="col-md-3">
                                    <button type="submit" id="Submit" name="Submit" class="btn btn-success"><span
                                            class="fa fa-search"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        	 <?php echo (isset($attendance_shift)) ? $attendance_shift :'Please Select The dates'; ?> 
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->



        <!-- ===============================User Attendance Report=====================================-->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <h3 class="box-title"><p>User Attendance Report</p></h3>
								<form  role="form" id="frm_user_attendance" name="frm_user_attendance" action="<?php echo base_url();?>ccreports/reports/" method="post" >
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">

                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpfromuser'>
                                        <input type="text" class="form-control" placeholder="From" id="udate_from" name="udate_from"  value="<?php echo (isset($udate_from)) ? $udate_from :set_value('udate_from'); ?>" data-date-format="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-provide="datepicker"
                                         id='dptouser'>
                                        <input type="text" class="form-control" placeholder="To" id="udate_to"  name="udate_to"  value="<?php echo (isset($udate_to)) ? $udate_to :set_value('udate_to'); ?>" data-date-format="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control select2" style="width: 100%;" id="umultiSelect" name="umultiSelect" >
                                       <option value="all" <?php echo (isset($umultiSelect) && ($umultiSelect=='all')? 'selected="selected"' : set_select('umultiSelect','all'));?>> -- Select All --</option>
							                  <?php foreach($company_members as $member){ ?>
							                  <option value="<?php echo $member->staff_id;?>" <?php echo (isset($umultiSelect) && ($umultiSelect==$member->staff_id)? 'selected="selected"' : set_select('umultiSelect',$member->staff_id));?> >
							                  <?php echo $member->staff_name;?>
							                  </option>
							                  <?php } ?> 
                                    </select>
                                </div>
											<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                                <div class="col-md-3">
                                    <button type="submit" name="Submit" id="Submit" class="btn btn-success"><span
                                            class="fa fa-search"
                                            aria-hidden="true"></span>
                                    </button>
                                    <button type="button" id="download_user_attendance_link" class="btn btn-primary full-search">
                                    			<span class="fa fa-download"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
								</form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <?php echo (isset($attendance_user)) ? $attendance_user :'Please Select The dates'; ?> 
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

      <?php 
		$reportMonthLimit		= $this->authentication->reportMonthLimit(); 
		
		if($reportMonthLimit==PAID_REPORTMONTHLIMIT)
		{
		?>
		<script type="text/javascript">
			$(document).ready(function(){
			     
			     $("#date_to").datepicker({ 
			         changeYear: true,
			         minDate: '-12M',
			         maxDate: '+0D',
			     });
			     
			     $("#date_from").datepicker({ 
			         changeYear: true,
			         minDate: '-12M',
			         maxDate: '+0D',
			     });
			     
			     $("#udate_to").datepicker({ 
			         changeYear: true,
			         minDate: '-12M',
			         maxDate: '+0D',
			     });
			     
			     $("#udate_from").datepicker({ 
			         changeYear: true,
			         minDate: '-12M',
			         maxDate: '+0D',
			     });
			});
		</script>
		<?php
		}
		else
		{
		?>
		<script type="text/javascript">
			$(document).ready(function(){
			     
			     $("#date_to").datepicker({ 
			         changeYear: true,
			         minDate: '-3M',
			         maxDate: '+0D',
			     });
			     
			     $("#date_from").datepicker({ 
			         changeYear: true,
			         minDate: '-3M',
			         maxDate: '+0D',
			     });
			     
			     $("#udate_to").datepicker({ 
			         changeYear: true,
			         minDate: '-3M',
			         maxDate: '+0D',
			     });
			     
			     $("#udate_from").datepicker({ 
			         changeYear: true,
			         minDate: '-3M',
			         maxDate: '+0D',
			     });
			});
		</script>
		<?php 
		}
		?>
