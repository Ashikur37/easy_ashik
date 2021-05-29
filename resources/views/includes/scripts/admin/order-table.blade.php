<script src="{{asset('assets/admin/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script>
    "use strict";
        function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    $(function () {
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
    ajax: "{{ route($route) }}",
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
      $(document).on("keyup", "#searchBox" , debounce(function(e){
        table.search($('#searchBox').val()).draw();
    },200))
    $('#pagelen').on( 'change', function () {
        table.page.len($('#pagelen').val()).draw();
    } );
    $("#pagelen").css("display","inline-block");
    
    });
  </script>
