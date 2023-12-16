<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reservations.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $reservation = Reservation::with(['item','user'])->findOrFail($id);
        return view('admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index');
    }

    public function data(){

        $reservations = Reservation::query();

        $reservations = $reservations->with(['user','item']);

        // column 0 search value
        $columns = request()->get('columns');

        $search = request()->get('search');

        // search on 2. and 3. columns
        if ($search['value']) {
            $reservations = $reservations->where(function ($query) use ($search) {
                // id  item->title  user->name
                $query->where('id', 'like', '%' . $search['value'] . '%')
                    ->orWhere('status', 'like', '%' . $search['value'] . '%')
                    ->orWhereHas('item', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search['value'] . '%');
                    })
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search['value'] . '%');
                    });

            });
        }


        $count = $reservations->count();

        // prepare response for datatable
        $response = [];
        $response['draw'] = request()->get('draw');
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        // data without column names
        // get page from url query parameter or set default
        $limit = request()->get('length') ?? 25;
        $offset = request()->get('start') ?? 0;

        # default order desc by id
        $order_by = 'id';
        $order_dir = 'desc';

        if (request()->has('order')) {
            $order = $columns[request()->get('order')[0]['column']]['data'];
            $order_by = $order;
            $order_dir = request()->get('order')[0]['dir'];
        }

        if ($order_by == 'actions') {
            $order_by = 'id';
        }

        $reservations = $reservations->orderBy($order_by, $order_dir)->offset($offset)->limit($limit)->get()->map(function ($reservation) {
            return [
                "id" => $reservation->id,
                "user_name" => $reservation->user->name,
                "item_name" => $reservation->item->title,
                "status" => strtoupper($reservation->status),
                "actions" => view('admin.reservations.actions', compact('reservation'))->render()
            ];
        });

        // pagination
        $response['pagination']['more'] = true;
        $response['data'] = $reservations;

        return response()->json($response);
    }
}
