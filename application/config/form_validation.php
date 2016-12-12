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
    )

);
?>