

    <div class="contentfirst" xmlns="http://www.w3.org/1999/html">

        <section class="content-header">
            <h1>
                Who's Around Today
                <small>Lorem Ipsum ....</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>selfiemyaccount/account"><i class="fa fa-user"></i> Account</a></li>
                <li><a href="<?php echo base_url();?>selfieattendance/attendance/whosaroundtoday"><i></i> Who's Around Today</a></li>
            </ol>
        </section>

        <section class="content">


            <div class="row">

                <div class="col-md-8">
                    <!-- USERS LIST -->
                    <div class="box box-default">
                        <!-- /.box-header -->
                         <form  role="form" id="frm_who_around" name="frm_who_around" action="<?php echo base_url();?>selfieattendance/attendance/whosaroundtoday" method="post" >
			                    <div class="box-body">
			                        <div class="form-group">
			                            <label>Select Shift</label>
			                            <select name="shifts" id="shifts" onchange="document.getElementById('shift_id').value	=this.value;document.getElementById('frm_who_around').submit();" data-placeholder="-- Select A Shift* --"  class="form-control select2" style="width: 100%;" >
								                  <option value="">-- All Shifts --</option>
								                  <?php foreach($company_shifts as $shift){?>
								                  <option value="<?php echo $shift->shift_id;?>" <?php echo (isset($shifts) && ($shifts==$shift->shift_id)? 'selected="selected"' : set_select('shifts',$shift->shift_id));?> >
								                  <?php echo $shift->shift_name;?>
								                  </option>
								                  <?php } ?> 
								             </select>
			                        </div>
			                        <input type="hidden" name="shift_id"  id="shift_id" value=""/>
				         				<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
			                        <!-- /.form-group -->
			                    </div>
		                    </form>
                        <!-- /.box-body -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!--/row-->


            <div class="row">
					 <?php echo (isset($department_attendance)) ? $department_attendance :'Please Select A Shift'; ?> 

            </div>
            <!-- /.row -->


        </section>

    </div>

