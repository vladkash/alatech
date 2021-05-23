<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class ResourceController extends Controller
{
    public function index($resource, Request $request)
    {
        if ($request->has('pageSize')) {
            $pageSize = $request->get('pageSize');
        } else {
            $pageSize = 10;
        }

        $query = DB::table(Str::singular(Str::camel($resource)));

        if ($request->has('q')) {
            $query->where('name','like', '%'.$request->get('q').'%');
        }

        $data = $query->paginate($pageSize)->items();

        return response()->json($data);
    }
}
