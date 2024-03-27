<?php







namespace App\Http\Controllers\admin;





use App\Model\Popup;



use Illuminate\Http\Request;



use Hash;



use App\Http\Controllers\Controller;


use Validator;



//use Datatables;



use DB;



use App\Helpers\Common_helper;



use Yajra\DataTables\Facades\DataTables; 


class PopupController extends Controller



{



    public function index(Request $request){

    $data['popup']=Popup::orderBy('id', 'desc')->paginate(10);

        return view("admin.popup",$data);

    }


    public function edit(Request $request){
       
        $html='';
        if($request->id){



            $popup =Popup::find($request->id);

            $html.='<div class="form-group"><label>Heading</label><input type="text" class="form-control" name="heading" id="heading" value="'.$popup->heading.'" required=""></div>';
            $html.='<div class="form-group"><label>Offer</label><input type="text" class="form-control" name="offer" id="offer" value="'.$popup->offer.'" required=""></div>';
            $html.='<div class="form-group"><label>Popup Disable</label><select class="form-control" name="popup_disable" id="popup_disable" placeholder="Popup Disable" required=""><option>Select Popup Disable</option><option value="1">Active</option><option value="0">Inactive</option></select></div>';
             $html.='<div class="form-group"><label>Upload Image</label><input type="file" class="form-control" name="image" id="image" value="'.$popup->popup_disable.'" required=""></div><input type="hidden" name="id" id="id" value="'.$popup->id.'">';
            //return array('status'=>1,'data'=>$popup);
           return array('status'=>1,'data'=>$html);


        }
        else
        {



            return array('status'=>0,'message'=>'ID Not found !');



        }



        return array('status'=>0,'message'=>'Some Thing Went Wrong!');



    }

    public function save(Request $request){

        //dd($request->all());
 
         
  
 
 
 
         if($request->id){
 
 
 
             $popup = Popup::find($request->id);
 
 
 
         }
 
 
 
         else{
 
 
 
             $popup = new Popup;
 
 
 
         }   
 
 
 
 
 
         $popup->heading=$request->heading;
 
         $file = $request->file('image');
         if ($file !== null) {
         $new_name = rand().'.'.$file->getClientOriginalExtension();
         $file->move(public_path('uploads/blog'), $new_name);
         $popup->image = $new_name;
         }
         $popup->popup_disable = $request->popup_disable;
         $popup->offer = $request->offer;
 
         if($popup->save()){
 
 
 
             return back()->with('message','Popup Add/Update Successfully !');
 
 
 
         }
 
 
 
     }


}