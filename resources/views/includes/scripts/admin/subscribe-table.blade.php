<script src="{{asset('assets/admin/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script> 
    $(function () {
    "use strict";
      var table=$("#takwa-table").DataTable({
        "aaSorting": [],
        "drawCallback": function( settings ) {
            $(".switch-status").on('change',function() {
                var status=$(this).prop('checked')?1:0;
                var url = $(this).data('href')+"/"+status;
                $.ajax({
                    url: url,
                    type: 'get'
                }).always(function (data) {
                    $('#takwa-table').DataTable().draw(false);
                });

            });
            $( '.check-element' ).on( 'click', function () {
                if($( ".check-id:checked" ).length>0){
                    $(".action-wrapper").css("display","flex");
                }
                else{
                    $(".action-wrapper").css("display","none");
                }
            });
            $( '.delete-button' ).on( 'click', function (e) {
            Swal.fire({
            title: lng.AreYouSureToDelete,
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{$lng->Yes}}",
            cancelButtonText: "{{$lng->No}}"
          }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('href');
            // confirm then
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {method: '_DELETE', submit: true}
            }).always(function (data) {
                $('#takwa-table').DataTable().draw(false);
                toastr.success( data) 
            });
            }
        })
        })
},
        processing: true,
    serverSide: true,
    ajax: "{{ URL::to($route) }}",
    columns: [
        @foreach($columns as $column)
        @if($column)
        {data: '{{$column["name"]}}', name: '{{$column["name"]}}', orderable: {{$column["order"]}}, searchable: {{$column["order"]}}},
        @endif
        @endforeach
    ],
        "language": {
                "lengthMenu": ``,
                "processing": "<img src='{{asset('images/banner/'.$setting->admin_loader)}}'/>",
            },
            "responsive": true,
            "autoWidth": false,
            "info": true,
      });
      $('#searchBox').on( 'keyup click', function () {
         table.search($('#searchBox').val()).draw();
    } );
    $('#pagelen').on( 'change', function () {
        table.page.len($('#pagelen').val()).draw();
    } );
    $("#pagelen").css("display","inline-block");
    $('.select2').select2({
        minimumResultsForSearch: -1
        });;
    });
  </script>
