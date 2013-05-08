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
     * The directory our config files are stored in.
     * 
     * @var string
     */
    private static $configDirectory;

    /**
     * Set the config directory.
     * 
     * @param string $directory
     */
    public static function setConfigDirectory($directory)
    {
        self::$configDirectory = $directory;
    }

    public static function get($keyPath, $default = null)
    {
        // If there are no parameters we send back the whole config array.
        if (is_null($keyPath)) return self::$loadedFiles;

        list($fileKeyPath, $configItemKeyPath) = self::parseKeyPath($keyPath);

        if ( ! self::isConfigFile($fileKeyPath)) {
            throw new \Exception('Config file ' . self::getFilePath($fileKeyPath) . ' does not exist');
        }

        $filePath = self::getFilePath($fileKeyPath);

        if ( ! array_key_exists($fileKeyPath, self::$loadedFiles)) {
          self::loadFile($fileKeyPath, $filePath);
        }

        $requestedConfig = self::$loadedFiles[$fileKeyPath];

        return Arr::get($configItemKeyPath, $requestedConfig, $default);
    }

    private static function loadFile($key, $file)
    {
        self::$loadedFiles = self::$loadedFiles + array($key => require_once($file));
    }

    private static function parseKeyPath($keyPath)
    {
        $fileKeyPath = $keyPath;

        while ($delimiterPos = strrpos($fileKeyPath, '.')) {
            $fileKeyPath = substr($fileKeyPath, 0, $delimiterPos);
            $configItemKeyPath = substr($keyPath, $delimiterPos+1, strlen($keyPath));

            if (self::isConfigFile($fileKeyPath)) {
                break;
            }
        }

        return array($fileKeyPath, $configItemKeyPath);
    }

    private static function isConfigFile($fileKeyPath)
    {
        return is_file(self::getFilePath($fileKeyPath));
    }

    private static function getFilePath($fileKeyPath)
    {
        return self::$configDirectory.(str_replace('.', '/', $fileKeyPath)).EXT;
    }
}