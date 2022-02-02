 function showmodallogin() {
            $("#modallogin").modal("show");
        }

        function closemodallogin() {
            $("#modallogin").modal('hide');
        }

        function hideandshow(thisdata) {
            var btn_form = $(thisdata).data("id");
            $("#FRM_LOGIN").trigger("reset");
            $("#FRM_REGISTER").trigger("reset");
            $("#FRM_FORGET_PASS").trigger("reset");
            if (btn_form == "BTN_REGISTER") {
                $("#FRM_LOGIN").attr("hidden", true);
                $("#FRM_REGISTER").removeAttr("hidden");
                $("#MODAL_NAME_LOGIN").html("สมัครชื่อบัญชี");
            } else if (btn_form == "BTN_LOGIN") {
                $("#FRM_REGISTER").attr("hidden", true);
                $("#FRM_FORGET_PASS").attr("hidden", true);
                $("#FRM_LOGIN").removeAttr("hidden");
                $("#MODAL_NAME_LOGIN").html("เข้าสู่ระบบ / Login");
            } else if (btn_form == "BTN_FORGET") {
                $("#FRM_LOGIN").attr("hidden", true);
                $("#FRM_FORGET_PASS").removeAttr("hidden");
                $("#MODAL_NAME_LOGIN").html("ลืมรหัสผ่าน");
            }
        }
