<?php

/**
 * Namespace map for autoloading classes by their namespace.
 * Add namespace-to-directory mappings in the format 'Namespace' => 'path/to/directory'.
 */
$namespaceMap = [
    'App\\Controllers' => __DIR__ . '/src/Controllers',
    'App\\Models' => __DIR__ . '/src/Models',
    // Add more namespace-to-directory mappings here
];

spl_autoload_register(function (string $class) use ($namespaceMap): void {
    foreach ($namespaceMap as $namespace => $directory) {
        if (str_starts_with($class, $namespace)) {
            $relativeClass = substr($class, strlen($namespace));
            $file = $directory . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                include $file;
                return;
            } else {
                error_log("Autoload error: File for class '$class' does not exist at '$file'.");
            }
        }
    }
});
