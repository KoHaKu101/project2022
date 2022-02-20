<script>
    function modalslide(thisdata) {
        var number_slide = $(thisdata).data("number");
        var modal_header = "ภาพสไสลด์ที่" + number_slide;
        $('#MODAL_NAME_SLIDE').html(modal_header);
        $("#NUMBER_SLIDE").val(number_slide);
        $('#modalslide').modal("show");
    }

    function addnumber_slide() {
        Swal.fire({
            text: 'ใส่จะนวนสไลด์ที่ต้องการ',
            input: 'number'
        }).then(function(result) {
            if (result.value) {
                var url = "{{ route('slide.number') }}?number=" + result.value;
                console.log(url);
                $.ajax({
                    type: "POST",
                    url: url,
                    success: function(response) {
                        Swal.fire({
                            icon: response.alert,
                            title: response.title,
                            text: response.text,
                            timer: 1000,
                        }).then(function() {
                            location.reload();
                        });

                    }
                });

            }
        })
    }

    function delete_slide_img(thisdata) {
        var number_img = $(thisdata).data('number');
        Swal.fire({
            icon: 'warning',
            title: 'ยืนยันการลบไฟล์',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-trash"></i> ยืนยัน',
            cancelButtonText: '<i class="fa fa-times"></i> ยกเลิก',
        }).then(function(result) {
            if (result.isConfirmed) {
                var url = "{{ route('slide.remove') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        'IMG_NUMBER': number_img
                    },
                    success: function(response) {
                        if (response.massage) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบไฟล์สำเร็จ',
                                showCloseButton: true,
                                showCancelButton: false,
                                confirmButtonColor: '#5cb85c',
                                confirmButtonText: '<i class="fa fa-check"></i> ยืนยัน',
                            }).then(function(result) {
                                location.reload();
                            })
                        }
                    }
                });
            }
        })
    }
</script>
