
    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });


    });

    $(function () {
        $('#dpfromdepartment').datepicker();
        $('#dptodepartment').datepicker();

        $('#dpfromuser').datepicker();
        $('#dptouser').datepicker();
    })

    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    })
