

<div class="contentfirst">

    <section class="content-header">
        <h1>
            View Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>selfiemyaccount/account"><i class="fa fa-user"></i> Account</a></li>
            <li><a href="<?php echo base_url();?>selfiemyaccount/account"> View Profile</a></li>
        </ol>
    </section>

    <section class="content">

        <?php

        foreach($user_data as $row)
        {
            if($row->staff_photo!='')
            {
                $userImage= $row->staff_photo;
            }
            else
            {
                $userImage='';
            }
            $fullName=$row->staff_name;
            $loginName= $row->login_name;
            $contactno =$row->contact_number;
            $email=$row->email;
            $companyName= $row->company_name;
        }
        ?>
        <!-- ANNOUNCEMENTS-->
        <div class="row">

            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <div class="user-block">
                            <?php if($userImage!=''){ ?>
                                <img class="img-circle" src="<?php echo base_url();?>images/users/<?php echo  $userImage; ?>">
                            <?php } else { ?>
                            <img class="img-circle" src="<?php echo base_url();?>assets/snap/images/admin-user.png" alt="User Image">
                            <?php } ?>
                            <button id="editProfileBtn" name="editProfileBtn"  class="btn btn-warning pull-right" href="javascript:void(0)">Edit Profile</button>
                                <span class="username"><?php echo $fullName; ?></span>
                                <span class="description"><?php echo $companyName; ?></span>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" role="form" id="editProfileForm" name="editProfileForm" action="<?php echo base_url();?>selfiemyaccount/account/updateUserInfo" method="post" >
                            <div class="box-body">

                                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                                <div class="form-group">
                                    <label for="fullName" class="col-sm-3 control-label">Full Name</label>

                                    <div class="col-sm-7">
                                        <input id="fullName" name="fullName" value="<?php echo (isset($fullName)) ? $fullName :set_value(''); ?>" type="text" class="form-control readOnlyApplied" placeholder="Full Name" required readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="loginName" class="col-sm-3 control-label">Login Name</label>

                                    <div class="col-sm-7">
                                        <input id="loginName" name="loginName" value="<?php echo (isset($loginName)) ? $loginName :set_value(''); ?>" type="text" class="form-control readOnlyApplied" placeholder="Login Name" required readonly>
                                    </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Company</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Company" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Address</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Address" required>
                                    </div>
                                </div>
                                -->
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-7">
                                        <input id="email" name="email" value="<?php echo (isset($email)) ? $email :set_value(''); ?>" type="email" class="form-control readOnlyApplied"  placeholder="Email" required readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>

                                    <div class="col-sm-7">
                                        <input id="contactNumber" name="contactNumber" value="<?php echo (isset($contactno)) ? $contactno :set_value(''); ?>" type="text" class="form-control readOnlyApplied" placeholder="Contact Number" required readonly>
                                    </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Department</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Department" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Shift</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Shift" required>
                                    </div>
                                </div>
                                -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="reset" class="btn btn-danger" href="javascript:void(0)">Cancel</button>
                                        <button type="submit" class="btn btn-success" href="javascript:void(0)">Submit</button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-footer -->
                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col-md-4 -->

        </div>
        <!-- /.row -->

    </section>

</div>
