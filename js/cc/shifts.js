$(document).ready(function(){
	
  $("#example1").DataTable();
  
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

  //Timepicker
  $(".timepicker").timepicker({
      showInputs: false,
      showMeridian:false
  });
  
  
	
});

