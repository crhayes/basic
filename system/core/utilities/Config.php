<?php

namespace Core\Utilities;

class Config
{    
    /**
     * Store all of the configuration files we have loaded.
     * 
     * @var array 
     */
    public static $loadedFiles = array();

    /**
     * Load a configuration file and store it in an array.
     * 
     * @param   string  $fileName  Name of the config file to load.
     */
    public static function load($fileName)
    {
        // Load a single file
        if ( ! is_array($fileName)) {
            return self::loadFile($fileName);
        }

        // If we have an array load each file
        foreach ($fileName as $file) {
            self::loadFile($file);
        }
    }

    /**
     * Get a configuration item from an array using "dot" notation.
     * 
     * @param   string  $keys   Path using dot notation.
     * @param   mixed   $default   
     * @return  mixed 
     */
    public static function get($keys, $default = null)
    {
        $config = self::$loadedFiles;
        
        // If there are no parameters we send back the whole config array.
        if (is_null($keys)) return $config;
        
        return Arr::get($keys, $config, $default);
    }

    private static function loadFile($fileName)
    {
        if (file_exists($path = APP_PATH.'config'.DS.str_replace('.', '/', $fileName).EXT)) {
            self::$loadedFiles = self::$loadedFiles + Arr::set($fileName, require_once($path));
        }
    }
}