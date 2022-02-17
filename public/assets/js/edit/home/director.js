       function director() {
            let DIRECTOR_TEXT = $('#DIRECTOR_TEXT').text().replace(/(\r\n|\n|\r)/g, '');
            var DIRECTOR_NAME = $.trim($('#DIRECTOR_NAME').text());
            var DIRECTOR_SCHOOL = $.trim($('#DIRECTOR_SCHOOL').text());
            $('#POST_TEXT').val(DIRECTOR_TEXT);
            $('#POST_NAME').val(DIRECTOR_NAME);
            $('#POST_SCHOOL').val(DIRECTOR_SCHOOL);
            $('#modal_director').modal('show');
        }

        function submit_director() {
            $('#FRM_DIRECTOR').submit();
        }
