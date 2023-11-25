<?php

namespace App\Helpers;

use App\Models\Option as WOption;

class Option{
    public static $options = [];
    public static function get($key,$cache = true,$default = null,$cacheTime = 60 * 24 * 60){

        if (isset(self::$options[$key])){
            return self::$options[$key];
        }

        if ($cache){
            $option = cache()->remember('option_'.$key, $cacheTime, function () use ($key) {
                return WOption::where('key',$key)->first();
            });
        }else{
            $option = WOption::where('key',$key)->first();
        }

        if(!isset(self::$options[$key])){
            self::$options[$key] = $option;
        }

        if($option){
            return $option->value;
        }

        return $default;
    }

    public static function update($key,$value,$autoload = null){
        $option = WOption::where('key',$key)->first();
        if($option){
            $option->value = $value;
            if($autoload){
                $option->autoload = $autoload;
            }
            $option->save();
        }else{
            $option = new WOption();
            $option->key = $key;
            $option->value = $value;
            if($autoload){
                $option->autoload = $autoload;
            }
            $option->save();
        }
        self::$options[$key] = $option;
        cache()->forget('option_'.$key);
        return true;
    }

    public static function autoload(){
        $options = WOption::where('autoload','yes')->get();
        foreach ($options as $option){
            self::$options[$option->key] = $option;
            cache()->put('option_'.$option->key,$option,60 * 24 * 60);
        }
    }

}
