   <script>
       function modal_post(thisdata) {
           var title = $(thisdata).data('name');
           var title = "เพิ่มข่าวสาร";
           $('#modal_post_title').html(title);
           $('#modal_post').modal('show');
       }

       function post_step2(thisdata) {
           var position = $(thisdata).data('position');
           $('.post_position').removeClass('selected-btn');
           $('.' + position).addClass('selected-btn');
           $('#POST_IMG_POSITION').val(position);
       }

       function post_step1(thisdata) {
           var type_post = $(thisdata).data('typepost');
           if (type_post == 'DEFAULT') {
               $('#BTN_DEFAULT').addClass('selected-btn');
               $('#BTN_PDF').removeClass('selected-btn');
               $('#POST_TYPE_DEFAULT').val(type_post);
               $('#POST_TYPE_PDF').val('');

               $('#FRM_POST_DEFAULT').attr('hidden', false);
               $('#FRM_POST_PDF').attr('hidden', true);
               $('#BTN_NEXT').data('step', 2);
           } else if (type_post == 'PDF') {
               $('#BTN_PDF').addClass('selected-btn');
               $('#BTN_DEFAULT').removeClass('selected-btn');
               $('#POST_TYPE_PDF').val(type_post);
               $('#POST_TYPE_DEFAULT').val('');

               $('#FRM_POST_PDF').attr('hidden', false);
               $('#FRM_POST_DEFAULT').attr('hidden', true);
               $('#BTN_NEXT').data('step', 3);
           }
       }

       function next_step(thisdata) {
           var step = $(thisdata).data('step');
           var check_step_1_default = $('#POST_TYPE_DEFAULT').val();
           var check_step_1_pdf = $('#POST_TYPE_PDF').val();
           if (check_step_1_default != '' || check_step_1_pdf != '') {
               if (step == 2) {
                   $('#POST_BTN_CLOSE').attr('hidden', true);
                   $('#BTN_RETURN').attr('hidden', false);
                   $('#BTN_NEXT').data('step', 3);
                   $('#step1,#step1_active').removeClass('active');
                   $('#step2,#step2_active').addClass('active');
                   $('#step1_active').addClass('nav-link-success');
               } else if (step == 3) {
                   var check_position = $('#POST_IMG_POSITION').val();
                   if (check_step_1_pdf != '') {
                       $('#POST_BTN_CLOSE,#BTN_NEXT').attr('hidden', true);
                       $('#POST_BTN_SUBMIT,#BTN_RETURN').attr('hidden', false);
                       $('#BTN_RETURN').data('step', 1);
                       $('#step1,#step2,#step2_active').removeClass('active');
                       $('#step3,#step3_active').addClass('active');
                       $('#step1_active,#step2_active').addClass('nav-link-success');
                   } else if (check_position != '') {
                       $('#POST_BTN_SUBMIT').attr('hidden', false);
                       $('#BTN_NEXT').attr('hidden', true);
                       $('#BTN_RETURN').data('step', 2);
                       $('#step2,#step2_active').removeClass('active');
                       $('#step3,#step3_active').addClass('active');
                       $('#step2_active').addClass('nav-link-success');
                   } else {
                       Swal.fire({
                           icon: 'warning',
                           title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                           timer: 1500
                       });
                   }
               }
           } else {
               Swal.fire({
                   icon: 'warning',
                   title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                   timer: 1500
               });
           }

       }

       function return_step(thisdata) {
           var step = $(thisdata).data('step');
           var check_step_1_pdf = $('#POST_TYPE_PDF').val();
           if (step == 1) {
               if (check_step_1_pdf != '') {
                   $('#BTN_NEXT').data('step', 3);

                   $('#POST_BTN_CLOSE,#POST_BTN_SUBMIT').attr('hidden', true);
                   $('#BTN_RETURN,#BTN_NEXT').attr('hidden', false);

                   $('#step2_active').removeClass('nav-link-success');
                   $('#step3,#step3_active').removeClass('active');
               } else {
                   $('#POST_BTN_CLOSE').attr('hidden', false);
                   $('#BTN_RETURN').attr('hidden', true);
                   $('#BTN_NEXT').data('step', 2);
               }
               $('#step2,#step2_active').removeClass('active');
               $('#step1,#step1_active').addClass('active');
               $('#step1_active').removeClass('nav-link-success');
           } else if (step == 2) {
               $('#POST_BTN_SUBMIT').attr('hidden', true);
               $('#BTN_NEXT').attr('hidden', false);
               $('#BTN_NEXT').data('step', 3);
               $('#BTN_RETURN').data('step', 1);
               $('#step3').removeClass('active');
               $('#step3,#step3_active').removeClass('active');
               $('#step2,#step2_active').addClass('active');
               $('#step2_active').removeClass('nav-link-success');
           }
       }

       function post_submit() {
           var check_step_1_default = $('#POST_TYPE_DEFAULT').val();
           var check_step_1_pdf = $('#POST_TYPE_PDF').val();
           if (check_step_1_default != '') {
               $('#FRM_POST_DEFAULT').submit();
           } else if (check_step_1_pdf != '') {
               $('#FRM_POST_PDF').submit();
           }
       }
       $('#SELECT_TYPE_POST,#SELECT_MONTH_POST').change(function() {
           var month = $('#SELECT_MONTH_POST').val();
           var type = $('#SELECT_TYPE_POST').val();
           url = "{{ route('edit.home') }}?select_month_post=" + month + "&select_type_post=" + type + "";
           console.log(url);
           location.href = url;
       })

       $(document).on('click', '.pagination a', function(event) {
           event.preventDefault();
           var check_page = $(this).attr('href');
           var page = $(this).attr('href').split('page=')[1];
           if (check_page == '#') {
               var page = 1;
           }

           fetch_data(page);
       });

       function fetch_data(page) {
           var url = "{{ route('edit.fetch.post') }}?page=" + page + "";
           var month = $('#SELECT_MONTH_POST').val();
           var type = $('#SELECT_TYPE_POST').val();
           $.ajax({
               url: url,
               type: 'POST',
               data: {
                   select_month_post: month,
                   select_type_post: type,
               },
               success: function(response) {
                   var id_url = "{{ route('edit.home') }}?page=" + page + "";
                   var next_url = "{{ route('edit.home') }}?page=" + response.next_page + "";
                   var previous_url = "{{ route('edit.home') }}?page=" + response.previous_page + "";

                   $('#SHOW_POST').html(response.fetchpost);
                   $('.number_paginate').find('a').removeClass('active');
                   if (page == 1) {
                       $('.number_paginate').find('[href*="#"]').addClass('active');
                   } else {
                       $('.number_paginate').find('[href*="' + id_url + '"]').addClass('active');

                   }
                   $('.next').attr('href', next_url);
                   $('.previous_url').attr('href', previous_url);

               }
           });
       }
   </script>
