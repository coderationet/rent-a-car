<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required|min:6|confirmed",
            "password_confirmation" => "required|min:6",
        ]);

        $user = User::create($request->only('name', 'email', 'password'));

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı Oluşturuldu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email,".$id,
            "password_confirmation" => "nullable|min:6",
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();


        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı Silindi');
    }

    public function data(){

        $users = User::query();

        $response = [];

        $response['draw'] = request()->get('draw');

        $response['recordsTotal'] = $users->count();
        $response['recordsFiltered'] = $users->count();

        $offset = request()->get('start');
        $limit = request()->get('length');

        $data = $users->offset($offset)->limit($limit)->get()->map(function ($user){
            return [
                "id" => "#".$user->id,
                "name" => $user->name,
                "actions" => view('admin.user.actions', compact('user'))->render()
            ];
        });
        $response['data'] = $data;
        // pagination
        $response['pagination']['more'] = false;

        return response()->json($response);

    }

    function ajax_data(){
        // ajax data for select2
        $users = User::query();

        if (request()->has('q')) {
            $search = request()->get('q');
            # search in brand + model + base_color + color_code combinated name
            # search in product name
            $users->where('name', 'LIKE', "%$search%");
        }

        if (request()->has('user_id')){
            $users->where('id', request()->get('user_id'));
        }

        $users = $users->limit(20)->offset(0)->get();

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                "id" => $user->id,
                "text" => $user->name,
            ];
        }
        return response()->json([
            'results' => $response
        ]);
    }
}
