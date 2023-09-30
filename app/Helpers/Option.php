<?php

namespace App\Helpers;

use App\Models\Option as WOption;

class Option{
    public static function get($key,$cache = true,$default = null,$cacheTime = 60 * 24 * 60){
        if ($cache){
            $option = cache()->remember('option_'.$key, $cacheTime, function () use ($key) {
                return WOption::where('key',$key)->first();
            });
        }else{
            $option = WOption::where('key',$key)->first();
        }

        if($option){
            return $option->value;
        }
        return $default;
    }

    public static function update($key,$value){
        $option = WOption::where('key',$key)->first();
        if($option){
            $option->value = $value;
            $option->save();
        }else{
            $option = new WOption();
            $option->key = $key;
            $option->value = $value;
            $option->save();
        }
        cache()->forget('option_'.$key);
        return true;
    }

}
