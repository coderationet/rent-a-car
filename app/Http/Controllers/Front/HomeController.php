<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

//        Artisan::call('cache:clear');

        $categories = cache()->remember('all_categories', 60*60, function () {
            return ItemCategory::with('thumbnail')->orderBy('name', 'asc')->get();
        });

        return view('front.home', compact('categories'));
    }

    public function validate_search(Request $request){

        if ($request->filled('start_date')){

            $validator = Validator::make($request->all(), [
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false ,'errors' => $validator->errors()->all()]);
            }
        }

        return response()->json(['success' => true, 'errors' => []]);
    }
}
