<?php $this->load->view('includes_cc/app-admin'); ?>
<?php
    if(isset($view))
    {
        $this->load->view($view);
    }
?>
<?php $this->load->view('includes_cc/footer'); ?>
<?php echo (isset($footer_includes) ? $footer_includes :''); ?> 
<?php $this->load->view('includes_cc/closinghtml'); ?>