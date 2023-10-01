<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function show($slug){
        $page = cache()->remember('page_'.$slug, 60, function () use ($slug) {
            return \App\Models\Page::where('slug', $slug)->first();
        });
        return view('front.page.show', compact('page'));
    }

    public function contact(){
        $page = [
            "name" => "Contact",
            "slug" => "contact",
            "id" => "contact",
        ];
        // convert to object
        $page = json_encode($page);
        $page = json_decode($page);
        return view('front.page.contact', compact('page'));
    }

    public function contact_post(Request $request){
        // name, message, email required
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error',$validate->errors()->first())->withInput();
        }

        // save to database
        $contact = Contact::create([
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email,
        ]);

        // redirect back with success message
        return redirect()->back()->with('success',__('front/contact.msg.message_send_successfully'));
    }
}
