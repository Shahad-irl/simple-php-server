<?php

/**
 * Class map for autoloading classes by their file paths.
 * Add class-to-file mappings in the format 'ClassName' => 'path/to/ClassFile.php'.
 */
$classMap = [
    'SomeClass' => __DIR__ . '/src/SomeClass.php',
    'AnotherClass' => __DIR__ . '/src/AnotherClass.php',
    // Add more mappings here
];

spl_autoload_register(function (string $class) use ($classMap): void {
    if (isset($classMap[$class])) {
        $file = $classMap[$class];
        if (file_exists($file)) {
            include $file;
        } else {
            error_log("Autoload error: File for class '$class' does not exist at '$file'.");
        }
    }
});
