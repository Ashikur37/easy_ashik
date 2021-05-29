"use strict";
function showLoader() {
    $("#admin-loader").removeClass("d-none");
}
function hideLoader(){
    $("#admin-loader").addClass("d-none");
}
$(function() {
    $("#custom-scrollbar a").each(function() {
        var pageUrl = window.location.href;
        if (this.href == pageUrl) {
            $(this).addClass("active");
        }
    });
    $(".startDate").flatpickr();
    $(".endDate").flatpickr();
    $('.sidebar-wrapper .navbar-nav a').on('click', function () {
        $('.sidebar-wrapper .navbar-nav').find('a.active').removeClass('active');
        $(this).addClass('active');
    });
    $('.chek-all').on('click', function () {

        var checked = $(this).prop('checked');
        $(".check-element").each(function () {
            this.checked = checked;
        });
    });
   $('.select-status-head').on('change', function (e) {

      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      var route = $(this).data('route');
      var ids=[];
      $( ".check-id:checked" ).each(function(){
        ids.push($(this).data('id'));
      })
      showLoader();
      $.ajax({
          url: route+'/'+$(this).val()+'/'+JSON.stringify(ids),
          type: 'POST',
          dataType: 'json',
          data: {
              submit: true
          }
      }).always(function (data) {
          hideLoader();
          toastr.success(data.responseText)
          $('#takwa-table').DataTable().draw(false);
          $(".action-wrapper").css("display","none");
          $(".chek-all").prop("checked",false)
      });
  })
    $('.delete-button-head').on('click', function (e) {
        Swal.fire({
            title: lng.AreYouSureToDelete,
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lng.Yes,
            cancelButtonText: lng.No
          }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var route = $(this).data('route');
                var ids=[];
                $( ".check-id:checked" ).each(function(){
                  ids.push($(this).data('id'));
                })
                $.ajax({
                    url: route+'/'+JSON.stringify(ids),
                    type: 'DELETE',
                    data: {
                        method: '_DELETE',
                        submit: true
                    }
                }).always(function (data) {
                    $('#takwa-table').DataTable().draw(false);
                    $(".action-wrapper").css("display","none");
                    $(".chek-all").prop("checked",false)
                    toastr.success( data);
                });
            }
          })
    })
    // sm device sidebar
    $('.sidebar-trigger').on('click', function(e) {
        e.preventDefault();
        $('.sidebar-wrapper').addClass('sidebar-active');
        $('.body-overlay').addClass('is-visible');  
    });

    $('.body-overlay').on('click', function() {
      $(this).removeClass('is-visible');
      $('.sidebar-wrapper').removeClass('sidebar-active');
    });
});
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }