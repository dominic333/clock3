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
        		

);
?>