"use strict";
Dropzone.autoDiscover = false;
$(function() {
    $("#permission-wrapper").css("display", "");
    $('.select2').select2();
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: fileUploadUrl,
        filebrowserUploadMethod: 'form'
    });
    var imageDropzone = new Dropzone("div#imageUpload", {
        init: function() {
            this.on("success", function(file, serverFileName) {
                $("#image").val(serverFileName.name)
                setTimeout(function() {
                    $(".dz-remove").html('<i class="ri-close-line"></i>')
                    $(".dz-details").html("")
                }, 500)
            })
            this.on("removedfile", function(file) {
                $.ajax({
                    url: removeUrl,
                    type: "POST",
                    data: {
                        name: $("#image").val(),
                    },
                }).done(function() {
                    $("#image").val("");
                })
            })
        },
        addRemoveLinks: true,
        url: dropzoneUrl,
        maxFiles: 1
    });
})
