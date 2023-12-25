/* ------------------------------------------------------------------------------
 *
 *  # Auth JS code
 *  # Author: Quốc Tuấn <contact.quoctuan@gmail.com>
 *  Place here all your auth js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

let AuthJS = function () {

    let _componentUniform = function () {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        $('.form-input-styled').uniform();
    };

    let _componentAcceptCondition = function () {
        $('#agree_conditions').click(function () {
            if ($(this).prop("checked")) {
                let condition_button = $('.continue-condition-button');
                condition_button.removeAttr('disabled');
                condition_button.attr('data-dismiss', 'modal');
            }
        });

        $('.accept-condition-register').click(function () {
            if ($(this).prop("checked")) {
                $('#modal_scrollable').modal();
            }
        });
    };

    let _componentHideMessage = function () {
        $(".alert").delay(4000).slideUp(1000);
    };

    let _componentRefreshCaptcha = function () {
        $(".btn-refresh").click(function(){
            let url = $(this).attr('data-url');
            $.ajax({
                type:'GET',
                url: url,
                success:function(data){
                    $(".captcha span").html(data);
                }
            });
        });

    };

    let _componentRequestAuth = function () {
        $("#formAuth").submit(function (e) {
            e.preventDefault();
            let form = $(this),
                url = form.attr('action'),
                type = form.find('input[name="_method"]').val();

            $.ajax({
                type: type,
                url: url,
                data: form.serialize()
            }).done(function (data) {
                new PNotify({
                    title: lang.translate("success"),
                    text: data.message,
                    icon: 'icon-checkmark3',
                    delay: 2000,
                    type: 'success'
                });

                if (data.redirect !== undefined) {
                    setTimeout(function () {
                        window.location.href = data.redirect
                    }, 2000);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                let data = jqXHR.responseJSON;

                $.ajax({
                    type:'GET',
                    url: $(".btn-refresh").attr('data-url'),
                    success:function(data){
                        $(".captcha span").html(data);
                    }
                });

                switch (jqXHR.status) {
                    case 401:
                        let warning_message = $(".print-warning-msg");

                        warning_message.css('display', 'block');
                        warning_message.find(".message-warning").html(data.message);
                        warning_message.delay(4000).slideUp(1000);

                        if ('redirect' in data) {
                            setTimeout(function () {
                                window.location.href = data.redirect
                            }, 2000);
                        }
                        break;
                    case 422:
                        let error_message = $(".print-error-msg"),
                            error = '';

                        if ($.isEmptyObject(data.errors) === false) {
                            error_message.css('display', 'block');
                            $.each(data.errors, function (key, value) {
                                error += `<li>${value}</li>`;
                            });
                            error_message.find("ul").html(error);
                        }
                        error_message.delay(4000).slideUp(1000);
                        break;
                    default:
                        new PNotify({
                            title: lang.translate("error"),
                            text: lang.translate("pages_error"),
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                        break;
                }
            });
        });
    };

    // Return objects assigned to module
    return {
        init: function () {
            _componentUniform();
            _componentAcceptCondition();
            _componentHideMessage();
            _componentRequestAuth();
            _componentRefreshCaptcha();
        }
    };
}();

// Initialize module
document.addEventListener('DOMContentLoaded', function () {
    AuthJS.init();
});
