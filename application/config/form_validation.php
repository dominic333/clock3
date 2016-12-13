<?php
$config['error_prefix'] = '<label class="error">';
$config['error_suffix'] = '</label>';
$config = array(
        'login' => array(
        			array(
                        'field' => 'companyName',
                        'label' => $this->lang->line('companyName'),
                        'rules' => 'trim|required|alpha_numeric|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'name',
                        'label' => $this->lang->line('name'),
                        'rules' => 'trim|xss_clean|alpha_numeric|prep_for_form'
                ),
                array(
                        'field' => 'password',
                        'label' => $this->lang->line('password'),
                        'rules' => 'trim|xss_clean|alpha_numeric|prep_for_form'
                )
        ),
        'editCompanyInfoForm' => array(
        			array(
                        'field' => 'companyName',
                        'label' => $this->lang->line('companyName'),
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'companyLoginName',
                        'label' => 'Login Name',
                        'rules' => 'trim|required|xss_clean|alpha_numeric|prep_for_form'
                ),
                array(
                        'field' => 'companyAddress',
                        'label' => 'Address',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'companyContactPerson',
                        'label' => 'Contact Person',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'companyEmail',
                        'label' => 'Email',
                        'rules' => 'trim|required|xss_clean|valid_email|prep_for_form'
                ),
                array(
                        'field' => 'companyContactNumber',
                        'label' => 'Contact Number',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                )
        ),
        'contactSupportForm' => array(
        			array(
                        'field' => 'senderName',
                        'label' => 'Name',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'senderEmail',
                        'label' => 'Email',
                        'rules' => 'trim|xss_clean|required|prep_for_form|valid_email'
                ),
                array(
                        'field' => 'senderMessage',
                        'label' => 'Message',
                        'rules' => 'trim|xss_clean|required|prep_for_form'
                )
        ),
        'addAnnouncementForm' => array(
        			array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'message',
                        'label' => 'Message',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                )
        ),
        'editAnnouncementForm' => array(
        			array(
                        'field' => 'ancId',
                        'label' => 'Id',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                ),
                array(
                        'field' => 'message',
                        'label' => 'Message',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                )
        ),
        'addDepartmentForm' => array(
        			array(
                        'field' => 'department',
                        'label' => 'Department',
                        'rules' => 'trim|required|xss_clean|prep_for_form'
                )
        ),
       'editDepartmentForm' => array(
	  			array(
	               'field' => 'dept_id',
	               'label' => 'Department Id',
	               'rules' => 'trim|required|xss_clean|prep_for_form'
		       ),
		       array(
		               'field' => 'company_id',
		               'label' => 'Company Id',
		               'rules' => 'trim|required|xss_clean|prep_for_form'
		       ),
		       array(
		               'field' => 'department',
		               'label' => 'Department',
		               'rules' => 'trim|required|xss_clean|prep_for_form'
		       )
        ),
     'editProfileForm' => array(
        array(
            'field' => 'fullName',
            'label' => 'Full Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'loginName',
            'label' => 'Login Name',
            'rules' => 'trim|required|xss_clean|alpha_numeric|prep_for_form'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|xss_clean|valid_email|prep_for_form'
        ),
        array(
            'field' => 'contactNumber',
            'label' => 'Contact Number',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'remote_login_frm' => array(
        array(
            'field' => 'rstaff_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'rremotelogin',
            'label' => 'Login Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'rstaff_id',
            'label' => 'Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'monitor_attendance_frm' => array(
        array(
            'field' => 'mstaff_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'mmonitor',
            'label' => 'Monitor',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'mstaff_id',
            'label' => 'Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'forgot_user_frm' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'confrim_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'user_login',
            'label' => 'Login Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'user_email',
            'label' => 'Email',
            'rules' => 'trim|required|xss_clean|prep_for_form|valid_email'
        ),
        array(
            'field' => 'user_id',
            'label' => 'User Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'edit_user_frm' => array(
        array(
            'field' => 'staff_name',
            'label' => 'Staff Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'login_name',
            'label' => 'Login Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'email',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean|prep_for_form|valid_email'
        ),
        array(
            'field' => 'contact_number',
            'label' => 'Contact Number',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'staff_id',
            'label' => 'User Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'user_shiftchange_frm' => array(
        array(
            'field' => 'ststaff_name',
            'label' => 'Staff Name',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'ststaffType',
            'label' => 'Staff Type',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'ststaff_id',
            'label' => 'User Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'frm_add_department_ip' => array(
        array(
            'field' => 'department_ip',
            'label' => 'IP Address',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'frm_edit_whitelisted_ip' => array(
        array(
            'field' => 'department_ip',
            'label' => 'IP Address',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'whitelist_id',
            'label' => 'ID',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
    'frm_add_shifts' => array(
        array('field'   => 'shift_name'	, 'label'   => 'Shift Name', 'rules'   => 'trim|required|xss_clean'),
        array('field'   => 'timezone'	, 'label'   => 'Timezone', 'rules'   => 'trim|required|xss_clean'),

        array('field'   => 'starttime_mon'	, 'label'   => 'Monday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_mon'	, 'label'   => 'Monday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_tues', 'label'   => 'Tuesday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_tues'	, 'label'   => 'Tuesday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_wed'	, 'label'   => 'Wednesday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_wed'	, 'label'   => 'Wednesday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_thurs'	, 'label'   => 'Thursday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_thurs'	, 'label'   => 'Thursday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_fri'	, 'label'   => 'Friday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_fri'	, 'label'   => 'Friday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_sat'	, 'label'   => 'Saturday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_sat'	, 'label'   => 'Saturday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_sun'	, 'label'   => 'Sunday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_sun'	, 'label'   => 'Sunday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'sun_off'	, 'label'   => 'Sunday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'sat_off'	, 'label'   => 'Saturday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'fri_off'	, 'label'   => 'Friday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'thurs_off'	, 'label'   => 'Thursday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'wed_off'	, 'label'   => 'Wednesday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'tues_off'	, 'label'   => 'Tuesday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'mon_off'	, 'label'   => 'Monday Off', 'rules'   => 'trim|xss_clean')
    ),
    'frm_edit_shifts' => array(
        array('field'   => 'shift_id'	, 'label'   => 'Shift Id', 'rules'   => 'trim|required|xss_clean'),
        array('field'   => 'comp_id'	, 'label'   => 'Company Id', 'rules'   => 'trim|required|xss_clean'),

        array('field'   => 'shift_name'	, 'label'   => 'Shift Name', 'rules'   => 'trim|required|xss_clean'),
        array('field'   => 'timezone'	, 'label'   => 'Timezone', 'rules'   => 'trim|required|xss_clean'),

        array('field'   => 'starttime_mon'	, 'label'   => 'Monday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_mon'	, 'label'   => 'Monday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_tues', 'label'   => 'Tuesday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_tues'	, 'label'   => 'Tuesday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_wed'	, 'label'   => 'Wednesday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_wed'	, 'label'   => 'Wednesday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_thurs'	, 'label'   => 'Thursday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_thurs'	, 'label'   => 'Thursday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_fri'	, 'label'   => 'Friday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_fri'	, 'label'   => 'Friday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_sat'	, 'label'   => 'Saturday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_sat'	, 'label'   => 'Saturday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'starttime_sun'	, 'label'   => 'Sunday StartTime', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'endtime_sun'	, 'label'   => 'Sunday EndTime', 'rules'   => 'trim|xss_clean'),

        array('field'   => 'sun_off'	, 'label'   => 'Sunday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'sat_off'	, 'label'   => 'Saturday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'fri_off'	, 'label'   => 'Friday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'thurs_off'	, 'label'   => 'Thursday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'wed_off'	, 'label'   => 'Wednesday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'tues_off'	, 'label'   => 'Tuesday Off', 'rules'   => 'trim|xss_clean'),
        array('field'   => 'mon_off'	, 'label'   => 'Monday Off', 'rules'   => 'trim|xss_clean')
    ),
    'formUpdateNotificationTime' => array(
        array(
            'field' => 'shift_id',
            'label' => 'Shift Id',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'comp_id',
            'label' => 'Company ID',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        ),
        array(
            'field' => 'notify_time',
            'label' => 'Notification Time',
            'rules' => 'trim|required|xss_clean|prep_for_form'
        )
    ),
);
?>