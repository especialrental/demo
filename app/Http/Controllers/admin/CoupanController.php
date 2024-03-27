<?php

namespace App\Http\Controllers\admin;

use App\Model\Coupan;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
//use Datatables;
use DB;
use App\Helpers\Common_helper;
use Yajra\DataTables\Facades\DataTables; 

class CoupanController extends Controller
{
    public function index(){
        $data['coupan'] = Coupan::paginate(10);
        //dd($data);
        return view("admin.coupan-list",$data);
    }
}