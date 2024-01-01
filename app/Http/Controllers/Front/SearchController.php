<?php

namespace App\Http\Controllers\Front;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Queries\ItemQuery;
use Illuminate\Http\Request; 
class SearchController extends Controller
{
    public function index(Request $request, $category_ = null)
    {
      
        $data = ItemQuery::searchPageQuery($request, $category_);

        return view('front.search.show', $data);

    }

    function remove_filter_from_url(Request $request)
    {

        $url = FilterHelper::remove_filter_from_url($request);

        return response()->json([
            'url' => $url,
            'status' => 'success'
        ]);
    }

}
