$(document).ready(function(){
	
	  $("#departmentsList").DataTable();
	  $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	  });
	  
	  //Initialize Select2 Elements
     $(".select2").select2();
     
     
	   //Form validation: add a department
		//By Dominic; Dec 09,2016 
		$('#addDepartmentForm').validate(
		 {
		  rules: 
		  {
		     department:
			  {
		    	 required: true
		     }
		  },            
		  highlight: function(element) 
		  {
				  $(element).closest('.form-control').removeClass('success').addClass('error');
		  },
		  success: function(element) 
		  {
		
			  $(element).closest('.form-control').removeClass('error').addClass('success');
		  }
		});      
  

		//Function to edit a department
		//By Dominic;  Dec 09,2016 
		$(document).on('click','.modify_department_link',function (e) 
		{
			e.preventDefault();
			$('#editDepartmentForm')[0].reset();
			
			var dept_id		=		$(this).attr("data-dept_id");
			var department_name	=		$(this).attr("data-department_name");
			var company_id		=		$(this).attr("data-company_id");
			
		   $('#editDepartmentForm #dept_id').val(dept_id);
		   $('#editDepartmentForm #department').val(department_name);
		   $('#editDepartmentForm #company_id').val(company_id);
		   $('#editDepartmentModal').modal('show');  
		});     
		     
      //Form validation: edit a department
		//By Dominic;  Dec 09,2016 
		$('#editDepartmentForm').validate(
		 {
		  rules: 
		  {
		     department:
			  {
		    	 required:true
		     }
		    
		  },            
		  highlight: function(element) 
		  {
				  $(element).closest('.form-control').removeClass('success').addClass('error');
		  },
		  success: function(element) 
		  {
		
			  $(element).closest('.form-control').removeClass('error').addClass('success');
		  }
		});   
    
   //Function to delete a department
	//By Dominic;  Dec 11,2016 
	$(document).on('click','.delete_department_link',function (e) 
	{
		 e.preventDefault();
		 var dept_id	=	$(this).data('dept_id');
		 var company_id	=	$(this).data('company_id');
		 var post_url = base_url+"ccshifts/shifts/deleteDepartments";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{dept_id:dept_id,company_id:company_id,csrf_test_name:csrf_token},
		 type: "POST",
		 dataType: 'HTML',
		 beforeSend: function ( xhr ) 
		 {
	         //Add your image loader here
	        showLoader();
	    },
		 success: function(result)
	    { 
	    	hideLoader(); 	
	      var result= result.trim();
	      if(result=="deleted")
	      {
	      	$('#loading').hide(); // Ajax Loader Show		
				$('#row'+dept_id).remove();
	      }
	      else if(result=="exists")
	      {
	      	$.alert({
				    title: 'Failed !!',
				    content: 'Delete Department Failed. Please ensure User\(s\)/Shift in this Department have been reassigned.',
				    confirm: function(){
				       //document.getElementById("frm_modify_department").reset();
				       window.location.reload();
				    },
				    cancel:  function(){
				       //document.getElementById("frm_modify_department").reset();
				       window.location.reload();
				    },
				});
	      }
	    }
	  });//end of ajax 
		
	}); 
     
	
});