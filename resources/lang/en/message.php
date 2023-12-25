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
        'success' => 'Account registration successful.',
        'fail'    => 'Account registration failed.',
        'sent'    => 'We have sent an activation email to your email. Please check your email',
    ],

    'verify'   => [
        'success' => 'Account verification successful',
        'fail'    => 'Account verification failed',
        'timeout' => 'Account exceeded verification time. Please register again.',
    ],

    'login'    => [
        'success' => 'Logged in successfully.',
        'fail'    => 'Login failed.Please check your login account',
        'check'   => 'You are not logged in or not authorized to enter this area',
    ],

    'logout'   => [
        'success' => 'Logged out successfully.',
        'fail'    => 'Logging out failed.',
    ],

    'forgot'   => [
        'email_exists' => 'The account has been sent a password recovery email.Please check in your mailbox or in spam.If still not, please contact the administrator.',
    ],

    'user'     => [
        'cant_delete' => 'You do not have sufficient permissions to delete this member',
        'cant_edit'   => 'You do not have sufficient permissions to edit this member',
    ],

    'personal' => [
        'current_password' => 'Your current password is incorrect',
        'file_ext_wrong'   => 'Avatar only accept image format.',
    ],

    'category' => [
        'category_not_exist_child' => 'You cannot delete this category because a subcategory exists',
    ],

    'position' => [
        'position_not_exist_child' => 'You cannot delete this location because a subcategory exists',
    ],

    'role'     => [
        'role_have_model' => 'You cannot delete permissions because a user is using them',
    ],
    'backup'   => [
        'backup_file_not_found' => 'No backup file found on the system',
    ],

    'language' => [
        'default_checked'            => 'Other languages ​​are already available as default languages.',
        'no_edit_language_website'   => 'This language is a website language, so it is not allowed to edit',
        'no_delete_language_website' => 'This language is a website language, so it is not allowed to delete',
        'no_delete_language'         => 'This language is the default language and cannot be deleted',
        'update_full_language'       => 'All languages ​​of this data have been updated',
    ],

    'news'     => [
        'no_category' => 'There is currently no display category',
    ],

    'contact'  => [
        'reply' => 'Update customer contact feedback successfully',
    ],

    'seo'      => [
        'meta_title_error'              => 'No title tag content found.',
        'meta_title_warning'            => 'The title tag has :character characters. It requires 50 - 70 characters',
        'meta_title_good'               => 'The title tag has :character characters.',
        'meta_title_no_keyword'         => 'Title tags do not contain keywords.',
        'meta_title_have_keyword'       => 'The title tag contains :keyword keywords.',
        'meta_keyword_error'            => 'No keyword content found',
        'meta_keyword_warning'          => 'Total of :keyword keywords. Optimize 3 - 10 keywords.',
        'meta_keyword_good'             => 'Total :keyword keywords.',
        'meta_description_error'        => 'No description tag content found.',
        'meta_description_warning'      => 'Descriptive card with :character characters. Optimized 160 - 320 characters',
        'meta_description_good'         => 'Description card has :character characters.',
        'meta_description_no_keyword'   => 'Description tag does not contain keywords.',
        'meta_description_have_keyword' => 'Description tag contains :keyword keywords.',
        'content_error'                 => 'No content was found.',
        'content_warning'               => 'Content with :word words. Optimal 500 - 800 words',
        'content_good'                  => 'The content has :word words.',
        'content_no_keyword'            => 'Content does not contain keywords.',
        'content_have_keyword'          => 'The content contains :keyword keywords.',
        'no_image'                      => 'The content of the article should contain 1 image to optimize content',
        'image_no_alt'                  => 'There are :image images that do not contain the alt attribute',
        'image_have_alt'                => 'The images all contain the alt attribute',
        'image_no_title'                => 'There are :image images that do not contain the title attribute',
        'image_have_title'              => 'The images all contain the title attribute',
        'h1_show_two_time'              => 'Only one H1 tag is allowed',
        'h2_no_show'                    => 'Content should have at least 1 H2 tag for good SEO',
        'quantity_internal_link'        => ':quantity internal links',
        'quantity_external_link'        => ':quantity external link.Please replace with internal link',
        'external_nofollow'             => ':quantity external links without using nofollow',
        'no_iframe_tag'                 => 'There are no iFrame tags in the content',
        'have_iframe_tag'               => ':quantity iFrame in the content.',
    ],

    'route'    => [
        'not_found' => 'No content was found',
    ],
    'crud'     => [
        'create_success'        => 'Create :module successfully.',
        'create_fail'           => 'Create :module failed. Please check the data.',
        'edit_success'          => 'Edit :module successfully.',
        'edit_fail'             => 'Edit :module failure. Please check the data.',
        'edit_trans_fail'       => 'Edit :module failure. Please add data for this language.',
        'destroy_success'       => 'Successfully deleted :module.',
        'destroy_fail'          => 'Delete :module failed. Please check the data.',
        'translate_success'     => 'Successfully translated :module.',
        'translate_fail'        => 'Translation :module failed. Please check the data.',
        'destroy_accept'        => 'Are you sure you want to delete the :module function data stream',
        'edit_personal_success' => 'Update personal account successfully',
        'table_no_record'       => 'There is no data in the table.',
    ],

    'ajax'     => [
        'table_category_position' => 'New category location update successful',
    ],
];