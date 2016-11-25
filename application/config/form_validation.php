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
        )		



);
?>