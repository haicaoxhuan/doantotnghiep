$(function () {
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

    myDropzone.on("addedfile", function (file) {
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
            success: function (response) {
                $(filePreview).find("input").val(response.success);
            },
        });
    }),
        $(document).on("click", ".delete", function () {
            var $ele = $(this).parent().parent().parent();
            console.log($ele);
            var file_name = $(this).closest(".file-row").find("input").val();
            console.log(file_name);
            $.ajax({
                url: "/admin/product/remove",
                cache: false,
                type: "GET",
                data: {
                    file_name: file_name,
                },
                success: function (response) {
                    if (response.status == 200) {
                        $ele.fadeOut().remove();
                    }
                },
            });
        });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width =
            progress + "%";
    });

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement
            .querySelector(".start")
            .setAttribute("disabled", "disabled");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0";
    });
    // DropzoneJS Demo Code End

    $(".product-vali").validate({
        rules: {
            'name': {
                required: true,
                maxlength: 200,
                minlength: 6,
            },
            'price': {
                required: true,
                digits: true,
            },
            'image': {
                required: true,
                extension: "jpg|jpeg|png|bmp|gif|svg|webp",
                filesize: 2097152,
            },
            'sku': {
                required: true,
                // regex: '^[a-zA-Z0-9_.]$/i',
                minlength: 6,
                maxlength: 20,
            },
            'qty': {
                required: true,
                digits: true,
            },
            'des': {
                required: true,
                maxlength: 5000,
                minlength: 10,
            },
            'sort_des': {
                required: true,
                maxlength: 255,
                minlength: 10,
            },
            'brand_id': {
                required: true,
            },
            'category[]': {
                required: true,
            },
            'color': {
                required: true,
            },
            'color_code': {
                required: true,
            },
        },
        messages: {
            'name': {
                required: "Tên sản phẩm không được phép để trống",
                maxlength: "Tên danh mục chỉ được tối đa 200 ký tự",
                minlength: "Tên danh mục chỉ được tối thiểu 6 ký tự",
            },
            'price': {
                required: "Giá sản phẩm không được phép để trống",
                digits: "Giá sản phẩm phải là số",
            },
            'image': {
                required: "Ảnh không được phép bỏ trống",
                extension:
                    "Ảnh phải có định dạng jpg,jpeg,png,bmp,gif,svg,webp",
                filesize: "Ảnh không quá 3MB",
            },
            'sku': {
                required: "Mã vạch không được để trống",
                // regex: "Mã vạch chỉ được là 0-9 hoặc a-z hoặc A-Z",
                minlength: "Mã vạch phải từ 6 kí tự",
                maxlength: "Mã vạch không được quá 20 kí tự",
            },
            'qty': {
                required: "Số lượng sản phẩm không được để trống",
                digits: "Số lượng sản phẩm phải là số",
            },
            'des': {
                required: "Mô tả sản phẩm không được để trống",
                maxlength: "Mô tả sản phẩm tối đa 5000 ký tự",
                minlength: "Mô tả sản phẩm tối thiểu 10 ký tự",
            },
            'sort_des': {
                required: "Mô tả ngắn sản phẩm không được để trống",
                maxlength: "Mô tả ngắn sản phẩm tối đa 255 ký tự",
                minlength: "Mô tả ngắn sản phẩm tối thiểu 10 ký tự",
            },
            'brand_id': {
                required: "Vui lòng chọn thương hiệu",
            },
            'category[]': {
                required: "Vui lòng chọn danh mục",
            },
            'color': {
                required: "Màu sản phẩm không được để trống",
            },
            'color_code': {
                required: "Mã màu sản phẩm không được để trống",
            },
        },
        errorClass: "invalid-alert text-danger",
        errorElement: "div",
        errorPlacement: function (error, element) {
            console.log(element);
            if (element.data("select2")) {
                element.parent().append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        },
    });

    
});
