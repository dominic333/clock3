
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
	//background image
    $.backstretch(base_url+"/assets/cc/plugins/login/img/backgrounds/1kvn.jpg");

    
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });

    $('.login-form').on('submit', function(e) {

    	$(this).find('input[type="text"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});

    });
    
    
});
