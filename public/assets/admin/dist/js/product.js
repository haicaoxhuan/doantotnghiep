$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false;

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone("#upfile", {
        // Make the whole body a dropzone
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
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    });

    myDropzone.on("addedfile", function(file) {
            var filePreview = file.previewTemplate;
            var fd = new FormData();
            fd.append("productImg", file);
            $.ajax({
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                url: "/admin/product/upload",
                cache: false,
                type: "POST",
                data: fd,
                processData: false, ///required to upload file
                contentType: false, /// required
                success: function(response) {
                    $(filePreview).find("input").val(response.success);
                },
            });
        }),
        $(document).on("click", ".delete", function() {
            var $ele = $(this).parent().parent().parent();
            var file_name = $(this).closest(".file-row").find("input").val();
            $.ajax({
                url: "/admin/product/remove",
                cache: false,
                type: "GET",
                data: {
                    file_name: file_name,
                },
                success: function(response) {
                    if (response.status == 200) {
                        $ele.fadeOut().remove();
                    }
                },
            });
        });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width =
            progress + "%";
    });

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement
            .querySelector(".start")
            .setAttribute("disabled", "disabled");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0";
    });
    // DropzoneJS Demo Code End

    $(".product-vali").validate({
        rules: {
            name: {
                required: true,
                maxlength: 200,
                minlength: 6,
            },
            price: {
                required: true,
                digits: true,
            },
            image: {
                required: true,
                extension: "jpg|jpeg|png|bmp|gif|svg|webp",
                filesize: 2097152,
            },
            sku: {
                required: true,
                // regex: '^[a-zA-Z0-9_.]$/i',
                minlength: 6,
                maxlength: 20,
            },
            qty: {
                required: true,
                digits: true,
            },
            des: {
                required: true,
                maxlength: 5000,
                minlength: 10,
            },
            sort_des: {
                required: true,
                maxlength: 255,
                minlength: 10,
            },
            brand_id: {
                required: true,
            },
            "category[]": {
                required: true,
            },
            color: {
                required: true,
            },
            color_code: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "T??n s???n ph???m kh??ng ???????c ph??p ????? tr???ng",
                maxlength: "T??n danh m???c ch??? ???????c t???i ??a 200 k?? t???",
                minlength: "T??n danh m???c ch??? ???????c t???i thi???u 6 k?? t???",
            },
            price: {
                required: "Gi?? s???n ph???m kh??ng ???????c ph??p ????? tr???ng",
                digits: "Gi?? s???n ph???m ph???i l?? s???",
            },
            image: {
                required: "???nh kh??ng ???????c ph??p b??? tr???ng",
                extension: "???nh ph???i c?? ?????nh d???ng jpg,jpeg,png,bmp,gif,svg,webp",
                filesize: "???nh kh??ng qu?? 3MB",
            },
            sku: {
                required: "M?? v???ch kh??ng ???????c ????? tr???ng",
                // regex: "M?? v???ch ch??? ???????c l?? 0-9 ho???c a-z ho???c A-Z",
                minlength: "M?? v???ch ph???i t??? 6 k?? t???",
                maxlength: "M?? v???ch kh??ng ???????c qu?? 20 k?? t???",
            },
            qty: {
                required: "S??? l?????ng s???n ph???m kh??ng ???????c ????? tr???ng",
                digits: "S??? l?????ng s???n ph???m ph???i l?? s???",
            },
            des: {
                required: "M?? t??? s???n ph???m kh??ng ???????c ????? tr???ng",
                maxlength: "M?? t??? s???n ph???m t???i ??a 5000 k?? t???",
                minlength: "M?? t??? s???n ph???m t???i thi???u 10 k?? t???",
            },
            sort_des: {
                required: "M?? t??? ng???n s???n ph???m kh??ng ???????c ????? tr???ng",
                maxlength: "M?? t??? ng???n s???n ph???m t???i ??a 255 k?? t???",
                minlength: "M?? t??? ng???n s???n ph???m t???i thi???u 10 k?? t???",
            },
            brand_id: {
                required: "Vui l??ng ch???n th????ng hi???u",
            },
            "category[]": {
                required: "Vui l??ng ch???n danh m???c",
            },
            color: {
                required: "M??u s???n ph???m kh??ng ???????c ????? tr???ng",
            },
            color_code: {
                required: "M?? m??u s???n ph???m kh??ng ???????c ????? tr???ng",
            },
        },
        errorClass: "invalid-alert text-danger",
        errorElement: "div",
        errorPlacement: function(error, element) {
            console.log(element);
            if (element.data("select2")) {
                element.parent().append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
    });
});