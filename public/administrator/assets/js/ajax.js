/* ------------------------------------------------------------------------------
 *
 *  # AjaxJS code
 *  # Author: Quốc Tuấn <contact.quoctuan@gmail.com>
 *  Place here all your ajax js. Make sure it's loaded after statistical.js
 *
 * ---------------------------------------------------------------------------- */

let AjaxJS = function () {

    let _componentCheckUndefined = function (file) {
        if (domainPath === "http://localhost:8000" || domainPath === "http://127.0.0.1:8000") {
            console.warn(lang.translate('warning_load_js') + ' ' + file + '.js ' + lang.translate('js_not_load'));
        }
    };

    let _componentLogout = function () {
        $("a#logout").click(function (e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                type: "GET",
                url: url,
            }).done(function (data) {
                window.location.href = data.redirect
            });
        });
    };

    let _componentRequest = function () {
        $(".formAjax").submit(function (e) {
            e.preventDefault();
            let form = $(this),
                url = form.attr('action'),
                type = form.attr('method'),
                method = form.find('input[name="_method"]').val();

            if (typeof CKEDITOR !== 'undefined') {
                for (let instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            }

            let formData = new FormData(this)
            formData.append('_method', method);

            $.ajax({
                type: type,
                url: url,
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (data) {
                let swalInit = swal.mixin({
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-light'
                });

                if (data.status === "success") {
                    swalInit.fire({
                        title: lang.translate("success"),
                        text: data.message,
                        type: 'success',
                        showCloseButton: true,
                        onClose: function () {
                            if (data.redirect !== undefined) {
                                window.location.href = data.redirect
                            }
                        }
                    });
                } else {
                    swalInit.fire(
                        lang.translate("error"),
                        data.message,
                        'warning'
                    );
                }
            }).fail(function (jqXHR) {
                let data = jqXHR.responseJSON;

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

    let _componentDatatableAdvanced = function () {
        if (!$().DataTable) {
            _componentCheckUndefined('datatables.min');
            return;
        }

        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            scroll: true,
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

        let table = $('.datatable-colvis-basic');

        let columns = [];

        table.find("tfoot th").each(function () {
            if ($(this).attr('data') !== undefined) {
                let object = {
                    data: $(this).attr('data'),
                    name: $(this).attr('name'),
                    orderable: $(this).attr('orderable') === undefined,
                    searchable: $(this).attr('searchable') === undefined
                };
                columns.push(object);
            }
        });

        let tableData = table.DataTable({
            processing: true,
            serverSide: true,
            ajax: table.attr('url'),
            columns: columns,
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

        $('.datatable-colvis-basic tfoot th').each(function () {
            if ($(this).attr('type') === 'text') {
                let title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="' + lang.translate("datatable_searchFoot") + ' ' + title.toLowerCase() + '" />');
            }
        });

        // Apply the search
        tableData.columns().every(function () {
            let that = this;
            $('input', this.footer()).keypress(function (e) {
                if (e.which === 13) {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                }
            });

            $('select', this.footer()).change(function (e) {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    };

    let _componentSelect2 = function () {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });

        // Enable Select2 select for individual column searching
        $('.filter-select').select2();
    };

    let _componentAjaxSelect = function () {
        $("select.parent_position").change(function () {
            let id = $(this).val(),
                url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                data: { id: id },
                success: function (position) {
                    $("input[name='position']").val(position);
                }
            });
        })
    };

    let _componentUpdatePosition = function () {
        $("input[name='position']").change(function (event) {
            var position = $(this).val(),
                id = $(this).data('id'),
                url = $(this).parents().eq(3).data('url');

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: { id: id, position: position },
                success: function (result) {
                    new PNotify({
                        title: lang.translate("success"),
                        text: result.message,
                        icon: 'icon-checkmark3',
                        delay: 2000,
                        type: 'success'
                    });

                    if (result.status === "success") {
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }

                }
            });
        });
    };

    let _componentSweetAlert = function () {
        if (typeof swal == 'undefined') {
            _componentCheckUndefined('sweet_alert.min');
            return;
        }

        let swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        $(document).on('click', '.accept_delete', function (event) {
            event.preventDefault();
            let $button = $(this),
                link = $(this).attr('href'),
                dataTable = $('.datatable-colvis-basic');

            if (dataTable.length) {
                var table = dataTable.DataTable();
            }
            swalInit.fire({
                title: lang.translate("are_you_sure"),
                text: lang.translate("dont_revert"),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: lang.translate("yes_delete_it"),
                cancelButtonText: lang.translate("no_cancel"),
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: link,
                        dataType: "json",
                        success: function (result) {
                            if (result.status === "success") {
                                if (dataTable.length) {
                                    table.row($button.parents('tr')).remove().draw();
                                } else {
                                    $button.parents('tr').remove()
                                }

                                swalInit.fire(
                                    lang.translate("deleted"),
                                    result.message,
                                    'success'
                                );

                                if ('redirect' in result) {
                                    setTimeout(function () {
                                        window.location.href = result.redirect
                                    }, 2000);
                                }
                            } else {
                                swalInit.fire(
                                    lang.translate("error"),
                                    result.message,
                                    'warning'
                                );
                            }
                        }
                    });
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swalInit.fire(
                        lang.translate("canceled"),
                        lang.translate("data_safe"),
                        'error'
                    );
                }
            });
        });
    };

    let _componentMultiUploadImage = function () {
        $("#add-row-upload").click(function () {
            let url = $(this).data('url'),
                id,
                position,
                $position_row = $('.module-upload-multi-image .position_multi_images'),
                $id_row = $('.module-upload-multi-image .row-upload-multi');

            if ($position_row.last().val() === undefined) {
                position = 1;
            } else {
                position = parseInt($position_row.last().val()) + 1;
            }

            if ($id_row.last().data('id') === undefined) {
                id = 1;
            } else {
                id = parseInt($id_row.last().data('id')) + 1;
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: { id: id, position: position },
                success: function (result) {
                    $("#load-row-upload-image").append(result.view);
                }
            });
        });

        $(document).on('click', '.delete-row-upload', function () {
            let id = $(this).data('id');
            $("#" + id).remove();
        });
    };

    let _componentMultiUploadAttribute = function () {
        $("#add-row-upload-attribute").click(function () {
            let url = $(this).data('url'),
                id,
                $id_row = $('.module-upload-multi-attribute .row-upload-multi');

            if ($id_row.last().data('id') === undefined) {
                id = 1;
            } else {
                id = parseInt($id_row.last().data('id')) + 1;
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function (result) {
                    $("#load-row-upload-attribute").append(result.view);
                }
            });
        });

        $(document).on('click', '.delete-row-upload', function () {
            let id = $(this).data('id');
            $("#" + id).remove();
        });
    };

    let _componentDistrictSelect = function () {
        $('select[name="province_id"]').on('select2:select', function (e) {
            let id = e.params.data.id,
                url = $("select[name='district_id']").data('url');


            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function (result) {
                    var xhtml = '';
                    for (var key in result) {
                        xhtml += '<option value="' + result[key].id + '">' + result[key].name + '</option>';
                    }
                    $("select[name='district_id']").html(xhtml);
                }
            });
        });
    };

    let _componentAddress = function () {
        $('select[name="province_id"]').on('select2:select', function (e) {
            let province_id = e.params.data.id,
                $district = $("select[name='district_id']"),
                url = $district.data('url');

            if (province_id.length === 0) {
                $district.html('<option value="">' + lang.translate('please_choose_district') + '</option>');
            } else {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'html',
                    data: { province_id: province_id },
                    success: function (result) {
                        $district.html(result);
                    }
                });
            }
            $("select[name='ward_id']").html('<option value="">' + lang.translate('please_choose_ward') + '</option>');
        });

        $('select[name="district_id"]').on('select2:select', function (e) {
            let district_id = e.params.data.id,
                $ward = $("select[name='ward_id']"),
                url = $ward.data('url');

            if (district_id.length === 0) {
                $ward.html('<option value="">' + lang.translate('please_choose_ward') + '</option>');
            } else {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'html',
                    data: { district_id: district_id },
                    success: function (result) {
                        $ward.html(result);
                    }
                });
            }
        });
    };

    let _componentNotification = function () {

        let pusher_key = $('input[name="pusher_key_hidden"]').val(),
            pusher = new Pusher(pusher_key, {
                encrypted: true,
                cluster: "ap1"
            }),
            url = $('input[name="pusher_key_hidden"]').data('url'),
            count = $('.notification_count').text(),
            channel = pusher.subscribe('NotificationEvent');

        channel.bind('send-message', function (data) {
            $.ajax({
                url: url,
                method: "POST",
                data: { data: data },
                success: function (result) {
                    $('.media-list').prepend(result);
                    $('.notification_count').text(parseInt(count) + 1);
                }
            })
        });
    }

    let _componentMakeAsRead = function(){
        $('.unread').click(function(){
            let url = $('.media-list').data('url'),
                id = $(this).data('id');
            $.ajax({
                url: url,
                method: "POST",
                data: {id : id},
                success: function(data){

                }
            })
        })
    }
    return {
        init: function () {
            _componentCheckUndefined();
            _componentLogout();
            _componentRequest();
            _componentDatatableAdvanced();
            _componentSelect2();
            _componentSweetAlert();
            _componentAjaxSelect();
            _componentUpdatePosition();
            _componentMultiUploadImage();
            _componentDistrictSelect();
            _componentAddress();
            _componentMultiUploadAttribute();
            _componentNotification();
            _componentMakeAsRead();
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

    AjaxJS.init();
});
