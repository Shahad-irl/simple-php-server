<?php

/**
 * ClassLoader handles the dynamic loading of PHP classes using class and namespace maps.
 */
class ClassLoader
{
    private array $classMap = [];
    private array $namespaceMap = [];

    /**
     * Add mappings to the class map.
     *
     * @param array $map An associative array of class-to-file mappings.
     */
    public function addClassMap(array $map): void
    {
        $this->classMap = array_merge($this->classMap, $map);
    }

    /**
     * Add mappings to the namespace map.
     *
     * @param array $map An associative array of namespace-to-directory mappings.
     */
    public function addNamespaceMap(array $map): void
    {
        $this->namespaceMap = array_merge($this->namespaceMap, $map);
    }

    /**
     * Attempt to load a class using the registered class and namespace maps.
     *
     * @param string $class The fully qualified class name to load.
     */
    public function loadClass(string $class): void
    {
        if (isset($this->classMap[$class])) {
            $file = $this->classMap[$class];
            if (file_exists($file)) {
                include $file;
                return;
            } else {
                error_log("ClassLoader error: File for class '$class' does not exist at '$file'.");
            }
        }

        foreach ($this->namespaceMap as $namespace => $directory) {
            if (str_starts_with($class, $namespace)) {
                $relativeClass = substr($class, strlen($namespace));
                $file = $directory . str_replace('\\', '/', $relativeClass) . '.php';

                if (file_exists($file)) {
                    include $file;
                    return;
                } else {
                    error_log("ClassLoader error: File for class '$class' does not exist at '$file'.");
                }
            }
        }
    }

    /**
     * Register this ClassLoader instance as an autoloader.
     */
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
}
