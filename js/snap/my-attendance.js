  $(document).ready(function(){

     $("#myattendance").DataTable();
     $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false
     });

     //The Calender
     $("#calendar").datepicker();


      $("#date_to").datepicker({
          changeYear: true,
          minDate: '-12M',
          maxDate: '+0D',
      });

      $("#date_from").datepicker({
          changeYear: true,
          minDate: '-12M',
          maxDate: '+0D',
      });
  });