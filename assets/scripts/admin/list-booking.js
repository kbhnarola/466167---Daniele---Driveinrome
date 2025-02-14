$(document).ready(function(){





    $('#start_date').daterangepicker({


        opens: 'right',


        locale: {


            format: 'YYYY-MM-DD'


        },


        autoUpdateInput: false


    });


    // $('#end_date').datepicker({


    //     // todayBtn:'linked',


    //     format: 'dd-mm-yyyy',


    //     autoclose: true,


    //     todayHighlight: true,


    // });


    


    fetch_data('no');





    function fetch_data(is_date_search, start_date='', end_date='')


    {


        var dataTable = $('#booking_list_table').DataTable({


            // Processing indicator


            "processing": true,


            // DataTables server-side processing mode


            "serverSide": true,


            // Initial no order.


            "order": [],


            "searching": true,


            //"scrollY": 200,


            //"scrollX": 200,





            // Load data from an Ajax source


            "ajax": {


                "url": BASE_URL+'bookings/getLists/',


                "type": "POST",


                "data":{


                    "is_date_search":is_date_search, 


                    "start_date":start_date, 


                    "end_date":end_date


                }


            },


            "columns": [


                    { data: 'RecordID', 'sortable': false,"orderable": false }, //0


                    { data: 'username' } , //1


                    { data: 'email' } , //2


                    { data: 'phone_number' } , //3                    


                    { data: 'tour_name' } , //4


                    { data: 'type' } , //5

                    { data: 'created_date' } , //6

                    { data: 'service_booked_date' } , //7


                    { data: 'is_subscribe', 'sortable': true,"orderable": true} , //8


            ],


            "columnDefs": [ 


                { "width": "30%", "targets": 4 }


            ],


            //fixedColumns: true


        });


    }


    // $('#search').click(function(){


    //     var start_date = $('#Date').data('daterangepicker').startDate._d;


    //     var end_date = $('#Date').data('daterangepicker').endDate._d;


    //     // var start_date = $('#start_date').val();


    //     // var end_date = $('#end_date').val();


    //     if(start_date != '' && end_date !='')


    //     {


    //         $('#booking_list_table').DataTable().destroy();


    //         fetch_data('yes', start_date, end_date);


    //     }


    //     else


    //     {


    //         $('#booking_list_table').DataTable().destroy();


    //         fetch_data('no');


    //     }


    // });





    $('input[name="start_date"]').on('apply.daterangepicker', function(ev, picker) {


        $('#booking_list_table').DataTable().destroy();


        fetch_data('yes', picker.startDate.format('YYYY/MM/DD'),  picker.endDate.format('YYYY/MM/DD'));


        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));


    });


    $('input[name="start_date"]').on('cancel.daterangepicker', function(ev, picker) {


        $('input[name="start_date"]').val('');


        $('#booking_list_table').DataTable().destroy();


        fetch_data('no');


    });


    $('#clear').on('click', function(){


        jQuery('#start_date').val('');


        $('#booking_list_table').DataTable().destroy();


        fetch_data('no');


    });


});