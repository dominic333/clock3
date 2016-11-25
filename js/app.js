$(document).ready(function(){
    
 // @ Praveen.v
 // Function for ajax loader
 $(document).ajaxStart(function() {
      $(".full-page-loader").show();
    });
    $(document).ajaxStop(function() {
      $(".full-page-loader").hide();
      
      
      $('.due_date').datetimepicker({
 			 format: 'YYYY/MM/DD',
 				// minDate :"moment",
 		}); 
 });
 
 //Function input only capital letters 
 //Author Anju Krishnan
 $('.capital_letters_only').bind('keyup blur', function(e) { 
    $(this).val(function(i, val) {
        return (val.replace(/[^a-z\s]/gi,'')).toUpperCase(); 
    });
});

 // Function to show the carousel indicators 
 //@ sarath
 var i=1;
$( ".carousel-indicators li" ).each(function( index ) {
   $(this).text(i);
   i++;
});    
/*$('.view_det_schedule').click(function(){
	console.log('a');
  $("i",this).toggleClass("fa fa-minus-square-o m-r-5 fa fa-plus-square-o m-r-5");
});*/

   //function to check all check box
   //@author shibon
   $('.checkall').change(function () {
    $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
	});
	//function for date picker
	//@author shibon
	 $('#datepicker').datetimepicker({
               format: 'YYYY/MM/DD',
 					minDate :"moment",
            });
     $('#resc_datepicker').datetimepicker({
               format: 'YYYY/MM/DD',
 					minDate :"moment",
            });   
       $('#bulk_resc_datepicker').datetimepicker({
               format: 'YYYY/MM/DD',
 					minDate :"moment",
            });
      $('.datepicker').datetimepicker({
               format: 'YYYY/MM/DD',
       });     
            
    //function for time picker
	//@author shibon
	 $('#timepicker').datetimepicker({ 
    			format: 'LT',
    		//	minuteStep: 15,
    			
      });
       
     $('#bulk_timepicker').datetimepicker({ 
    			//format:'HH:mm:mm',
    			format: 'LT'
    			
      });

 $('#datepicker_mfg').datetimepicker({
     format: 'YYYY/MM/DD',
});

 $('#datepicker_next_id').datetimepicker({
               format: 'YYYY/MM/DD',
 					//minDate :"moment",
            });
    
    /** 
	#################################################
	Date time picker initialize 
	################################################## **/
	 $('#expire_frmdate,#expire_todate').datetimepicker({
      format: 'YYYY-MM-DD',
      ignoreReadonly: true  
   });  
    $('.date_picker').datetimepicker({
      format: 'YYYY-MM-DD',
      ignoreReadonly: true  
   }); 
  $('body').on('focus',".datepicker_recurring_start", function(){
    $(this).datepicker();
});

 $('body').on('focusout',".datepicker_recurring_start", function(){
    $(this).removeClass('datepicker');
});



	//function for jquery chosen
	//@author shibon
	$(".chosen").chosen();
  
    //function to get first letter in a string
    //@sarath s
    var a = $('.widget-user-username').text();
    var b = a.charAt(0);
    $('.widget-title-icon').text(b);
  
    
    // @ Praveen.v
    // Function for FAQ page collapsible menu
			$('.exp_all_faq').click(function(e) {
                e.preventDefault();
				var newstate = $(this).attr('state') ^ 1,
					icon = newstate ? "minus" : "plus",
					text = newstate ? "Collapse" : "Expand";
				// if state=0, show all the accordion divs within the same block (in this case, within the same section)
				if ( $(this).attr('state')==="0" ) {
					console.log('1');
					$('.equipment-accordion .collapse:not(.in)').collapse('show');
				}
				// otherwise, collapse all the divs
				else {
					console.log('2');
					$('.equipment-accordion .collapse.in').collapse('hide');
				}
				$(this).html("<i class=\"fa fa-" + icon + "-circle\"></i> " + text +" All");
				$(this).attr('state',newstate);
			});                    
            // @ Praveen.v
		    // Function for toggle icon in collapsible menu
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find("i.indicator")
                    .toggleClass('fa-clone fa-square-o');
            }
            $('#accordion-equipment').on('hidden.bs.collapse', toggleChevron);
            $('#accordion-equipment').on('shown.bs.collapse', toggleChevron);
  
 
}); //End Ready

    // @ Praveen.v
    // Function for schedule-view toggle
        $(document).ready(function(){
    
             $(".detail-expand").click(function(){
                 $(".schedule-details").slideDown();
             });
            
            $(".detail-collapse").click(function(){
                 $(".schedule-details").slideUp(); 
             });
            
            $('.temp').click(function() {             
                 $(this).closest('.view_det_schedule').find('.schedule-details').slideToggle('fast');
            });
                    
        });



    // @ Praveen.v
    // Function for equip-view toggle
        $(document).ready(function(){
          $('.equip-temp').click(function (e) {
            e.preventDefault();
                $(this).tab('show');
                });
            $('.equip-temp').click(function() {             
                 $(this).closest('.view_det_equip').find('.equip-details').slideToggle('500');
            });
            $('.icon_display1').click(function(){
              icon = $(this).find("i.fa");
              icon.toggleClass("fa-plus-square-o fa-minus-square-o")
            });
        });
    // @ Praveen.v
    // Function for toggle icon in schedule page
            $('.icon_display').click(function(){
              icon = $(this).find("i.fa");
              icon.toggleClass("fa-plus-square-o fa-minus-square-o")
            });

   //function to remove tab-indexing from tool-tip
   //@author praveen V
    $('form a[data-toggle="tooltip"]').attr( "tabindex", "-1" );

//function to add class form control to select 
//@author shibon
$( window ).load(function() {
	$('.dataTables_length select').addClass('form-control');
	var url = window.location.href;   
	var element=$('.treeview-menu li a[href="'+url+'"]'); 
	element.closest('.treeview').addClass('active'); 
	element.addClass('current');

	var element1=$('.treeview a[href="'+url+'"]'); 
	element1.closest('.treeview').addClass('active');
});

//function to load new tab pane

;( function( window ) {
	
	'use strict';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWTabs.prototype.options = {
		start : 0
	};

	CBPFWTabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content-wrap > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} );
		} );
	};

	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			this.tabs[ this.current ].className = this.items[ this.current ].className = '';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className ='tab-current';
		this.items[ this.current ].className ='content-current';
	};

	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;

})( window );

			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();

