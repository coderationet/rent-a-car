<?php

namespace App\Http\Controllers\Admin\Module\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataTable\IndexDataTableGetRequest;
use Illuminate\Support\Facades\DB;

class DataTableController extends Controller
{
    /**
     * Build json data for datatable.
     *
     * @param IndexDataTableGetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(IndexDataTableGetRequest $request)
    {
        $validated = $request->validated();

        $items = DB::table($validated['table_name']);

        // column 0 search value
        $columns = request()->get('columns');

        $column_names = array_map(function ($column) {
            return $column['data'];
        }, $columns);

        $search = request()->get('search');

        // search on all columns
        if ($search['value']) {
            $items = $items->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    if($column['data'] == 'actions') continue;
                    if ($column['searchable']) {
                        $query->orWhere($column['data'], 'like', '%' . $search['value'] . '%');
                    }
                }
            });
        }



        $count = $items->count();

        // prepare response for datatable
        $response = [];
        $response['draw'] = request()->get('draw');
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        // data without column names
        // get page from url query parameter or set default
        $limit = request()->get('length') ?? 10;
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


        $route_name_prefix = request()
            ->filled('route_name_prefix') ? request()->get('route_name_prefix') . '.' : 'admin.'.request()->get('table_name') . '.';

        $items = $items->orderBy($order_by, $order_dir)
            ->offset($offset)->limit($limit)
            ->get()
            ->map(function ($item) use($column_names,$route_name_prefix) {

            $row = [];

            foreach ($item as $key => $value) {
                if($key != 'actions' && in_array($key, $column_names)){
                    $row[$key] = $value;
                }
            }

            $row['actions'] = view('admin.layouts.datatable-actions', [
                'editUrl' => route($route_name_prefix.'edit', $item->id),
                'deleteUrl' => route($route_name_prefix . 'destroy', $item->id),
            ])->render();

            return $row;
        });

        // pagination
        $response['pagination']['more'] = true;
        $response['data'] = $items;

        return response()->json($response);
    }
}
