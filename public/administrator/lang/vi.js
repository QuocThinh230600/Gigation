window.lang = function () {
    let content = {
        /** Message Toast **/
        success: "Thành công !",
        error: "Thất bại !",
        warning: "Cảnh báo !",
        pages_error: "Trang có lỗi.Vui lòng liên hệ quản trị viên.",
        no_image_remove: 'Không tồn tại hình để có thể xóa',

        /** Console warning **/
        console_stop: '%cDừng lại!',
        console_waring_stop: '%cĐây là một tính năng của trình duyệt dành cho các nhà phát triển. Nếu ai đó bảo bạn sao chép-dán nội dung nào đó vào đây để bật một tính năng của Website hoặc "hack" tài khoản của người khác, thì đó là hành vi lừa đảo và sẽ khiến họ có thể truy cập vào tài khoản Website của bạn.',
        console_access_stop: '%cTruy cập ',
        console_show_info_stop: ' để biết thêm thông tin chi tiết.',
        warning_load_js: 'Cảnh báo -',
        js_not_load: 'thì chưa được nạp.',

        /** Sweet alert after delete **/
        are_you_sure: 'Bạn có chắc chắn muốn làm điều này ?',
        dont_revert: 'Bạn sẽ khổng thể lấy lại dữ liệu!',
        yes_delete_it: 'Vâng, xóa này!',
        no_cancel: 'Không, hủy xóa!',
        deleted: 'Đã xóa thành công',
        canceled: 'Đã hủy',
        data_safe: 'Dữ liệu của bạn vẫn an toàn',

        /** Datatable **/
        datatable_search: '<span>Tìm kiếm:</span> _INPUT_',
        datatable_searchPlaceholder: 'Nhập dữ liệu tìm...',
        datatable_lengthMenu: '<span>Hiển thị:</span> _MENU_',
        datatable_paginate: {
            'first': 'Đầu',
            'last': 'Cuối',
            'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;',
            'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;'
        },
        datatable_info: 'Hiển thị từ _START_ cho đến _END_ trong số _TOTAL_ dòng dữ liệu',
        datatable_zero_records: 'Không tìm kiếm được dữ liệu mong muốn',
        datatable_emptyTable: 'Không có dữ liệu trong bảng',
        datatable_infoEmpty: 'Không có dữ liệu để hiển thị',
        datatable_infoFiltered: '(được lọc trong _MAX_ dòng dữ liệu)',
        datatable_copy: 'Sao chép',
        datatable_print: 'In',
        datatable_col_visibility: 'Cột hiển thị',
        datatable_searchFoot: 'Tìm theo',

        /** Max lenght **/
        you_have: 'Bạn còn lại ',
        of: ' trong số ',
        char_remaining: ' ký tự cho phép.',

        /** Multi Select **/
        select_all: 'Chọn toàn bộ',
        deselect_all: 'Hủy chọn',

        /** Youtube **/
        no_link_youtube: 'Vui lòng mã số youtube',

        /** Address **/
        please_choose_district: 'Vui lòng chọn quận, huyện',
        please_choose_ward: 'Vui lòng chọn phường, xã',
    };

    return {
        translate: function (item) {
            return content[item];
        }
    };
}();