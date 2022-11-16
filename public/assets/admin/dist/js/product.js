$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone("#upfile", { // Make the whole body a dropzone
        url: "#",
        maxFilesize: 2,
        thumbnailMethod: "crop",
        paramName: "productImg",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 20,
        previewTemplate: previewTemplate,
        autoQueue: false,
        previewsContainer: "#previews",
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
        var filePreview = file.previewTemplate
        var fd = new FormData();
        fd.append('productImg', file);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: '/admin/product/upload',
            cache: false,
            type: 'POST',
            data: fd,
            processData: false, ///required to upload file
            contentType: false, /// required
            success: function(response) {
                $(filePreview).find("input").val(response.success);
            }
        })
    }),

    $(document).on("click", ".delete", function() {
        var $ele = $(this).parent().parent().parent();
        var file_name = $(this).closest('.file-row').find('input').val();
        $.ajax({
            url: '/admin/product/remove',
            cache: false,
            type: 'GET',
            data: {
                'file_name': file_name
            },
            success: function(response) {
                if (response.status == 200) {
                    $ele.fadeOut().remove();
                }
            }
        })
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        console.log(1);
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
        console.log(2);
    })
    // DropzoneJS Demo Code End
})