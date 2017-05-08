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