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

    'placeholder'   => 'Please enter :attribute',
    'please_choose' => 'Please choose',

    'element' => [
        'table_id'       => 'No.',
        'editor_button'  => 'Hide - Show the editor',
        'default'        => 'Default',
        'status'         => 'Status',
        'featured'       => 'Featured',
        'status_enable'  => 'Display',
        'status_disable' => 'Hide',
        'default_yes'    => 'Yes',
        'default_no'     => 'No',
        'created_at'     => 'Created at',
        'updated_at'     => 'Corrected at',
        'actions'        => 'Act',
        'no_data'        => 'No data',
        'select_all'     => 'Select the whole',
        'deselect_all'   => 'Deselect',
        'open_link'      => 'Open Link',
        'access'         => 'Access is allowed',
    ],

    'address' => [
        'province'               => 'Province',
        'district'               => 'District',
        'ward'                   => 'Ward',
        'address'                => 'Address',
        'please_choose_province' => 'Please choose province',
        'please_choose_district' => 'Please choose district',
        'please_choose_ward'     => 'Please choose ward',
    ],

    'link' => [
        'self'   => 'On the same page',
        'blank'  => 'On the new window',
        'parent' => 'On the parent frame',
        'top'    => 'Open a new browser',
    ],

    'images' => [
        'source'   => 'Picture',
        'position' => 'Image position',
        'alt'      => 'Photo notes',
    ],

    'status' => [
        'in_process' => 'Processing',
        'draft'      => 'Draft',
        'pending'    => 'Pending',
        'published'  => 'Already announced',
        'retired'    => 'Hide & search',
        'close'      => 'Hide & not search',
    ],

    'status_contact' => [
        'not_contacted'     => 'Not contacted',
        'dont_pickup_phone' => 'Do not pick up the phone',
        'contacted'         => 'Call successful',
        'sent_mail'         => 'Sent a mail',
    ],

    'featured' => [
        'featured'         => 'Featured',
        'most_outstanding' => 'Most outstanding',
        'un_featured'      => 'Unfeatured',
    ],

    'seo'             => [
        'good'             => 'Good',
        'warning'          => 'Warning',
        'danger'           => 'Danger',
        'slug'             => 'Link',
        'title_tag'        => 'Title tag',
        'meta_keywords'    => 'Tag tag',
        'meta_description' => 'Description tag',
        'meta_robots'      => 'Robots Tag',
        'meta_google_bot'  => 'Google Bot Tag',
        'url_tag'          => 'Link tag',
        'image_tag'        => 'Image tag',
        'iframe_tag'       => 'IFrame tag',
        'important_tag'    => 'Important content',
        'statistical'      => 'Statistical',
    ],

    /** Navbar */
    'navbar'          => [
        'homepage'      => 'Home page',
        'my_profile'    => 'Personal page',
        'messages'      => 'Message',
        'config_system' => 'System configuration',
        'logout'        => 'Log out',
        'support'       => 'Support',
        'module'        => 'Main function',
        'social'        => 'Social Network',
    ],

    /** Register Form */
    'register'        => [
        'create_account'          => 'Create Account',
        'all_fields_are_required' => 'All information below is required',
        'email'                   => 'Email',
        'captcha'                 => 'Captcha',
        'password'                => 'password',
        'password_confirm'        => 'Confirm password',
        'full_name'               => 'First and last name',
        'address'                 => 'Address',
        'phone'                   => 'Phone',
        'avatar'                  => 'Avatar',
        'status'                  => 'Status',
        'level'                   => 'Power',
        'accept_condition'        => 'Accept terms',
        'receive_email_register'  => 'Receive emails when new information from the website',
        'accept_terms'            => 'Accept the terms of service on our website',
        'create_account_button'   => 'Create Account',
    ],

    /** Login Form */
    'login'           => [
        'login_to_your_account' => 'Log in to your account',
        'your_credentials'      => 'Your login information',
        'email'                 => 'Email',
        'password'              => 'password',
        'captcha'               => 'Captcha',
        'remember'              => 'Remember the password',
        'forgot_password'       => 'Forgot password ?',
        'sign_in_button'        => 'Log in',
        'dont_have_an_account'  => 'Do not have an account ?',
        'sign_up_button'        => 'Registration',
        'or_sign_in_with'       => 'or sign in with',
        'policy_login'          => 'To be able to continue, please confirm that you have read the <a href="#" data-toggle="modal" data-target="#modal_scrollable"> Terms & amp; Conditions </a> and <a href="#"> Cookie Policy </a> of our Website',
    ],

    /** Forgot Password Form */
    'forgot'          => [
        'password_recovery'           => 'Password recovery',
        'send_email_password_confirm' => 'We will send you an email to confirm your account',
        'reset_password_button'       => 'Reset Password',
        'change_password'             => 'Change the password',
        'we_will_update_pass'         => 'We will update the new password',
        'create_new_password'         => 'Enter your new password',
        'create_new_password_confirm' => 'Enter the password confirmation again',
        'change_password_button'      => 'Change the password',
        'email'                       => 'Email',
        'password'                    => 'password',
        'password_confirm'            => 'Confirm password',
    ],

    /** Role Module */
    'role'            => [
        'name'              => 'Role group name',
        'description'       => 'Description',
        'permission_manage' => 'Permission group management',
        'role'              => 'Role',
        'name_placeholder'  => 'Please enter a role group name',
        'permission'        => 'Permission group',
        'all_permission'    => 'All permission on the website',
    ],

    /** User Module */
    'user'            => [
        'email'            => 'Email',
        'password'         => 'Password',
        'password_confirm' => 'Confirm password',
        'full_name'        => 'Fullname',
        'phone'            => 'Phone number',
        'address'          => 'Address',
        'level'            => 'Level',
        'avatar'           => 'Avatar',
        'permission'       => 'Permission',
        'admin'            => 'Administrators',
        'member'           => 'Member',
    ],

    /** Personal Module */
    'personal'        => [
        'my_profile'           => 'My information',
        'email'                => 'Email',
        'current_password'     => 'Current password',
        'new_password'         => 'Password',
        'new_password_confirm' => 'Confirm password',
        'full_name'            => 'First and last name',
        'phone'                => 'Phone number',
        'address'              => 'Address',
        'avatar'               => 'Avatar',
        'login_history'        => 'Login history',
        'save_change'          => 'Save changes',
        'login_at'             => 'Log in at',
        'logout_ad'            => 'Logged out at',
        'login_ip'             => 'IP',
        'device'               => 'Device',
        'os'                   => 'Operating system',
        'browser'              => 'Browser',
        'logout'               => 'Log out',
    ],

    /** Language Module */
    'language'        => [
        'name'          => 'Name of language',
        'locale'        => 'Locale',
        'timezone'      => 'Time zone',
        'currency'      => 'Currency',
        'exchange_rate' => 'Exchange rate',
        'status'        => 'Status',
        'default'       => 'Default',
        'flag'          => 'National flag',
        'format_date'   => 'Date format',
    ],

    /** Page Module */
    'page'            => [
        'code'    => 'Page code',
        'name'    => 'Page name',
        'content' => 'Page content',
        'locale'  => 'Language',
        'update'  => 'Update',
    ],

    /** Content Module */
    'content'         => [
        'alert'             => 'Note !',
        'page_content'      => 'Page content: :page',
        'page_content_code' => 'Page content: :page with page code: :code',
        'code'              => 'Content code',
        'content'           => 'Page content',
        'locale'            => 'Language',
        'back'              => 'Back to page: :page',
    ],

    /** Category Module */
    'category'        => [
        'name'        => 'Category name',
        'description' => 'Description',
        'icon'        => 'Icon',
        'link'        => 'Link category',
        'locale'      => 'Language',
        'position'    => 'Position category',
        'parent'      => 'Parent category',
    ],

    /** News Module */
    'news'            => [
        'category'         => 'Category news',
        'title'            => 'Title',
        'heading'          => 'Heading card',
        'author'           => 'Author',
        'copyright'        => 'Content copyright',
        'intro'            => 'News summary (Sapo)',
        'content'          => 'Content',
        'foot'             => 'Conclude',
        'file'             => 'File',
        'locale'           => 'Language',
        'position'         => 'Position',
        'youtube'          => 'Youtube',
        'date_start'       => 'Date of publication',
        'time_start'       => 'Time',
        'date_end'         => 'End date',
        'time_end'         => 'Time',
        'viewed'           => 'View',
        'image'            => 'Image news',
        'template'         => 'Interface display',
        'detail_page'      => 'Page details',
        'e_magazine_page'  => 'E-magazine page',
        'table_of_content' => 'News table of contents',
    ],

    /** Position Module */
    'position'        => [
        'name'     => 'Name of position',
        'position' => 'Position order',
        'width'    => 'Width',
        'height'   => 'Height',
        'link'     => 'Link',
        'image'    => 'Position image',
        'parent'   => 'Parent position',
    ],

    /** Contact Module */
    'contact'         => [
        'full_name'      => 'Guest name',
        'phone'          => 'Phone',
        'email'          => 'Email',
        'message'        => 'Message',
        'reply'          => 'Feedback content',
        'guest'          => 'Guest',
        'send_1_contact' => 'sent 1 contact to the support system',
        'admin'          => 'Administrators',
        'status_update'  => 'status updated to',
        'with_content'   => 'and with the content as:',
    ],

    /** Position Module */
    'images_position' => [
        'name'           => 'Name of image',
        'script_code'    => 'Code',
        'image'          => 'Picture',
        'position'       => 'Image order',
        'video'          => 'Video link',
        'description'    => 'Description',
        'link'           => 'Image link',
        'position_image' => 'Image position',
        'locale'         => 'Language',
    ],

    'config' => [
        'website_name'     => 'Website Name',
        'title'            => 'Title (Default)',
        'meta_keywords'    => 'Keyword tag (Default)',
        'meta_description' => 'Description card (Default)',
        'meta_robots'      => 'Robots Tag (Default)',
        'meta_google_bot'  => 'Google Bot Tag (Default)',
        'copyright'        => 'License',
        'author'           => 'Author',
        'placename'        => 'Name of the place',
        'region'           => 'Area',
        'position'         => 'Position',
        'icbm'             => 'ICBM',
        'revisit_after'    => 'Google Bot is back',
        'facebook'         => 'Facebook',
        'youtube'          => 'Youtube',
        'twitter'          => 'Twitter',
        'linkedin'         => 'Linkedin',
        'google_plus'      => 'Google Plus',
        'google_analytics' => 'Google Analytics',
        'google_ads'       => 'Google Ads',
        'facebook_script'  => 'Facebook Script',
        'chat'             => 'Chat Plugin (Facebook, Twakto)',
        'logo'             => 'Logo',
        'favicon'          => 'Favicon',
        'contrast_logo'    => 'Logo contrast',
        'error_image'      => 'Error image',
    ],

    'log_error' => [
        'log_info'    => 'Diary information',
        'file_path'   => 'File path',
        'log_entries' => 'Number of items',
        'size'        => 'File size',
        'created_at'  => 'Created at',
        'env'         => 'Environment',
        'level'       => 'Level',
        'time'        => 'Time',
        'header'      => 'Error information',
        'download'    => 'Download',
        'delete'      => 'Erase',
    ],

    'backup' => [
        'type'     => 'Type of backup',
        'database' => 'Website data backup',
        'source'   => 'Backup source Website',
        'all'      => 'Back up the entire Website (Source + Data)',
        'filename' => 'File name',
        'filesize' => 'File size',
    ],

    'activity' => [
        'user'        => 'User',
        'module'      => 'Module',
        'action'      => 'Action',
        'description' => 'Description',
        'url'         => 'URL',
        'method'      => 'Method',
        'ip'          => 'IP',
        'agent'       => 'Browser',
    ],

    'dashboard' => [
        'title'  => 'Title',
        'viewed' => 'Viewed'
    ],

    'province' => [
        'gso_id' => 'GSO ID',
        'name'   => 'Province name',
    ],

    'district' => [
        'gso_id' => 'GSO ID',
        'name'   => 'District name',
    ],

    'ward' => [
        'gso_id' => 'GSO ID',
        'name'   => 'Ward name',
    ],

    'producer' => [
        'name'        => 'Name',
        'address'     => 'Address',
        'phone'       => 'Phone',
        'email'       => 'Email',
        'description' => 'Description',
    ],

    'attribute' => [
        'name'        => 'Name',
        'description' => 'Description',
        'position'    => 'Position',
        'parent'      => 'TParent Attribute'
    ]
];