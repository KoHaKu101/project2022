$('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })

        function readURL(input, id_img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + id_img).attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#FILE_IMG").change(function() {
            var id_img = 'category-img-tag';
            readURL(this, id_img);
            $('#' + id_img).css('height', '432px', 'width', '768px');

        });
        $('#IMG_DIRECTOR').change(function() {
            var id_img = 'SHOW_DIRECTOR';
            readURL(this, id_img);
            $('#' + id_img).css('height', '299px', 'width', '243px');
        });
