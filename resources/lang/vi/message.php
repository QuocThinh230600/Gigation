<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Message Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'register' => [
        'success' => 'Đăng ký tài khoản thành công.',
        'fail'    => 'Đăng ký tài khoản thất bại.',
        'sent'    => 'Chúng tôi đã gửi mail kích hoạt tới email của bạn.Vui lòng kiểm tra email'
    ],

    'verify' => [
        'success' => 'Xác nhận tài khoản thành công',
        'fail'    => 'Xác nhận tài khoản thất bại',
        'timeout' => 'Tài khoản vượt quá thời gian xác minh. Vui lòng đăng ký lại.'
    ],

    'login' => [
        'success' => 'Đăng nhập thành công.',
        'fail'    => 'Đăng nhập thất bại.Vui lòng kiểm tra tài khoản đăng nhập',
        'check'   => 'Bạn chưa đăng nhập hoặc không đủ quyền để vào khu vực này',
    ],

    'logout' => [
        'success' => 'Đăng xuất thành công.',
        'fail'    => 'Đăng xuất thất bại.',
    ],

    'forgot' => [
        'email_exists' => 'Tài khoản đã được gửi mail khôi phục mật khẩu.Vui lòng kiểm tra trong hộp thư hoặc trong spam.Nếu vẫn không có vui lòng liên hệ quản trị viên',
    ],

    'user' => [
        'cant_delete' => 'Bạn không đủ quyền hạn để có thể xóa thành viên này',
        'cant_edit'   => 'Bạn không đủ quyền hạn để có thể sửa thành viên này',
    ],

    'personal' => [
        'current_password' => 'Mật khẩu hiện tại của bạn không chính xác',
        'file_ext_wrong'   => 'Avatar chỉ chấp nhận định dạng hình ảnh.'
    ],

    'category' => [
        'category_not_exist_child' => 'Bạn không thể xóa thể loại này vì tồn tại thể loại con',
    ],

    'position' => [
        'position_not_exist_child' => 'Bạn không thể xóa vị trí này vì tồn tại thể loại con',
    ],

    'role' => [
        'role_have_model' => 'Bạn không thể xóa phân quyền vì có thành viên đang sử dụng',
    ],

    'backup' => [
        'backup_file_not_found' => 'Không tìm thấy tập tin sao lưu dữ liệu trên hệ thống'
    ],

    'language' => [
        'default_checked'            => 'Đã có ngôn ngữ khác làm ngôn ngữ mặc định.',
        'no_edit_language_website'   => 'Ngôn ngữ này đang làm ngôn ngữ website nên không được phép sửa',
        'no_delete_language_website' => 'Ngôn ngữ này đang làm ngôn ngữ website nên không được phép xóa',
        'no_delete_language'         => 'Ngôn ngữ này đang làm ngôn ngữ mặc định nên không được phép xóa',
        'update_full_language'       => 'Tất cả ngôn ngữ của dữ liệu này đã được cập nhật'
    ],

    'news' => [
        'no_category' => 'Hiện tại không có thể loại hiển thị'
    ],

    'product' => [
        'no_category' => 'Hiện tại không có thể loại hiển thị'
    ],

    'contact' => [
        'reply' => 'Cập nhật phản hồi liên hệ khách hàng thành công',
    ],

    'seo' => [
        'meta_title_error'              => 'Không tìm thấy nội dung thẻ tiêu đề.',
        'meta_title_warning'            => 'Thẻ tiêu đề có :character ký tự.Cần tối ưu 50 - 70 ký tự',
        'meta_title_good'               => 'Thẻ tiêu đề có :character ký tự.',
        'meta_title_no_keyword'         => 'Thẻ tiêu đề không chứa từ khóa.',
        'meta_title_have_keyword'       => 'Thẻ tiêu đề có chứa :keyword từ khóa.',
        'meta_keyword_error'            => 'Không tìm thấy nội dung từ khóa',
        'meta_keyword_warning'          => 'Tổng cộng :keyword từ khóa.Cần tối ưu 3 - 10 từ khóa.',
        'meta_keyword_good'             => 'Tổng cộng :keyword từ khóa.',
        'meta_description_error'        => 'Không tìm thấy nội dung thẻ mô tả.',
        'meta_description_warning'      => 'Thẻ mô tả có :character ký tự.Cần tối ưu 160 - 320 ký tự',
        'meta_description_good'         => 'Thẻ mô tả có :character ký tự.',
        'meta_description_no_keyword'   => 'Thẻ mô tả không chứa từ khóa.',
        'meta_description_have_keyword' => 'Thẻ mô tả có chứa :keyword từ khóa.',
        'content_error'                 => 'Không tìm thấy nội dung.',
        'content_warning'               => 'Nội dung có :word từ.Cần tối ưu 500 - 800 từ',
        'content_good'                  => 'Nội dung có :word từ.',
        'content_no_keyword'            => 'Nội dung không chứa từ khóa.',
        'content_have_keyword'          => 'Nội dung có chứa :keyword từ khóa.',
        'no_image'                      => 'Nội dung bài viết nên chứa 1 hình ảnh để tối ưu nội dung',
        'image_no_alt'                  => 'Có :image hình ảnh không chứa thuộc tính alt',
        'image_have_alt'                => 'Các hình ảnh đều chứa thuộc tính alt',
        'image_no_title'                => 'Có :image hình ảnh không chứa thuộc tính title',
        'image_have_title'              => 'Các hình ảnh đều chứa thuộc tính title',
        'h1_show_two_time'              => 'nội dung chỉ được phép có duy nhất một thẻ H1',
        'h2_no_show'                    => 'nội dung nên có ít nhất 1 thẻ H2 để tốt cho SEO',
        'quantity_internal_link'        => ':quantity liên kết nội bộ',
        'quantity_external_link'        => ':quantity liên kết ngoài.Vui lòng thay thế bằng liên kết nội bộ',
        'external_nofollow'             => ':quantity liên kết ngoài mà không sử dụng nofollow',
        'no_iframe_tag'                 => 'Không có thẻ iFrame trong nội dung',
        'have_iframe_tag'               => ':quantity iFrame trong nội dung.',
    ],

    'route' => [
        'not_found' => 'Không tìm thấy nội dung'
    ],

    'crud' => [
        'create_success'        => 'Thêm :module thành công.',
        'create_fail'           => 'Thêm :module thất bại.Vui lòng kiểm tra dữ liệu.',
        'edit_success'          => 'Sửa :module thành công.',
        'edit_fail'             => 'Sửa :module thất bại.Vui lòng kiểm tra dữ liệu.',
        'edit_trans_fail'       => 'Sửa :module thất bại.Vui lòng thêm dữ liệu cho ngôn ngữ này.',
        'destroy_success'       => 'Xóa :module thành công.',
        'destroy_fail'          => 'Xóa :module thất bại.Vui lòng kiểm tra dữ liệu.',
        'translate_success'     => 'Dịch :module thành công.',
        'translate_fail'        => 'Dịch :module thất bại.Vui lòng kiểm tra dữ liệu.',
        'destroy_accept'        => 'Bạn có chắc chắn muốn xóa dòng dữ liệu của chức năng :module',
        'edit_personal_success' => 'Cập nhật tài khoản cá nhân thành công',
        'table_no_record'       => 'Không tồn tại dữ liệu trong bảng.'
    ],

    'ajax' => [
        'table_category_position' => 'Cập nhật vị trí thể loại mới thành công'
    ],
    'pusher' => [
        'register'  => 'Đăng ký nhận thông tin',
        'mesage_register' => 'Có 1 người dùng vừa đăng ký nhận thông tin'
    ]
];
