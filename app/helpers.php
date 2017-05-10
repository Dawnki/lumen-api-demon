<?php
/**
 * Created by PhpStorm.
 * User: Dawnki Chow
 * Date: 2017/4/27 0027
 * Time: 3:50
 */

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string $value
     * @param  array $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}

if (!function_exists('success')) {
    /**
     *  Handle successful message
     * @param $msg
     * @param null $data
     * @return null
     */
    function success($msg, $data = null)
    {
        $result = array(
            'ret_msg' => $msg
        );
        if (!empty($data)) $result['data'] = $data;
        return $data;
    }
}