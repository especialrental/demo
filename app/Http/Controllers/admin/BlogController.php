<?php







namespace App\Http\Controllers\admin;





use App\Model\Blog;
use App\Model\Blog_Comments;



use Illuminate\Http\Request;



use Hash;



use App\Http\Controllers\Controller;



use Validator;



//use Datatables;



use DB;



use App\Helpers\Common_helper;



use Yajra\DataTables\Facades\DataTables; 







class BlogController extends Controller



{


    public function active(Request $request){
        
        
        $user = Blog_Comments::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Status change successfully.']);
        
        
      //return $request->all();
     /* if($request->id){
          Blog_Comments::where('id','=',$request->id)->update(array('status' => $request->commentStatus));
      }
      return array('status'=>1,'message'=>'Status Updated Successfully !');*/
    }

    public function blogComments(){

        

        $data['blog']= Blog_Comments::orderBy('id', 'desc')->paginate(30);
        
       // $data['blog']= Blog_Comments::orderBy('id', 'desc')->groupBy('name')->paginate(30);



       // dd($data);



        return view("admin.blog-comments",$data);



    }
    

    public function index(){



        $data['blog']=Blog::orderBy('id', 'desc')->paginate(30);



       // dd($data);



        return view("admin.blog",$data);



    }



    



    /*Country crud*/



    public function edit_page($id,Request $request){
       
        /*if($request->id){

            $country =Blog::find($request->id);
            return array('status'=>1,'data'=>$country);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');
        }*/
            $data =Blog::find($id);

        return view("admin.edit_blog",compact('data'));
        /*
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
        */


    } 

    public function edit(Request $request){
       
        if($request->id){



            $country =Blog::find($request->id);



            return array('status'=>1,'data'=>$country);



        }else{



            return array('status'=>0,'message'=>'ID Not found !');



        }



        return array('status'=>0,'message'=>'Some Thing Went Wrong!');



    } 



    public function delete(Request $request){



        //return $request->all();



        if($request->id){



            $country =Blog::find($request->id);



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
                "heading"=>"required",
                "short_content"=>"required",
                "description"=>"required",
                "posted_by"=>"required",
                "metatag"=>"required",
                "meta_description"=>"required",
                //'upload_image' => 'required',
            ) 
        );



        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();



        $request->upload_image->move(public_path('images'), $imageName);*/ 



        if($request->id){



            $blog= Blog::find($request->id);



        }



        else{



            $blog = new Blog;



        }   





        $blog->heading = $request->heading;

        $file = $request->file('upload_image');
        if ($file !== null) {
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/blog'), $new_name);
        $blog->pic = $new_name;
        }
        $blog->short_content = $request->short_content;
        $blog->description = $request->description;
        $blog->url = $request->url;
        $blog->posted_by = $request->posted_by;
        $blog->metatag = $request->metatag;
        $blog->meta_description = $request->meta_description;

        if($blog->save()){



            return back()->with('message','Blog Add/Update Successfully !');



        }



    }





}



