<?php
if (!function_exists('role_permissions')) {
    /**
     * Generate permission checkbox
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function role_permissions(): array
    {
        $modules = array(
            "user",
            "role",
            "category",
            "news",
            "page",
            "content",
            "position",
            "image",
            "province",
            "district",
            "ward",
            "producer",
            "attribute",
            "product",
            "cart",
            "customer",
            "advantages"
        );

        if (config('app.multi_language')) {
            $modules[] = "language";
        }

        $permission = array();

        foreach ($modules as $module) {
            $permission[$module] = array(
                [
                    'value' => $module . '_index',
                    'name'  => title_module($module, 'index'),
                ],
                [
                    'value' => $module . '_create',
                    'name'  => title_module($module, 'create'),
                ],
                [
                    'value' => $module . '_edit',
                    'name'  => title_module($module, 'edit'),
                ],
                [
                    'value' => $module . '_destroy',
                    'name'  => title_module($module, 'destroy'),
                ]
            );
        }

        $permission["contact"] = array(
            [
                'value' => 'contact_index',
                'name'  => title_module('contact', 'index'),
            ],
            [
                'value' => 'contact_destroy',
                'name'  => title_module('contact', 'destroy'),
            ],
            [
                'value' => 'contact_reply',
                'name'  => title_module('contact', 'reply'),
            ]
        );

        $permission["backup"] = array(
            [
                'value' => 'backup_index',
                'name'  => title_module('backup', 'index'),
            ],
            [
                'value' => 'backup_create',
                'name'  => title_module('backup', 'create'),
            ],
            [
                'value' => 'backup_download',
                'name'  => title_module('backup', 'download'),
            ],
            [
                'value' => 'backup_destroy',
                'name'  => title_module('backup', 'destroy'),
            ]
        );

        $permission["log_error"] = array(
            [
                'value' => 'log_error_statistical',
                'name'  => title_module('log_error', 'statistical'),
            ],
            [
                'value' => 'log_error_index',
                'name'  => title_module('log_error', 'index'),
            ],
            [
                'value' => 'activity_index',
                'name'  => title_module('activity', 'index'),
            ]
        );

        $permission["config"] = array(
            [
                'value' => 'config_edit',
                'name'  => title_module('config', 'edit'),
            ],
        );

        return $permission;
    }
}

if (!function_exists('level')) {
    /**
     * Generate data level of user
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function level()
    {

        $level = array(
            [
                'id'   => 1,
                'name' => label('user.admin'),
            ],
            [
                'id'   => 2,
                'name' => label('user.member'),
            ]
        );

        return json_decode(json_encode($level), false);
    }
}

if(!function_exists('status_cart')){

    /**
     * Generate data status cart
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function status_cart()
    {
        $status_cart = array(
            [
                'id'   => '1',
                'name' => label('status_cart.success')
            ],
            [
                'id'   => '2',
                'name' => label('status_cart.cancel')
            ],
            [
                'id'   => '3',
                'name' => label('status_cart.delevery')
            ],
            [
                'id'   => '4',
                'name' => label('status_cart.false')
            ],
            [
                'id'   => '5',
                'name' => label('status_cart.success_delevery')
            ]
        );

        return json_decode(json_encode($status_cart), false);
    }
}

if(!function_exists('payment_method')){

    /**
     * Generate data payment method
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function payment_method()
    {
        $payment_method = array(
            [
                'id'   => '1',
                'name' => label('payment_method.cod')
            ],
            [
                'id'   => '2',
                'name' => label('payment_method.tranfes')
            ]
        );

        return json_decode(json_encode($payment_method), false);
    }
}

if (!function_exists('backup')) {
    /**
     * Generate data type of backup
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function backup()
    {

        $backup = array(
            [
                'id'   => 1,
                'name' => label('backup.database'),
            ],
            [
                'id'   => 2,
                'name' => label('backup.source'),
            ],
            [
                'id'   => 3,
                'name' => label('backup.all'),
            ]
        );

        return json_decode(json_encode($backup), false);
    }
}

if (!function_exists('robot')) {
    /**
     * Generate data meta robot for SEO
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function robot()
    {

        $robot = array(
            [
                'id'   => 'index',
                'name' => 'Index',
            ],
            [
                'id'   => 'follow',
                'name' => 'Follow',
            ],
            [
                'id'   => 'all',
                'name' => 'All',
            ],
            [
                'id'   => 'nofollow',
                'name' => 'No Follow',
            ],
            [
                'id'   => 'noindex',
                'name' => 'No Index',
            ],
            [
                'id'   => 'none',
                'name' => 'None',
            ],
            [
                'id'   => 'noarchive',
                'name' => 'No Archive',
            ],
            [
                'id'   => 'nosnippet',
                'name' => 'No Snippet',
            ],
            [
                'id'   => 'max-snippet',
                'name' => 'Max Snippet',
            ],
        );

        return json_decode(json_encode($robot), false);
    }
}

if (!function_exists('open_link')) {
    /**
     * Generate data open link for tag
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function open_link()
    {

        $open = array(
            [
                'id'   => '_self',
                'name' => label('link.self')
            ],
            [
                'id'   => '_blank',
                'name' => label('link.blank')
            ],
            [
                'id'   => '_parent',
                'name' => label('link.parent')
            ],
            [
                'id'   => '_top',
                'name' => label('link.top')
            ]
        );

        return json_decode(json_encode($open), false);
    }
}

if (!function_exists('template_detail_news')) {
    /**
     * Generate data template detail news
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function template_detail_news()
    {
        $template_detail_news = array(
            [
                'id'   => '1',
                'name' => label('news.detail_page')
            ],
            [
                'id'   => '2',
                'name' => label('news.e_magazine_page')
            ]
        );

        return json_decode(json_encode($template_detail_news), false);
    }
}

if (!function_exists('template_detail_product')) {
    /**
     * Generate data template detail news
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function template_detail_product()
    {
        $template_detail_product = array(
            [
                'id'   => '1',
                'name' => label('product.detail_page')
            ]
        );

        return json_decode(json_encode($template_detail_product), false);
    }
}

if (!function_exists('status')) {
    /**
     * Generate data status
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function status()
    {
        $status = array(
            [
                'id'   => '1',
                'name' => label('status.in_process')
            ],
            [
                'id'   => '2',
                'name' => label('status.draft')
            ],
            [
                'id'   => '3',
                'name' => label('status.pending')
            ],
            [
                'id'   => '4',
                'name' => label('status.published')
            ],
            [
                'id'   => '5',
                'name' => label('status.retired')
            ],
            [
                'id'   => '6',
                'name' => label('status.close')
            ]
        );

        return json_decode(json_encode($status), false);
    }
}

if (!function_exists('featured')) {
    /**
     * Generate data featured
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function featured()
    {
        $featured = array(
            [
                'id'   => '1',
                'name' => label('featured.un_featured')
            ],
            [
                'id'   => '2',
                'name' => label('featured.most_outstanding')
            ],
            [
                'id'   => '3',
                'name' => label('featured.featured')
            ]
        );

        return json_decode(json_encode($featured), false);
    }
}

if (!function_exists('status_contact')) {
    /**
     * Generate data featured
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function status_contact()
    {
        $status_contact = array(
            [
                'id'   => '1',
                'name' => label('status_contact.not_contacted')
            ],
            [
                'id'   => '2',
                'name' => label('status_contact.dont_pickup_phone')
            ],
            [
                'id'   => '3',
                'name' => label('status_contact.contacted')
            ],
            [
                'id'   => '4',
                'name' => label('status_contact.sent_mail')
            ]
        );

        return json_decode(json_encode($status_contact), false);
    }
}

if (!function_exists('format_date')) {
    /**
     * Generate data format date
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function format_date()
    {

        $format_date = array(
            [
                'id'   => "dd-mm-yyyy",
                'name' => "dd-mm-yyyy",
            ],
            [
                'id'   => "dd/mm/yyyy",
                'name' => "dd/mm/yyyy",
            ],
            [
                'id'   => "yyyy-mm-dd",
                'name' => "yyyy-mm-dd",
            ],
            [
                'id'   => "yyyy/mm/dd",
                'name' => "yyyy/mm/dd",
            ]
        );

        return json_decode(json_encode($format_date), false);
    }
}

if (!function_exists('menu')) {
    /**
     * Generate menu sidebar
     * @param array $role
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function menu(array $role): array
    {
        $data_menu = array(
            "main_group"          => array(
                "category" => "icon-stack3",
                "customer" => "icon-comment",
            ),
            "area_group"          => array(
                "province" => "icon-city",
                "district" => "icon-office",
                "ward"     => "icon-home9",
            ),
            "article_group"       => array(
                "news" => "icon-newspaper",
                "page" => "icon-file-text2",
                "advantages" => "icon-file-text3",
            ),
            "product_group"       => array(
                "producer"  => "icon-home7",
                "attribute" => "icon-eyedropper2",
                "product"   => "icon-cube2",
            ),
            "cart_group"          => array(
                'cart'      => 'icon-cart4',
                'contact'   => 'icon-mailbox'
            ),
            "member_group"        => array(
                "user" => "icon-user",
                "role" => "icon-shield2"
            ),
            "media_group"         => array(
                "position" => "icon-target",
                "image"    => "icon-image2"
            ),
            "manage_system_group" => array(
                "backup" => "icon-database",
            )
        );

        if (config('app.multi_language')) {
            $data_menu["main_group"]["language"] = "icon-earth";
        }

        $menu = array();

        foreach ($data_menu as $name_group => $menu_item) {
            foreach ($menu_item as $module => $icon) {
                $slug = str_replace("_", "-", $module);

                $menu[$name_group][$module] = array(
                    'name'    => module($slug),
                    'route'   => 'admin.' . $slug . '.index',
                    'status'  => (in_array($module . '_index', $role)) || (in_array($module . '_create', $role)) || (in_array($module . '_edit', $role)) || (in_array($module . '_destroy', $role)),
                    'request' => 'admin/' . $module . '/*',
                    'module'  => $module,
                    'icon'    => $icon,
                    'action'  => array(
                        'index'  => array(
                            'name'    => title_module($slug, 'index'),
                            'route'   => 'admin.' . $slug . '.index',
                            'status'  => (in_array($module . '_index', $role)) || (in_array($module . '_edit', $role)) || (in_array($module . '_destroy', $role)),
                            'request' => 'admin/' . $module,
                        ),
                        'create' => array(
                            'name'    => title_module($slug, 'create'),
                            'route'   => 'admin.' . $slug . '.create',
                            'status'  => in_array($module . '_create', $role),
                            'request' => 'admin/' . $module . '/create',
                        ),
                    )
                );
            }
        }

        $menu['customer_care_group']['contact'] = array(
            'name'    => module('contact'),
            'route'   => 'admin.contact.index',
            'status'  => (in_array('contact_index', $role)) || (in_array('contact_reply', $role)) || (in_array('contact_destroy', $role)),
            'request' => 'admin/contact/*',
            'module'  => 'contact',
            'icon'    => 'icon-mailbox',
            'action'  => array(
                'index' => array(
                    'name'    => title_module('contact', 'index'),
                    'route'   => 'admin.contact.index',
                    'status'  => (in_array('contact_index', $role)) || (in_array('contact_reply', $role)) || (in_array('contact_destroy', $role)),
                    'request' => 'admin/reply-contact',
                ),
            )
        );

        $menu['manage_system_group']['log_error'] = array(
            'name'    => module('log_error'),
            'route'   => 'log-viewer::logs.list',
            'status'  => (in_array('log_error_statistical', $role)) || (in_array('log_error_index', $role)),
            'request' => 'admin/log-viewer/*',
            'module'  => 'log-viewer',
            'icon'    => 'icon-bug2',
            'action'  => array(
                'statistical' => array(
                    'name'    => title_module('log_error', 'statistical'),
                    'route'   => 'log-viewer::dashboard',
                    'status'  => (in_array('log_error_statistical', $role)),
                    'request' => 'admin/log-viewer',
                ),
                'index'       => array(
                    'name'    => title_module('log_error', 'index'),
                    'route'   => 'log-viewer::logs.list',
                    'status'  => (in_array('log_error_index', $role)),
                    'request' => 'admin/log-viewer/logs',
                )
            )
        );

        $menu['manage_system_group']['activity'] = array(
            'name'    => module('activity'),
            'route'   => 'admin.activity.index',
            'status'  => in_array('activity_index', $role),
            'request' => 'admin/activity/*',
            'module'  => 'activity',
            'icon'    => 'icon-multitouch',
            'action'  => array(
                'index' => array(
                    'name'    => title_module('activity', 'index'),
                    'route'   => 'admin.activity.index',
                    'status'  => in_array('activity_index', $role),
                    'request' => 'admin/activity',
                )
            )
        );

        $menu['manage_system_group']['config'] = array(
            'name'    => module('config'),
            'route'   => 'admin.config.edit',
            'status'  => in_array('config_edit', $role),
            'request' => 'admin/config/*',
            'module'  => 'config',
            'icon'    => 'icon-cog5',
            'action'  => array(
                'index' => array(
                    'name'    => title_module('config', 'edit'),
                    'route'   => 'admin.config.edit',
                    'status'  => in_array('config_edit', $role),
                    'request' => 'admin/activity',
                )
            )
        );

        return $menu;
    }
}

