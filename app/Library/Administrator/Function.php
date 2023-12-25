<?php
if (!function_exists('checkedRole')) {
    /**
     * Check role of permission after choose
     * @param $array
     * @param $item
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function checkedRole($array, $item): string
    {
        return (is_array($array) && in_array($item, $array)) ? 'checked' : '';
    }
}

if (!function_exists('checkExt')) {
    /**
     * Check file extension
     * @param string $name
     * @param array $ext
     * @return bool
     * @author Quốc Tuấn
     */
    function checkExt(string $name, array $ext): bool
    {
        $pos_dot  = strrpos($name, ".") + 1;
        $file_ext = substr($name, $pos_dot);
        if (in_array($file_ext, $ext)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('time_24_hours')) {
    /**
     * Show time for 24 hours
     * @param $active
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function time_24_hours(string $active = null): string
    {
        if ($active == null) {
            $time_current = date("H:i", time());
        } else {
            $time_current = $active;
        }
        $time_current_part   = explode(":", $time_current);
        $time_current_time   = $time_current_part[0];
        $time_current_minute = $time_current_part[1];

        if ($time_current_minute >= 0 && $time_current_minute <= 15) {
            $time_current_minute = 15;
        } elseif ($time_current_minute >= 16 && $time_current_minute <= 30) {
            $time_current_minute = 30;
        } elseif ($time_current_minute >= 31 && $time_current_minute <= 45) {
            $time_current_minute = 45;
        } else {
            $time_current_time   += 1;
            $time_current_minute = '00';
        }

        $active        = $time_current_time . ":" . $time_current_minute;
        $hour_start    = $time_current_time;
        $minutes_start = $time_current_minute;

        $hours = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
        $mins  = array("00", 15, 30, 45);

        if ($hour_start != NULL) {
            $position_hours_start = array_search($hour_start, $hours);
            $hours                = array_splice($hours, $position_hours_start, count($hours) + 1);
        }

        if ($minutes_start != NULL) {
            $position_minutes_start = array_search($minutes_start, $mins);
            $mins                   = array_splice($mins, $position_minutes_start, count($mins) + 1);
        }

        $select = "";
        foreach ($hours as $hour) {
            foreach ($mins as $min) {
                $selected = ($hour . ':' . $min == $active) ? 'selected' : '';
                $select   .= '<option value="' . $hour . ':' . $min . '" ' . $selected . '>' . $hour . ':' . $min . '</option>';
            }
        }

        return $select;
    }
}

if (!function_exists('get_user_agent')) {
    /**
     * Get client agent
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function get_user_agent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}

if (!function_exists('get_client_ip')) {
    /**
     * Get client IP
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function get_client_ip(): string
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
}

if (!function_exists('get_os')) {
    /**
     * Get client os
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function get_os(): string
    {
        $user_agent  = get_user_agent();
        $os_platform = "Unknown OS Platform";
        $os_array    = array(
            '/windows nt 10/i'      => 'Windows 10',
            '/windows nt 6.3/i'     => 'Windows 8.1',
            '/windows nt 6.2/i'     => 'Windows 8',
            '/windows nt 6.1/i'     => 'Windows 7',
            '/windows nt 6.0/i'     => 'Windows Vista',
            '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     => 'Windows XP',
            '/windows xp/i'         => 'Windows XP',
            '/windows nt 5.0/i'     => 'Windows 2000',
            '/windows me/i'         => 'Windows ME',
            '/win98/i'              => 'Windows 98',
            '/win95/i'              => 'Windows 95',
            '/win16/i'              => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i'        => 'Mac OS 9',
            '/linux/i'              => 'Linux',
            '/ubuntu/i'             => 'Ubuntu',
            '/iphone/i'             => 'iPhone',
            '/ipod/i'               => 'iPod',
            '/ipad/i'               => 'iPad',
            '/android/i'            => 'Android',
            '/blackberry/i'         => 'BlackBerry',
            '/webos/i'              => 'Mobile',
        );

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        return $os_platform;
    }
}

if (!function_exists('get_browsers')) {
    /**
     * Get client browser
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function get_browsers(): string
    {
        $user_agent    = get_user_agent();
        $browser       = "Unknown Browser";
        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/Trident/i'   => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/'   => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/knoqueror/i' => 'Konqueror',
            '/ubrowser/i'  => 'UC Browser',
            '/mobile/i'    => 'Safari Browser',
        );

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }
        return $browser;
    }
}

if (!function_exists('get_device')) {
    /**
     * Get client browser
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function get_device(): string
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),
                    'application/vnd.wap.xhtml+xml') > 0) or
            ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or
                isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua     = strtolower(substr(get_user_agent(), 0, 4));
        $mobile_agents = array(
            'w3c', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower(get_client_ip()), 'opera mini') > 0) {
            $mobile_browser++;
            $stock_ua =
                strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ?
                    $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] :
                    (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ?
                        $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));

            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            return 'Tablet';
        } else if ($mobile_browser > 0) {
            return 'Mobile';
        } else {
            return 'Computer - Laptop';
        }
    }
}

if (!function_exists('recursiveSelect')) {
    /**
     * Show select option recursive
     * @param $data
     * @param $selected
     * @param int $parent_id
     * @param string $char
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function recursiveSelect($data, $selected, int $parent_id = 1, string $char = '')
    {
        foreach ($data as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $selOpt = $selected == $item->id ? 'selected' : '';
                echo '<option ' . $selOpt . ' value="' . $item->id . '">';
                echo $char . $item->name;
                echo '</option>';

                unset($data[$key]);

                recursiveSelect($data, $selected, $item->id, $char . '----| ');
            }
        }
    }
}

if (!function_exists('recursiveTableCategory')) {
    /**
     * Show table recursive
     * @param $data
     * @param $classCategory
     * @param int $parent_id
     * @param string $char
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function recursiveTableCategory($data, $classCategory, int $parent_id = 1, string $char = '')
    {
        foreach ($data as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $translate = $classCategory->translateRemaining($item->uuid);

                if (config('app.multi_language')) {
                    $translateFull = $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    $translateFull = 'text-default';
                }

                echo '<tr class="' . $translateFull . '">';
                echo '<td>' . $char . ' <input name="position" type="text" class="text-center form-control d-inline" value="' . $item->position . '" style="width: 45px" data-id="' . $item->id . '"></td>';
                echo '<td>' . $char . $item->name . '</td>';
                echo '<td>' . $item->created_at->format('d/m/Y') . '</td>';

                if ($item->status == 'on') {
                    echo '<td><span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span></td>';
                } else {
                    echo '<td><span class="badge badge-secondary">' . label('element.status_disable') . '</span></td>';
                }

                echo '<td class="text-center"><div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right">';

                if (auth()->user()->can('category_edit')) {
                    echo '<a href="' . route('admin.category.edit', ['category' => $item->uuid]) . '" class="dropdown-item text-info"><i class="icon-pencil"></i> ' . behavior('action.edit') . '</a>';
                }

                if (auth()->user()->can('category_destroy')) {
                    echo '<a href="' . route('admin.category.destroy', ['category' => $item->uuid]) . '" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> ' . behavior('action.delete') . '</a>';
                }

                if (config('app.multi_language') && auth()->user()->can('category_create')) {
                    $translate = $classCategory->translateRemaining($item->uuid);
                    if ($translate["full"]) {
                        echo '<a class="dropdown-item"><i class="icon-earth"></i> ' . behavior('action.language') . $translate['language'] . '</a>';
                    } else {
                        echo '<a href="' . route('admin.category.language', ['category' => $item->uuid]) . '" class="dropdown-item"><i class="icon-earth"></i> ' . behavior('action.language') . $translate['language'] . '</a>';
                    }
                }

                echo '</div></div></div></td>';
                echo '</tr>';

                unset($data[$key]);

                recursiveTableCategory($data, $classCategory, $item->id, $char . '----| ');
            }
        }
    }
}

if (!function_exists('recursiveTable')) {
    /**
     * Show table recursive
     * @param $data
     * @param $classCategory
     * @param int $parent_id
     * @param string $char
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function recursiveTable($data, int $parent_id = 1, string $char = '')
    {
        foreach ($data as $key => $item) {
            if ($item->parent_id == $parent_id) {
                echo '<tr>';
                echo '<td>' . $char . ' <input name="position" type="text" class="text-center form-control d-inline" value="' . $item->position . '" style="width: 45px" data-id="' . $item->id . '"></td>';
                echo '<td>' . $char . $item->name . '</td>';
                echo '<td>' . $item->created_at->format('d/m/Y') . '</td>';

                if ($item->status == 'on') {
                    echo '<td><span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span></td>';
                } else {
                    echo '<td><span class="badge badge-secondary">' . label('element.status_disable') . '</span></td>';
                }

                echo '<td class="text-center"><div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right">';

                if (auth()->user()->can('position_edit')) {
                    echo '<a href="' . route('admin.position.edit', ['position' => $item->uuid]) . '" class="dropdown-item text-info"><i class="icon-pencil"></i> ' . behavior('action.edit') . '</a>';
                }

                if (auth()->user()->can('position_destroy')) {
                    echo '<a href="' . route('admin.position.destroy', ['position' => $item->uuid]) . '" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> ' . behavior('action.delete') . '</a>';
                }

                echo '</div></div></div></td>';
                echo '</tr>';

                unset($data[$key]);

                recursiveTable($data, $item->id, $char . '----| ');
            }
        }
    }
}

if (!function_exists('recursionList')) {
    /**
     * Show list recursive
     * @param $data
     * @param array $checked
     * @param int $parent
     * @param int $level
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function recursionList($data, array $checked = array(), int $parent = 1, int $level = 0)
    {
        $child = array();
        foreach ($data as $key => $value) {
            if ($value["parent_id"] == $parent) {
                $child[] = $value;
                unset($data[$key]);
            }
        }

        if ($child) {
            if ($level == 0) {
                echo '<ul class="list-category-root">';
            } else {
                echo '<ul class="list-category">';
            }

            foreach ($child as $key => $value) {
                $id   = $value->id;
                $name = $value->name;

                if (!empty($checked) && in_array($id, $checked)) {
                    $input = '<div class="form-check"><label class="form-check-label"><input class="form-check-input-styled" type="checkbox" name="category_id[]" value="' . $id . '" checked /> ' . $name . '</label></div>';
                } else {
                    $input = '<div class="form-check"><label class="form-check-label"><input class="form-check-input-styled" type="checkbox" name="category_id[]" value="' . $id . '" /> ' . $name . '</label></div>';
                }

                echo '<li>' . $input;
                recursionList($data, $checked, $id, ++$level);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}

if (!function_exists('recursiveSelectDatatable')) {
    /**
     * Show select option recursive for datatable
     * @param $data
     * @param $selected
     * @param int $parent_id
     * @param string $char
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function recursiveSelectDatatable($data, $selected, int $parent_id = 1, string $char = '')
    {
        foreach ($data as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $selOpt = $selected == $item->id ? 'selected' : '';
                echo '<option ' . $selOpt . ' value="'.$item->id.'">';
                echo $char . $item->name;
                echo '</option>';

                unset($data[$key]);

                recursiveSelectDatatable($data, $selected, $item->id, $char . '----| ');
            }
        }
    }
}

if (!function_exists('humanFilesize')) {
    /**
     * Convert file size
     * @param $size
     * @param int $precision
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function humanFilesize($size, $precision = 2)
    {
        $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $step  = 1024;
        $i     = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision) . ' ' . $units[$i];
    }
}