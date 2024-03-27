<?php

namespace App\Http\Controllers\admin;

use App\Models\Query;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;

class QueryController extends Controller
{
    public function index(){
        return view("admin.list_query");
    }

    public function querydata(){
        // return Datatables::of(Query::query())->make(true);
        $queryData  = DB::table("fp_queries")
                ->get();
        return Datatables::of($queryData)
                        ->editColumn("action", function($queryData) {

                            return '<a href="javascript:" class="btn btn-rounded btn-xs btn-default mb-1 mr-1" data-id="' . $queryData->id . '"><i class="fa fa-eye"></i>';
                        })
                        ->rawColumns(["action"])
                        ->make(true);
    }


}
