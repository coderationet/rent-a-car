<?php

namespace App\Helpers;

class FilterHelper
{

    /**
     * Remove filter from url
     * @param $request
     * @return string
     * @throws \Exception
     */
    public static function remove_filter_from_url($request)
    {

        $ref = $request->headers->get('referer');

        $query_params = explode('?', $ref)[1];

        $query_params = explode('&', $query_params);

        $parameters = [];

        foreach ($query_params as $query_param) {

            $query_param = explode('=', $query_param);

            $query_param[0] = str_replace('%5B%5D', '', $query_param[0]);
            $query_param[0] = str_replace('[]', '', $query_param[0]);


            if (!isset($parameters[$query_param[0]])) {
                $parameters[$query_param[0]] = [];
            }

            $parameters[$query_param[0]][] = $query_param[1];
        }


        $attribute_value_id = $request->get('attribute_value_id');

        foreach ($parameters as $key => $parameter) {
            if ($key == 'page') {
                unset($parameters[$key]);
                continue;
            }
            if (str_contains($key, 'attribute_')) {
                foreach ($parameter as $value_key => $value_id) {
                    if ($value_id == $attribute_value_id) {
                        unset($parameters[$key][$value_key]);
                    }
                }
            }
            if ($key == 'category') {
                foreach ($parameter as $value_key => $value_id) {
                    if ($value_id == $attribute_value_id) {
                        unset($parameters[$key][$value_key]);
                    }
                }
            }
        }

        $url = route('front.search.index') . '?';

        foreach ($parameters as $key => $parameter) {
            if (str_contains($key, 'attribute_')) {
                foreach ($parameter as $value_key => $value_id) {
                    $url .= $key . '[]=' . $value_id . '&';
                }
            } else if ($key == 'category') {
                foreach ($parameter as $value_key => $value_id) {
                    $url .= $key . '[]=' . $value_id . '&';
                }
            } else {
                $url .= $key . '=' . $parameter[0] . '&';
            }
        }

        $url = rtrim($url, '&');


        return $url;
    }
}
