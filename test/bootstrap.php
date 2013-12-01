<?php
/**
 * Bootstrap the tests
 *
 * PHP version 5.4
 *
 * @category   PeeHaaLibTest
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PeeHaaLibTest;

/**
 * Because PHP that's why
 */
date_default_timezone_set('Europe/Amsterdam');

/**
 * Simple SPL autoloader for the PeeHaaLibTest mocks
 *
 * @param string $class The class name to load
 *
 * @return void
 */
spl_autoload_register(function ($class) {
    $nslen = strlen(__NAMESPACE__);
    if (substr($class, 0, $nslen) != __NAMESPACE__) {
        return;
    }
    $path = substr(str_replace('\\', '/', $class), $nslen);
    $path = __DIR__ . $path . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

/**
 * Load the project's autoloader
 */
require_once __DIR__ . '/../bootstrap.php';

/**
 * Load PHPUnit
 */
require_once __DIR__ . '/../vendor/autoload.php';
