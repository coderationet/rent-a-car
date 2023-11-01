<?php

namespace App\Http\Controllers\Admin\Helpers;

use App\Helpers\Permalink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlugGeneratorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => ['string', 'required', 'max:500'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid data',
            ]);
        }

        $slug = Permalink::generate($request->title);

        return response()->json([
            'status' => 'success',
            'slug' => $slug,
        ]);
    }
}
