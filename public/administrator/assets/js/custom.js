/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *  # Author: Quốc Tuấn <contact.quoctuan@gmail.com>
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

let CustomJS = function () {
    let _componentCheckUndefined = function (file) {
        if (domainPath === "http://localhost:8000" || domainPath === "http://127.0.0.1:8000") {
            console.warn(lang.translate('warning_load_js') + ' ' + file + '.js ' + lang.translate('js_not_load'));
        }
    };

    let _componentFancybox = function () {
        if (!$().fancybox) {
            _componentCheckUndefined('fancybox.min');
            return;
        }

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    };

    let _componentDragula = function () {
        if (typeof dragula == 'undefined') {
            _componentCheckUndefined('dragula.min');
            return;
        }

        dragula([document.getElementById('cards-target-left'), document.getElementById('cards-target-right')]);

        dragula([document.getElementById('forms-target-left'), document.getElementById('forms-target-right')]);
    };

    let _componentCheckPermission = function () {
        if (!$().uniform) {
            _componentCheckUndefined('uniform.min');
            return;
        }

        $('.form-check-input-styled').uniform();

        $(document).on('change', '.permission', function () {
            $(this).closest('li').find('li .permission').prop('checked', $(this).is(':checked'));

            let sibs = false;

            $(this).closest('ul').children('li').each(function () {
                if ($('.permission', this).is(':checked')) sibs = true;
            });

            $(this).parents('ul').prev().prop('checked', sibs);

            $.uniform.update('.permission');
        });

        $(document).on('change', 'input[name="check-all-permission"]', function () {
            let checked = $(this).prop('checked'),
                $permission = $('.permission');

            if (checked) {
                $permission.prop('checked', true);
            } else {
                $permission.prop('checked', false);
            }

            $.uniform.update('.permission');
        });
    };

    let _componentCKEditor = function () {
        if (typeof CKEDITOR === 'undefined') {
            _componentCheckUndefined('ckeditor');
            return;
        }

        $('.remove-editor').click(function () {
            let name_editor = $(this).attr("name");
            if ($(this).attr("visible-ckeditor") === 'show') {
                CKEDITOR.instances[name_editor].destroy(false);
                $(this).attr("visible-ckeditor", "hide")
            } else {
                CKEDITOR.replace(name_editor);
                $(this).attr("visible-ckeditor", "show")
            }
        });

        CKEDITOR.config.customConfig = 'config.js';
    };

    let _componentCkFinder = function () {
        if (typeof CKFinder == 'undefined') {
            _componentCheckUndefined('cKfinder');
            return;
        }

        $(document).on('click', '.upload-image', function (event) {
            event.preventDefault();
            let eleImg = $(this).attr('id');
            selectImageWithCKFinder(eleImg);
        });

        $(document).on('click', '.upload-file', function (event) {
            event.preventDefault();
            let eleFile = $(this).attr('id');
            selectFileWithCKFinder(eleFile);
        });

        $(document).on('click', '.upload-multi-image', function (event) {
            event.preventDefault();
            let eleFile = $(this).data('id');
            selectFileToUploadMultiWithCKFinder(eleFile);
        });

        let selectImageWithCKFinder = function (inputId) {
            CKFinder.modal({
                chooseFiles: true,
                width: 900,
                height: 400,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        let file = evt.data.files.first(),
                            fileUrl = file.getUrl(),
                            ajaxTag = $("input#ajax_" + inputId);

                        $("input#" + inputId).val(fileUrl);
                        $("img#" + inputId).attr("src", fileUrl);
                        $("#preview-" + inputId).attr("href", fileUrl);

                        if (ajaxTag.length) {
                            let link = ajaxTag.val();
                            $.ajax({
                                type: "PUT",
                                url: link,
                                data: {avatar: fileUrl},
                                dataType: "json",
                                success: function (result) {
                                    if (result.status === "success") {
                                        new PNotify({
                                            title: lang.translate("success"),
                                            text: result.message,
                                            icon: 'icon-checkmark3',
                                            delay: 3000,
                                            type: 'success'
                                        });

                                        setTimeout(function () {
                                            window.location.href = result.redirect
                                        }, 3000);
                                    } else {
                                        new PNotify({
                                            title: lang.translate("error"),
                                            text: result.message,
                                            icon: 'icon-blocked',
                                            delay: 3000,
                                            type: 'error'
                                        });

                                        setTimeout(function () {
                                            window.location.href = result.redirect
                                        }, 3000);
                                    }
                                }
                            })
                        }

                    });

                    finder.on('file:choose:resizedImage', function (evt) {
                        let resizedUrl = evt.data.resizedUrl;

                        $("input#" + inputId).val(resizedUrl);
                        $("img#" + inputId).attr("src", resizedUrl);
                        $("#preview-" + inputId).attr("href", resizedUrl);
                    });
                }
            });
        };

        let selectFileWithCKFinder = function (inputId) {
            CKFinder.modal({
                chooseFiles: true,
                width: 900,
                height: 400,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        let file = evt.data.files.first(),
                            fileUrl = file.getUrl();

                        $("input[name='" + inputId + "']").val(fileUrl);
                    });
                }
            });
        };

        let selectFileToUploadMultiWithCKFinder = function (inputId) {
            CKFinder.modal({
                chooseFiles: true,
                width: 900,
                height: 400,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        let file = evt.data.files.first(),
                            fileUrl = file.getUrl();

                        $("input#" + inputId).val(fileUrl);
                        $("img#" + inputId).attr("src", fileUrl);
                        $("a#" + inputId).attr("href", fileUrl);
                    });
                }
            });
        };

        $(document).on('click', '.remove-image', function (event) {
            event.preventDefault();
            let image_original = domainPath + '/administrator/global_assets/images/placeholders/placeholder.jpg',
                val = $(this).prev().val();

            if (val === "") {
                new PNotify({
                    title: lang.translate("error"),
                    text: lang.translate("no_image_remove"),
                    icon: 'icon-blocked',
                    type: 'error'
                });

            } else {
                $(this).prev().val("");
                $(this).closest('.card').find('img').attr("src", image_original);
            }
        });
    };

    let _componentBootstrapSwitch = function () {
        if (!$().bootstrapSwitch) {
            _componentCheckUndefined('switch.min');
            return;
        }

        // Initialize
        $('.form-check-input-switch').bootstrapSwitch();
    };

    let _componentMaxlength = function () {
        if (!$().maxlength) {
            _componentCheckUndefined('maxlength.min');
            return;
        }

        // Options
        $('.maxlength-options').maxlength({
            alwaysShow: true,
            threshold: 10,
            warningClass: 'badge badge-success form-text',
            limitReachedClass: 'badge badge-danger form-text',
            separator: lang.translate("off"),
            preText: lang.translate("you_have"),
            postText: lang.translate("char_remaining"),
            validate: true
        });
    };

    let _componentConvertTitle = function () {
        $('.title').keyup(function () {
            let title = $(this).val(),
                title_tag = $(this).attr('title');
            $("#" + title_tag).val(title);
        })
    };

    let _componentConvertSlug = function () {
        $('.title').keyup(function () {
            let title = $(this).val(),
                slug = $(this).attr('slug');

            title = title.replace(/^\s+|\s+$/g, '')
                .toLowerCase()
                .replace(/[áàảạãăắằẳẵặâấầẩẫậ]/gi, 'a')
                .replace(/[éèẻẽẹêếềểễệ]/gi, 'e')
                .replace(/[iíìỉĩị]/gi, 'i')
                .replace(/[óòỏõọôốồổỗộơớờởỡợ]/gi, 'o')
                .replace(/[úùủũụưứừửữự]/gi, 'u')
                .replace(/[ýỳỷỹỵ]/gi, 'y')
                .replace(/đ/gi, 'd')
                .replace(/[`~!@#|$%^&*()+=,.\/?><'":;_]/gi, '')
                .replace(/&/g, '-va-')
                .replace(/[^\w\-]+/g, '-')
                .replace(/\s+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
            $("#" + slug).val(title);
        });
    };

    let _componentLoadWarningConsole = function () {
        console.log(lang.translate("console_stop"), 'color: red; font-size: 50px; font-family: Arial; text-shadow: 1px 1px 5px #000;');
        console.log(lang.translate("console_waring_stop"), 'color: #BEC6CF; font-size: 25px; font-family: Arial;');
        console.log(lang.translate("console_access_stop") + domainPath + lang.translate("console_show_info_stop"), 'color: #BEC6CF; font-size: 25px; font-family: Arial');
    };

    let _componentMultiselect = function () {
        if (!$().multiselect) {
            _componentCheckUndefined('bootstrap-multiselect');
            return;
        }

        function multiselect_selected($el) {
            let ret = true;
            $('option', $el).each(function (element) {
                if (!$(this).prop('selected')) {
                    ret = false;
                }
            });
            return ret;
        }

        function multiselect_selectAll($el) {
            $('option', $el).each(function (element) {
                $el.multiselect('select', $(this).val());
            });
        }

        function multiselect_deselectAll($el) {
            $('option', $el).each(function (element) {
                $el.multiselect('deselect', $(this).val());
            });
        }

        function multiselect_toggle($el, $btn) {
            if (multiselect_selected($el)) {
                multiselect_deselectAll($el);
                $btn.text(lang.translate("select_all"));
            } else {
                multiselect_selectAll($el);
                $btn.text(lang.translate("deselect_all"));
            }
        }

        // Initialize
        $('.multiselect-toggle-selection').multiselect();

        // Toggle selection on button click
        $('.multiselect-toggle-selection-button').on('click', function (e) {
            e.preventDefault();
            let name = $(this).attr('name');
            multiselect_toggle($('select[name="' + name + '"]'), $(this));
        });
    };

    // Select2 examples
    let _componentSelect2 = function () {
        if (!$().select2) {
            _componentCheckUndefined('select2.min');
            return;
        }

        // Format icon
        function iconFormat(icon) {
            let originalOption = icon.element;
            if (!icon.id) {
                return icon.text;
            }
            return '<img width="25" height="12" class="pr-1" src="' + $(icon.element).data('icon') + '" /> ' + icon.text;
        }

        // Initialize with options
        $('.select-icons').select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            escapeMarkup: function (m) {
                return m;
            }
        });
    };

    let _componentTokenfield = function () {
        if (!$().tokenfield) {
            _componentCheckUndefined('tokenfield.min');
            return;
        }

        // Basic initialization
        $('.tokenfield').tokenfield();
    };

    let _componentLoadRole = function () {
        if (!$().select2) {
            _componentCheckUndefined('select2.min');
            return;
        }

        $level = $("select[name='level']");
        $level.select2();

        if ($level.val() === "1") {
            $("#user_role").show();
        } else {
            $("#user_role").hide();
        }

        $level.on('select2:selecting', function (e) {
            if (e.params.args.data.id === "1") {
                $("#user_role").show();
            } else {
                $("#user_role").hide();
            }
        });

    };

    let _componentLock = function () {
        function startTime() {
            let today = new Date(),
                d = today.getDate(),
                i = today.getMonth() + 1,
                y = today.getFullYear(),
                h = today.getHours(),
                m = today.getMinutes(),
                s = today.getSeconds();

            m = checkTime(m);
            s = checkTime(s);
            $(".show_clock").html(d + "/" + month2digits(i) + "/" + y + " - " + h + ":" + m + ":" + s);
            setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            return i;
        }

        function month2digits(month) {
            return (month < 10 ? '0' : '') + month;
        }

        startTime();
    };

    let _componentYoutube = function () {
        $("#show-youtube").click(function () {
            let video_youtube = $(".video-youtube"),
                link_youtube = $("#link-youtube"),
                link_youtube_val = link_youtube.val(),
                source = 'https://img.youtube.com/vi/' + link_youtube_val + '/sddefault.jpg';

            if (link_youtube_val === '') {
                new PNotify({
                    title: lang.translate("error"),
                    text: lang.translate("no_link_youtube"),
                    icon: 'icon-blocked',
                    type: 'error'
                });
            } else {
                video_youtube.html('<img src="' + source + '" class="mb-3 w-100" />');
                $("input[name='youtube_image']").val(source);

                video_youtube.click(function () {

                    let video = 'https://www.youtube.com/embed/' + link_youtube_val + '?rel=0&showinfo=0&autoplay=1';
                    video_youtube.html('<iframe frameborder="0" allowfullscreen="" width="100%" src="' + video + '" />');
                });
            }
        });

        $("#clear-youtube").click(function () {
            $("#link-youtube").val('');
            $(".video-youtube").html('');
            $("input[name='youtube_image']").val('');
        });
    };

    let _componentPickadate = function () {
        if (!$().pickadate) {
            _componentCheckUndefined('picker.js and/or picker.date.');
            return;
        }

        let date_start = $('#date_start'),
            date_end = $('#date_end');

        if (date_end.val() !== '') {
            date_start.pickadate({
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy-mm-dd',
                min: date_start.val(),
                max: date_end.val()
            });
        } else {
            date_start.pickadate({
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy-mm-dd',
                min: date_start.val()
            });
        }

        date_end.pickadate({
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            min: date_start.val(),
        });

        function parseDate(date) {
            let parts = date.split("/");
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }

        $('.datepicker').on('change', function () {
            if ($(this).attr('id') === 'date_start') {
                date_end.pickadate('picker').set('min', $(this).val());
                if (parseDate(date_start.val()) > parseDate(date_end.val())) {
                    date_end.val($(this).val());
                    $('input[name="date_end_submit"]').val($(this).val().split("/").reverse().join("-"));
                }
            }

            if ($(this).attr('id') === 'date_end') {
                $('#date_start').pickadate('picker').set('max', $(this).val());
            }
        });

        $("#date_start,#date_end").change(function () {
            var option = "",
                hours = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
                mins = ["00", "15", "30", "45"];
            date = new Date(),
                dd = String(date.getDate()).padStart(2, '0'),
                mm = String(date.getMonth() + 1).padStart(2, '0'),
                yyyy = date.getFullYear(),
                hh = date.getHours(),
                ii = date.getMinutes(),
                today = dd + '/' + mm + '/' + yyyy;

            if (date_start.val() === today) {
                if (ii >= 0 && ii <= 15) {
                    ii = 15;
                } else if (ii >= 16 && ii <= 30) {
                    ii = 30;
                } else if (ii >= 31 && ii <= 45) {
                    ii = 45;
                } else {
                    hh += 1;
                    ii = '00';
                }

                var position_hours_start = hours.indexOf(String(hh)),
                    position_min_start = mins.indexOf(String(ii)),
                    hours_start = hours.splice(position_hours_start, hours.length + 1),
                    mins_start = mins.splice(position_min_start, hours.length + 1);

                hours_start.forEach(function (hour) {
                    mins_start.forEach(function (min) {
                        option += '<option value="' + hour + ':' + min + '">' + hour + ':' + min + '</option>';
                    });
                });

                $("select[name='time_start']").html(option);
            } else {
                hours.forEach(function (hour) {
                    mins.forEach(function (min) {
                        option += '<option value="' + hour + ':' + min + '">' + hour + ':' + min + '</option>';
                    });
                });

                $("select[name='time_start']").html(option);
            }
        });

        $("#date_start,#date_end,select[name='time_start']").change(function () {
            var option = "",
                hours = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
                mins = ["00", "15", "30", "45"];

            if (date_start.val() === date_end.val()) {
                var array_time = $("select[name='time_start']").val().split(':'),
                    position_hours_start = hours.indexOf(array_time[0]),
                    position_min_start = mins.indexOf(array_time[1]),
                    hours = hours.splice(position_hours_start, hours.length + 1),
                    mins = mins.splice(position_min_start, mins.length + 1);

                hours.forEach(function (hour) {
                    mins.forEach(function (min) {
                        option += '<option value="' + hour + ':' + min + '">' + hour + ':' + min + '</option>';
                    });
                });

                $("select[name='time_end']").html(option);
            } else {
                hours.forEach(function (hour) {
                    mins.forEach(function (min) {
                        option += '<option value="' + hour + ':' + min + '">' + hour + ':' + min + '</option>';
                    });
                });

                $("select[name='time_end']").html(option);
            }
        })
    };

    let _componentChartData = function () {
        if (typeof Chart == 'undefined') {
            _componentCheckUndefined('chart.js.');
            return;
        }

        $(function() {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: JSON.parse($(".data-chart").text()),
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    }

    let _componentDataTable = function () {
        if (!$().DataTable) {
            _componentCheckUndefined('datatables.min');
            return;
        }

        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: lang.translate("datatable_search"),
                searchPlaceholder: lang.translate("datatable_searchPlaceholder"),
                lengthMenu: lang.translate("datatable_lengthMenu"),
                paginate: lang.translate("datatable_paginate"),
                zeroRecords: lang.translate("datatable_zero_records"),
                info: lang.translate("datatable_info"),
                emptyTable: lang.translate("datatable_emptyTable"),
                infoEmpty: lang.translate("datatable_infoEmpty"),
                infoFiltered: lang.translate("datatable_infoFiltered"),
            }
        });

        $('.datatable-basic').DataTable({
            scrollX: true,
            processing: true,
            buttons: {
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn btn-light',
                        text: lang.translate("datatable_copy"),
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-light',
                        text: lang.translate("datatable_print"),
                    },
                    {
                        extend: 'colvis',
                        className: 'btn btn-light dropdown-toggle',
                        text: lang.translate("datatable_col_visibility"),
                    }
                ]
            }
        });
    }

    var _componentUiDatepicker = function() {
        if (!$().datepicker) {
            console.warn('Warning - jQuery UI components are not loaded.');
            return;
        }

        // Initialize
        $('.form-control-datepicker').datepicker();
    };

    var _componentAce = function() {
        if (typeof ace == 'undefined') {
            console.warn('Warning - ace.js is not loaded.');
            return;
        }

        // Javascript editor
        var js_editor = ace.edit('javascript_editor');
            js_editor.setTheme('ace/theme/monokai');
            js_editor.getSession().setMode('ace/mode/javascript');
            js_editor.setShowPrintMargin(false);
        // CSS editor
        var css_editor = ace.edit('css_editor');
            css_editor.setTheme('ace/theme/monokai');
            css_editor.getSession().setMode('ace/mode/css');
            css_editor.setShowPrintMargin(false);

            var css = $('input[name="css"]'),
                js  = $('input[name="js"]');
            css_editor.getSession().on("change", function () {
                css.val(css_editor.getSession().getValue());
            });
            js_editor.getSession().on("change", function () {
                js.val(js_editor.getSession().getValue());
            });
    };

    return {
        init: function () {
            _componentCheckPermission();
            _componentCKEditor();
            _componentBootstrapSwitch();
            _componentFancybox();
            _componentDragula();
            _componentMaxlength();
            _componentConvertTitle();
            _componentConvertSlug();
            _componentLoadWarningConsole();
            _componentSelect2();
            _componentTokenfield();
            _componentMultiselect();
            _componentCkFinder();
            _componentLock();
            _componentLoadRole();
            _componentYoutube();
            _componentPickadate();
            _componentChartData();
            _componentDataTable();
            _componentUiDatepicker();
            _componentAce();
        }
    };
}();

// Initialize module
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    CustomJS.init();
});

