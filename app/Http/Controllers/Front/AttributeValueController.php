<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function get(Request $request){
        // select2 ajax request
        $values = AttributeValue::query();
        $attribute_id = $request->post('attribute_id');
        $q = $request->post('q');
        $page = $request->post('page');


        $values = $values->where('attribute_id', $attribute_id);
        $values = $values->where('value', 'like', "%$q%");
        $values = $values->paginate(10, ['*'], 'page', $page);
        $pagination_more = $values->hasMorePages();
        $values = $values->toArray();

        $data = [];

        foreach($values['data'] as $value){
            $data[] = [
                'id' => $value['id'],
                'text' => $value['value']
            ];
        }

        $values['results'] = $data;

        $values['pagination'] = [
            'more' => $pagination_more
        ];

        return response()->json($values);

    }
}
