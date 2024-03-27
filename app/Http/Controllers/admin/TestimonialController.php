<?php







namespace App\Http\Controllers\admin;





use App\Model\Testimonial;



use Illuminate\Http\Request;



use Hash;



use App\Http\Controllers\Controller;



use Validator;



//use Datatables;



use DB;



use App\Helpers\Common_helper;



use Yajra\DataTables\Facades\DataTables; 







class TestimonialController extends Controller



{



    public function index(){



        $data['testimonial']=Testimonial::orderBy('id', 'desc')->paginate(10);



       // dd($data);



        return view("admin.testimonial",$data);



    }



    



    /*Country crud*/



    public function edit(Request $request){
       
        if($request->id){



            $country =Testimonial::find($request->id);



            return array('status'=>1,'data'=>$country);



        }else{



            return array('status'=>0,'message'=>'ID Not found !');



        }



        return array('status'=>0,'message'=>'Some Thing Went Wrong!');



    } 



    public function delete(Request $request){



        //return $request->all();



        if($request->id){



            $country =Testimonial::find($request->id);



            if($country->delete()){



                return array('status'=>1,'data'=>'Record Deleted!');



            }else{



                return array('status'=>0,'data'=>'Record Not Deleted!');



            }



        }else{



            return array('status'=>0,'message'=>'ID Not found !');



        }



        return array('status'=>0,'message'=>'Some Thing Went Wrong!');



    }



    public function save(Request $request){

       //dd($request->all());

        $validator =$request->validate(



            array(
                "client_name"=>"required",
            ) 
        );



        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();



        $request->upload_image->move(public_path('images'), $imageName);*/ 



        if($request->tid){



            $testimonial = Testimonial::find($request->tid);



        }



        else{



            $testimonial = new Testimonial;



        }   





        $testimonial->name=$request->client_name;

        $file = $request->file('upload_image');
        if ($file !== null) {
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/testimonial'), $new_name);
        $testimonial->image = $new_name;
        }
        $testimonial->title = $request->title;
        $testimonial->description = $request->description;
        $testimonial->url = $request->url;

        if($testimonial->save()){



            return back()->with('message','Testimonial Add/Update Successfully !');



        }



    }





}



