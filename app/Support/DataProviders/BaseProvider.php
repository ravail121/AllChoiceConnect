<?php 

namespace App\Support\DataProviders;

abstract class BaseProvider {
    
    protected static $default = null;

    /**
    * Generate an Illuminate\Collection for easy access of data
    *
    * @return Collection
    */
    public static function data()
    {
        return collect(static::$data);
    }

    public static function bundle()
    {
        $data    = static::data();
        $default = static::$default;
        return collect(compact('data', 'default'));
    }
}