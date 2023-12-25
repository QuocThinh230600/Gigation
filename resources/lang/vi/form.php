<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'placeholder'   => 'Vui lòng nhập :attribute',
    'please_choose' => 'Vui lòng chọn',

    'element' => [
        'table_id'       => 'STT',
        'editor_button'  => 'Ẩn - Hiện trình soạn thảo',
        'default'        => 'Mặc định',
        'status'         => 'Trạng thái',
        'featured'       => 'Nổi bật',
        'status_enable'  => 'Hiển thị',
        'status_disable' => 'Ẩn',
        'default_yes'    => 'Có',
        'default_no'     => 'Không',
        'created_at'     => 'Tạo lúc',
        'updated_at'     => 'Sửa lúc',
        'actions'        => 'Hành động',
        'no_data'        => 'Không có dữ liệu',
        'select_all'     => 'Chọn toàn bộ',
        'deselect_all'   => 'Hủy chọn',
        'open_link'      => 'Mở liên kết',
        'access'         => 'Được phép truy cập'
    ],

    'address' => [
        'province'               => 'Tỉnh, thành',
        'district'               => 'Quận, huyện',
        'ward'                   => 'Phường, xã',
        'address'                => 'Địa chỉ',
        'please_choose_province' => 'Vui lòng chọn tỉnh, thành',
        'please_choose_district' => 'Vui lòng chọn quận, huyện',
        'please_choose_ward'     => 'Vui lòng chọn phường, xã',
    ],

    'link' => [
        'self'   => 'Trên cùng 1 trang',
        'blank'  => 'Trên cửa sổ mới',
        'parent' => 'Trên khung cha',
        'top'    => 'Mở trình duyệt mới'
    ],

    'images' => [
        'source'   => 'Hình ảnh',
        'position' => 'Vị trí hình ảnh',
        'alt'      => 'Ghi chú hình ảnh'
    ],

    'status' => [
        'in_process' => 'Đang xử lý',
        'draft'      => 'Bản nháp',
        'pending'    => 'Chờ duyệt',
        'published'  => 'Đã công bố',
        'retired'    => 'Ẩn & có tìm kiếm',
        'close'      => 'Ẩn & không tìm kiếm',
    ],

    'status_contact' => [
        'not_contacted'     => 'Chưa liên lạc',
        'dont_pickup_phone' => 'Không nhấc máy',
        'contacted'         => 'Gọi thành công',
        'sent_mail'         => 'Đã gửi mail',

    ],

    'featured' => [
        'featured'         => 'Nổi bật',
        'most_outstanding' => 'Nổi bật nhất',
        'un_featured'      => 'Không nổi bật',
    ],

    'seo'             => [
        'good'             => 'Tốt',
        'warning'          => 'Cảnh báo',
        'danger'           => 'Nguy hiểm',
        'slug'             => 'Liên kết',
        'title_tag'        => 'Thẻ tiêu đề',
        'meta_keywords'    => 'Thẻ từ khóa',
        'meta_description' => 'Thẻ mô tả',
        'meta_robots'      => 'Thẻ Robots',
        'meta_google_bot'  => 'Thẻ Google Bot',
        'url_tag'          => 'Thẻ liên kết',
        'image_tag'        => 'Thẻ hình ảnh',
        'iframe_tag'       => 'Thẻ iFrame',
        'important_tag'    => 'Nội dung quan trọng',
        'statistical'      => 'Thống kê',
    ],

    /** Navbar */
    'navbar'          => [
        'homepage'      => 'Trang chủ',
        'my_profile'    => 'Trang cá nhân',
        'messages'      => 'Tin nhắn',
        'config_system' => 'Cấu hình hệ thống',
        'logout'        => 'Đăng xuất',
        'support'       => 'Hỗ trợ',
        'module'        => 'Chức năng chính',
        'social'        => 'Mạng xã hội'
    ],

    /** Register Form */
    'register'        => [
        'create_account'          => 'Tạo tài khoản',
        'all_fields_are_required' => 'Tất cả thông tin dưới đây là bắt buộc',
        'email'                   => 'Email',
        'captcha'                 => 'Captcha',
        'password'                => 'Mật khẩu',
        'password_confirm'        => 'Xác nhận mật khẩu',
        'full_name'               => 'Họ và tên',
        'address'                 => 'Địa chỉ',
        'phone'                   => 'Điện thoại',
        'avatar'                  => 'Hình đại diện',
        'status'                  => 'Trạng thái',
        'level'                   => 'Quyền hạn',
        'accept_condition'        => 'Chấp nhận điều khoản',
        'receive_email_register'  => 'Nhận email khi có thông tin mới từ website',
        'accept_terms'            => 'Chấp nhận các điều khoản của dịch vụ trên website của chúng tôi',
        'create_account_button'   => 'Tạo tài khoản',
    ],

    /** Login Form */
    'login'           => [
        'login_to_your_account' => 'Đăng nhập tài khoản của bạn',
        'your_credentials'      => 'Thông tin đăng nhập của bạn',
        'email'                 => 'Email',
        'password'              => 'Mật khẩu',
        'captcha'               => 'Captcha',
        'remember'              => 'Nhớ mật khẩu',
        'forgot_password'       => 'Quên mật khẩu ?',
        'sign_in_button'        => 'Đăng nhập',
        'dont_have_an_account'  => 'Bạn chưa có tài khoản ?',
        'sign_up_button'        => 'Đăng ký',
        'or_sign_in_with'       => 'hoặc đăng nhập với',
        'policy_login'          => 'Để có thể tiếp tục bạn vui lòng xác nhận rằng bạn đã đọc <a href="#" data-toggle="modal" data-target="#modal_scrollable"> Điều khoản &amp; Điều kiện </a> và <a href="#"> Chính sách cookie </a> của Website chúng tôi',
    ],

    /** Forgot Password Form */
    'forgot'          => [
        'password_recovery'           => 'Khôi phục mật khẩu',
        'send_email_password_confirm' => 'Chúng tôi sẽ gửi bạn mail xác nhận tài khoản',
        'reset_password_button'       => 'Đặt lại mật khẩu',
        'change_password'             => 'Thay đổi mật khẩu',
        'we_will_update_pass'         => 'Chúng tôi sẽ cập nhật mật khẩu mới',
        'create_new_password'         => 'Nhập mật khẩu mới',
        'create_new_password_confirm' => 'Nhập lại xác nhận mật khẩu',
        'change_password_button'      => 'Thay đổi mật khẩu',
        'email'                       => 'Email',
        'password'                    => 'Mật khẩu',
        'password_confirm'            => 'Xác nhận mật khẩu',
    ],

    /** Role Module */
    'role'            => [
        'name'              => 'Tên nhóm phân quyền',
        'description'       => 'Mô tả phân quyền',
        'permission_manage' => 'Quản lý nhóm quyền',
        'role'              => 'Phân quyền',
        'name_placeholder'  => 'Vui lòng nhập tên nhóm phân quyền',
        'permission'        => 'Nhóm quyền',
        'all_permission'    => 'Toàn bộ quyền hạn trên website',
    ],

    /** User Module */
    'user'            => [
        'email'            => 'Email',
        'password'         => 'Mật khẩu',
        'password_confirm' => 'Xác nhận mật khẩu',
        'full_name'        => 'Họ và tên',
        'phone'            => 'Số điện thoại',
        'address'          => 'Địa chỉ',
        'level'            => 'Quyền hạn',
        'avatar'           => 'Avatar',
        'permission'       => 'Phân quyền',
        'admin'            => 'Quản trị viên',
        'member'           => 'Thành viên'
    ],

    /** Personal Module */
    'personal'        => [
        'my_profile'           => 'Thông tin của tôi',
        'email'                => 'Email',
        'current_password'     => 'Mật khẩu hiện tại',
        'new_password'         => 'Mật khẩu',
        'new_password_confirm' => 'Xác nhận mật khẩu',
        'full_name'            => 'Họ và tên',
        'phone'                => 'Số điện thoại',
        'address'              => 'Địa chỉ',
        'avatar'               => 'Avatar',
        'login_history'        => 'Lịch sử đăng nhập',
        'save_change'          => 'Lưu thay đổi',
        'login_at'             => 'Đăng nhập lúc',
        'logout_ad'            => 'Đăng xuất lúc',
        'login_ip'             => 'IP',
        'device'               => 'Thiết bị',
        'os'                   => 'Hệ điều hành',
        'browser'              => 'Trình duyệt',
        'logout'               => 'Đăng xuất'
    ],

    /** Language Module */
    'language'        => [
        'name'          => 'Tên ngôn ngữ',
        'locale'        => 'Tên viết tắt',
        'timezone'      => 'Múi giờ',
        'currency'      => 'Tiền tệ',
        'exchange_rate' => 'Tỷ giá',
        'status'        => 'Trạng thái',
        'default'       => 'Mặc định',
        'flag'          => 'Cờ quốc gia',
        'format_date'   => 'Định dạng ngày',
    ],

    /** Page Module */
    'page'            => [
        'code'    => 'Mã trang',
        'name'    => 'Tên trang',
        'content' => 'Nội dung trang',
        'locale'  => 'Ngôn ngữ',
        'update'  => 'Cập nhật'
    ],

    /** Content Module */
    'content'         => [
        'alert'             => 'Ghi chú !',
        'page_content'      => ' Nội dung trang: :page',
        'page_content_code' => ' Nội dung trang: :page với mã số trang: :code',
        'code'              => 'Mã số nội dung',
        'content'           => 'Nội dung trang',
        'locale'            => 'Ngôn ngữ',
        'back'              => 'Quay lại trang: :page'
    ],

    /** Category Module */
    'category'        => [
        'name'        => 'Tên thể loại',
        'description' => 'Mô tả',
        'icon'        => 'Biểu tượng',
        'link'        => 'Đường dẫn truy cập',
        'locale'      => 'Ngôn ngữ',
        'position'    => 'Vị trí thể loại',
        'parent'      => 'Thể loại cha',
        'title'       => 'Tiêu đề',
        'content'     => 'Nội dung'
    ],

    /** News Module */
    'news'            => [
        'category'         => 'Thể loại tin',
        'title'            => 'Tiêu đề',
        'heading'          => 'Thẻ đầu đề',
        'author'           => 'Tác giả',
        'copyright'        => 'Bản quyền nội dụng',
        'intro'            => 'Tóm tắt tin (Sapo)',
        'content'          => 'Nội dung tin',
        'foot'             => 'Kết luận',
        'file'             => 'Tập tin',
        'locale'           => 'Ngôn ngữ',
        'position'         => 'Vị trí',
        'youtube'          => 'Youtube',
        'date_start'       => 'Ngày công bố',
        'time_start'       => 'Thời gian',
        'date_end'         => 'Ngày kết thúc',
        'time_end'         => 'Thời gian',
        'viewed'           => 'Lượt xem',
        'image'            => 'Hình tin',
        'template'         => 'Giao diện hiển thị',
        'detail_page'      => 'Trang chi tiết',
        'e_magazine_page'  => 'Trang E-magazine',
        'table_of_content' => 'Mục lục tin tức',
    ],

    /** Position Module */
    'position'        => [
        'name'     => 'Tên vị trí',
        'position' => 'Thứ tự vị trí',
        'width'    => 'Chiều rộng',
        'height'   => 'Chiều cao',
        'link'     => 'Liên kết',
        'image'    => 'Hình ảnh vị trí',
        'parent'   => 'Vị trí cha',
    ],

    /** Contact Module */
    'contact'         => [
        'full_name'      => 'Họ tên khách',
        'phone'          => 'Điện thoại',
        'email'          => 'Email',
        'message'        => 'Tin nhắn',
        'reply'          => 'Nội dung phản hồi',
        'guest'          => 'Khách',
        'send_1_contact' => 'đã gửi 1 liên hệ đến hệ thống hỗ trợ',
        'admin'          => 'Quản trị viên',
        'page'           => 'Trang liên hệ',
        'status_update'  => 'đã cập nhật trạng thái thành',
        'with_content'   => 'và với nội dung là: ',
        'sent_1_contact' => 'phản hồi',
        'address'       => 'Địa chỉ',
    ],

    /** Position Module */
    'images_position' => [
        'name'           => 'Tên hình ảnh',
        'script_code'    => 'Mã code',
        'image'          => 'Hình ảnh',
        'position'       => 'Thứ tự hình ảnh',
        'video'          => 'Liên kết video',
        'description'    => 'Mô tả',
        'link'           => 'Liên kết hình ảnh',
        'position_image' => 'Vị trí hình ảnh',
        'locale'         => 'Ngôn ngữ',
    ],

    'config' => [
        'website_name'     => 'Tên Website',
        'title'            => 'Tiêu đề (Mặc định)',
        'meta_keywords'    => 'Thẻ từ khóa (Mặc định)',
        'meta_description' => 'Thẻ mô tả (Mặc định)',
        'meta_robots'      => 'Thẻ Robots (Mặc định)',
        'meta_google_bot'  => 'Thẻ Google Bot (Mặc định)',
        'copyright'        => 'Bản quyền',
        'author'           => 'Tác giả',
        'placename'        => 'Tên địa điểm',
        'region'           => 'Khu vực',
        'position'         => 'Vị trí',
        'icbm'             => 'ICBM',
        'revisit_after'    => 'Google Bot quay lại',
        'facebook'         => 'Facebook',
        'youtube'          => 'Youtube',
        'twitter'          => 'Twitter',
        'linkedin'         => 'Linkedin',
        'google_plus'      => 'Google Plus',
        'google_analytics' => 'Google Analytics',
        'google_ads'       => 'Google Ads',
        'facebook_script'  => 'Facebook Script',
        'chat'             => 'Plugin Chat (Facebook, Twakto)',
        'logo'             => 'Logo',
        'favicon'          => 'Favicon',
        'contrast_logo'    => 'Logo tương phản',
        'error_image'      => 'Hình ảnh lỗi',
        'css'              => 'Thay đổi CSS',
        'js'               => 'Thay đổi JS'
    ],

    'log_error' => [
        'log_info'    => 'Thông tin nhật ký',
        'file_path'   => 'Đường dẫn tập tin',
        'log_entries' => 'Số lượng mục',
        'size'        => 'Kích thước file',
        'created_at'  => 'Tạo lúc',
        'env'         => 'Môi trường',
        'level'       => 'Mức độ',
        'time'        => 'Thời gian',
        'header'      => 'Thông tin lỗi',
        'download'    => 'Tải về',
        'delete'      => 'Xóa'
    ],

    'backup' => [
        'type'     => 'Loại lưu trữ',
        'database' => 'Sao lưu dữ liệu Website',
        'source'   => 'Sao lưu mã nguồn Website',
        'all'      => 'Sao lưu toàn bộ Website (Mã nguồn + Dữ liệu)',
        'filename' => 'Tên tập tin',
        'filesize' => 'Dung lượng tập tin',
    ],

    'activity' => [
        'user'        => 'Người dùng',
        'module'      => 'Chức năng',
        'action'      => 'Hành động',
        'description' => 'Mô tả',
        'url'         => 'Đường dẫn',
        'method'      => 'Phương thức',
        'ip'          => 'IP',
        'agent'       => 'Trình duyệt',
    ],

    'dashboard' => [
        'title'  => 'Tiêu đề',
        'viewed' => 'Lượt truy cập'
    ],

    'province' => [
        'gso_id' => 'Mã địa giới',
        'name'   => 'Tên tỉnh, thành phố',
    ],

    'district' => [
        'gso_id' => 'Mã địa giới',
        'name'   => 'Tên quân, huyện',
    ],

    'ward' => [
        'gso_id' => 'Mã địa giới',
        'name'   => 'Tên phường, xã',
    ],

    'producer' => [
        'name'        => 'Tên nhà sản xuất',
        'address'     => 'Địa chỉ',
        'phone'       => 'Số điện thoại',
        'email'       => 'Email',
        'description' => 'Mô tả',
        'image'       => 'Logo công ty',
        'locale'      => 'Ngôn ngữ'
    ],

    'attribute' => [
        'name'        => 'Tên thuộc tính',
        'description' => 'Mô tả thuộc tính',
        'position'    => 'Vị trí',
        'parent'      => 'Thuộc tính cha'
    ],

    'product' => [
        'name'        => 'Tên sản phẩm',
        'price'       => 'Giá sản phẩm',
        'discount'    => 'Giá giảm',
        'title'       => 'Tiêu đề',
        'description' => 'Mô tả sản phẩm',
        'content'     => 'Nội dung sản phẩm',
        'image'       => 'Hình ảnh',
        'youtube'     => 'Youtube',
        'file'        => 'File',
        'date_start'  => 'Ngày công bố',
        'time_start'  => 'Thời gian',
        'date_end'    => 'Ngày kết thúc',
        'time_end'    => 'Thời gian',
        'position'    => 'Vị trí',
        'viewed'      => 'Lượt xem',
        'template'    => 'Giao diện',
        'detail_page' => 'Trang chi tiết sản phẩm',
        'producer_id' => 'Nhà sản xuất',
        'category'    => 'Thể loại',
        'producer'    => 'Nhà sản xuất',
        'value'       => 'Giá trị thuộc tính'
    ],
    'cart'  => [
        'full_name'        => 'Tên',
        'phone'            => 'Sdt',
        'email'            => 'Email',
        'address'          => 'Địa chỉ',
        'note'             => 'Ghi chú',
        'payment_method'   => 'Phương thức',
        'status'           => 'Trạng thái',
        'price'            => 'Tổng đơn hàng'
    ],
    'status_cart'   => [
        'success'           => 'Đã thanh toán',
        'cancel'            => 'Đã hủy',
        'delevery'          => 'Đã vận chuyển',
        'false'             => 'Chưa thanh toán',
        'success_delevery'  => 'Đã giao hàng'
    ],
    'payment_method'    => [
        'cod'          => 'Tiền mặt',
        'tranfes'      => 'Chuyển khoản'
    ],
    'customer' => [
        'image' => 'Hình ảnh',
        'name' => 'Tên khách hàng',
        'open_link' => 'liên kết',
        'content' => ' Nội dung bình luận'
    ],

    'advantages' => [
        'image' => 'Hình ảnh',
        'name' => 'Tên ưu điểm',
        'title' => 'Mô tả trên cùng',
        'content' => ' Mô tả 2',
        'category_id' => 'Thể loại',
        'category' => 'Thể loại',
        'position' => 'Vị trí',
        'subcontent' => 'Mô tả 3',
    ]
];
