<?php

namespace App\Http\Controllers\admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Datatables;
use DB;

class SkillController extends Controller
{
    public function index(){
        return view("admin.skill");
    }

    public function skilldata(){
        // return Datatables::of(Skill::query())->make(true);

        $queryData  = DB::table("fp_skills")
                ->where('status', '<>', 2)
                ->get();

        return Datatables::of($queryData)
                        ->editColumn("status", function($queryData) {

                            return ($queryData->status)?'Deactive':'Active';
                        })
                        ->editColumn("action", function($queryData) {

                            return '<a href="javascript:" class="btn btn-rounded btn-xs btn-info mb-1 mr-1 btn-edit" data-id="' . $queryData->id . '"><i class="fa fa-pencil"></i></a>'
                                    . '<a href="javascript:" class="btn btn-rounded btn-xs btn-danger mb-1 mr-1 btn-delete" data-id="' . $queryData->id . '"><i class="fa fa-trash"></i></a>';
                        })
                        ->rawColumns(["action"])
                        ->make(true);
    }

    public function save(Request $request){
        $id = $request->hiddenval;
        $validator = Validator::make(
            array(
                "skill"=>$request->skill
            ),
            array(
                "skill"=>"required".(($id > 0)?'':"|unique:fp_skills")
            )
        );
        if ($validator->fails())
            return redirect("/dashboard/skills")->withErrors($validator)->withInput();
        
        if($id > 0){
            $skill = Skill::find($id);
            $action = "updated";
        }
        else{
            $skill = new Skill;
            $action = "created";
        }

        $skill->skill = $request->skill;
        $skill->save();
        $request->session()->flash("msg", "Skill has been $action successfully.");
        return redirect("/dashboard/skills");
        
    }

    public function delete(Request $request) {

        $id = $request->hiddenval;

        $queryData = Skill::find($id);

        if (isset($queryData->id)) {
          
            $queryData->delete();

            echo json_encode(array("status" => 1, "message" => "Skill deleted successfully"));
        } else {
            echo json_encode(array("status" => 0, "message" => "Skill doesnot exists"));
        }

        die();
    }
}
