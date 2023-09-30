<?php

namespace App\Helpers;
class HierarchicalListingHelper
{
    // hierarchically listing for checkboxes
    public static function get_listing_html($items, $selected_ids = [],$input_name = 'categories[]')
    {
        $html = '';

        foreach ($items as $item) {
            $selected = '';
            if (in_array($item->id, $selected_ids)) {
                $selected = 'checked';
            }
            $html .= '<li style="list-style: none"><input type="checkbox" name="'.$input_name.'" value="' . $item->id . '" ' . $selected . '> ' . $item->name . '</li>';
            if (count($item->children)) {
                $html .= '<ul style="margin-left:20px;padding: 0">';
                $html .= self::get_listing_html($item->children()->orderBy('name','asc')->get(), $selected_ids,$input_name);
                $html .= '</ul>';
            }

        }

        return '<ul style="margin:0;padding: 0">' . $html . '</ul>';
    }

    // hierarchically listing for select options
    public static function get_listing_options_html($items,$selected_item_id = null,$prefix = ''){

        $html = '';

        foreach ($items as $item) {
            $selected = '';
            if ($item->id == $selected_item_id) {
                $selected = 'selected';
            }
            $html .= '<option value="' . $item->id . '" ' . $selected . '>' . $prefix . $item->name . '</option>';
            if (count($item->children)) {
                $html .= self::get_listing_options_html($item->children()->orderBy('name','asc')->get(),$selected_item_id,$prefix.'- ');
            }
        }

        return $html;
    }
}
