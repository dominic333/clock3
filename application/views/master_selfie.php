<?php $this->load->view('includes_selfie/top'); ?>
<?php
    if(isset($view))
    {
        $this->load->view($view);
    }
?>
<?php $this->load->view('includes_selfie/bottom'); ?>
<?php echo (isset($footer_includes) ? $footer_includes :''); ?> 
<?php $this->load->view('includes_selfie/closinghtml'); ?>