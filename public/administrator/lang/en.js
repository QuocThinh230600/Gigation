window.lang = function () {
    let content = {
        /** Message Toast **/
        success: "Success !",
        error: "Error !",
        warning: "Warning !",
        pages_error: "The page has an error. Please contact the administrator.",
        no_image_remove: 'No picture exists to delete',

        /** Console warning **/
        console_stop: '%cStop!',
        console_waring_stop: '%cThis is a browser feature for developers. If someone tells you to copy-paste something here to turn on a Website feature or "hack" someone else\'s account, then it is a scam and will make them able to access the account. Your website.',
        console_access_stop: '%cAccess ',
        console_show_info_stop: ' for more details.',
        warning_load_js: 'Warning -',
        js_not_load: 'has not been loaded',

        /** Sweet alert after delete **/
        are_you_sure: 'Are you sure you want to do this?\n',
        dont_revert: 'You will not be able to retrieve the data!',
        yes_delete_it: 'Yes, delete this!',
        no_cancel: 'No, cancel delete!',
        deleted: 'Successfully deleted',
        canceled: 'Canceled',
        data_safe: 'Your data is still safe',

        /** Datatable **/
        datatable_search: '<span>Search:</span> _INPUT_',
        datatable_searchPlaceholder: 'Enter search data ...',
        datatable_lengthMenu: '<span>Show:</span> _MENU_',
        datatable_paginate: {
            'first': 'Frist',
            'last': 'Last',
            'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;',
            'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;'
        },
        datatable_info: 'Showing from _START_ until _END_ of _TOTAL_ data lines',
        datatable_zero_records: 'Unable to search the desired data',
        datatable_emptyTable: 'There is no data in the table',
        datatable_infoEmpty: 'There is no data to display',
        datatable_infoFiltered: '(filtered in _MAX_ data lines)',
        datatable_copy: 'Copy',
        datatable_print: 'Print',
        datatable_col_visibility: 'Column Visibility',
        datatable_searchFoot: 'Search by',

        /** Max lenght **/
        you_have: 'You have ',
        of: ' of ',
        char_remaining: ' char remaining.',

        /** Multi Select **/
        select_all: 'Select all',
        deselect_all: 'Deselect all',

        /** Youtube **/
        no_link_youtube: 'Please the youtube code',

        /** Address **/
        please_choose_district: 'Please choose district',
        please_choose_ward: 'Please choose ward',
    };

    return {
        translate: function (item) {
            return content[item];
        }
    };
}();