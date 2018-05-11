<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir,
    $config->application->servicesDir
]);

/**
 * Registering a set of namespaces from the configuration files
 */
$loader->registerNamespaces([
    'GanttDashboard\\App\\Controllers' => $config->application->controllersDir,
    'GanttDashboard\\App\\Models' => $config->application->modelsDir,
    'GanttDashboard\\App\\Services' => $config->application->servicesDir,
]);

$loader->register();
