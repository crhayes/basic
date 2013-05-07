<?php

namespace Core\Utilities;

class Arr
{
    /**
     * Given an array key in "dot notation" get an array value if it 
     * exists, otherwise return a default value.
     * 
     * @param   string  $keys
     * @param   array   $array
     * @param   array   $default
     * @return  string
     */
    public static function get($keys, $array, $default = null)
    {
        foreach (explode('.', $keys) as $key) {
            if ( ! is_array($array) or ! array_key_exists($key, $array)) {
                return $default;
            }

            $array = $array[$key];
        }
        
        return $array;
    }
    
    /**
     * Given an array key in dot notation create and set a value in an array.
     * 
     * @param   string  $keys   Array key as a dot notated string.   
     * @param   $value  mixed   Value to set the array key.
     * @return  array 
     */
    public static function set($keys, $value)
    {
        $array = $value;
        
        foreach (array_reverse(explode('.', $keys)) as $key) {
            $value = $array;
            unset($array);
            
            $array[$key] = $value;
        }
        
        return $array;
    }
}