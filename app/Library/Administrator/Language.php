<?php
if (!function_exists('mbUcFirst')) {
    /**
     * Convert text to uppercase with first character
     * @param string $str
     * @param string $encoding
     * @param bool $lower_str_end
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function mbUcFirst(string $str, string $encoding = "UTF-8", bool $lower_str_end = false): string
    {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end      = null;

        if ($lower_str_end) {
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        } else {
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }

        $str = $first_letter . $str_end;
        return $str;
    }
}

if (!function_exists('module')) {
    /**
     * Module name
     * @param string $name
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function module(string $name): string
    {
        return mbUcFirst(trans('module.' . $name));
    }
}

if (!function_exists('label')) {
    /**
     * Auto generate label
     * @param string $name
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function label(string $name): string
    {
        return trans('form.' . $name);
    }
}

if (!function_exists('placeholder')) {
    /**
     * Auto generate placeholder
     * @param string $name
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function placeholder(string $name): string
    {
        return trans('form.placeholder', ['attribute' => mb_strtolower(trans('form.' . $name))]);
    }
}

if (!function_exists('behavior')) {
    /**
     * Act in function
     * @param string $content
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function behavior(string $content): string
    {
        return trans('action.' . $content);
    }
}

if (!function_exists('title_module')) {
    /**
     * Title module
     * @param string $module
     * @param string $action
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function title_module(string $module, string $action): string
    {
        return trans('action.module.' . $action, ['module' => trans('module.' . $module)]);
    }
}

if (!function_exists('mail_content')) {
    /**
     * Mail content
     * @param string $content
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function mail_content(string $content): string
    {
        return trans('mail.' . $content);
    }
}

if (!function_exists('message')) {
    /**
     * Notification of results
     * @param string $name
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function message(string $name): string
    {
        return trans('message.' . $name);
    }
}

if (!function_exists('attr')) {
    /**
     * Atribute form
     * @param string $name
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function attr($name): string
    {
        if (config('app.locale') == 'vi') {
            return mbUcFirst(trans('form.' . $name));
        }
        return mb_strtolower(trans('form.' . $name));
    }
}

if (!function_exists('message_module')) {
    /**
     * Message for module
     * @param string $module
     * @param string $message
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    function message_module(string $module, string $message): string
    {
        return trans('message.' . $message, ['module' => trans($module)]);
    }
}
