<?php
/**
 * init
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
if(file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require  dirname(__DIR__) . '/vendor/autoload.php';
} else {
    require_once dirname(__DIR__)  . '/src/Support/Helpers.php';
    spl_autoload_register(function ($class) {
        $ns = 'CjsSupport';
        $base_dir = dirname(__DIR__) . '/src/Support';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (is_readable($file)) {
            require $file;
        }

    });
}

