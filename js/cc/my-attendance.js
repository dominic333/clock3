
 $(function () {
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
 });

 $(function () {
     $('#date_from').datepicker({dateFormat: 'dd/mm/yy'});
     $('#date_to').datepicker({dateFormat: 'dd/mm/yy'});
 })
