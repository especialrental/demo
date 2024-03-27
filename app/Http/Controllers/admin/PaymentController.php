<?php



namespace App\Http\Controllers\admin;



use Illuminate\Http\Request;

use Hash;

use App\Http\Controllers\Controller;

use Validator;
use App\Model\Enquiry;
use App\Model\Payment;
use App\Model\Contact;
use App\Model\Review;
use App\Model\Subscription;
//use Datatables;
use App\Model\Property;

use DB;

use App\Helpers\Common_helper;

use Yajra\DataTables\Facades\DataTables; 



class PaymentController extends Controller

{
	public function payments(){
    	$data['paymentData']  = Payment::paginate(10);
        return view("admin.payments",$data);
    }
    public function index(){
    	$data['bookingData']  = Payment::paginate(10);
        return view("admin.booking",$data);
    }
    public function reviews(){
        $data['reviewData']  = Review::orderBy('id', 'desc')->get();
       return view("admin.reviews-list",$data);
    }
    public function sub_email(){
        $data['emailData']  = Subscription::paginate(10);
       return view("admin.subscription-list",$data);
    }
    public function updatestatus(Request $request){
        //dd($request->rid);
        if($request->rid > 0){
        $data = array('status'=>$request->status);
        //dd($data);
            Review::where('id','=',$request->rid)->update($data);
            return back()->with('message','Status Updated Successfully !');
          }

    }
    public function inquiries(){
    	$data['enquiryData']  = Enquiry::orderBy('id', 'desc')->paginate(10);
       return view("admin.inquiries-list",$data);
    }
    public function contact(){
        $data['contactData']  = Contact::paginate(10);
       return view("admin.Contact",$data);
    }
    public function delete_review(Request $request){
        if($request->id){

            $review =Review::find($request->id);
            $propId = $review->pro_id;

            if($review->delete()){

                if($review){
                    $avg=Review::select('rating_number')->where('pro_id',$propId)->avg('rating_number');
        		    $ratecount = Review::where('pro_id',$propId)->count();
        		    $property=Property::find($propId);
        		    if($property){
            			$property->avg_rating=($avg) ? $avg : 0;
            			$property->rating_counts=($ratecount) ? $ratecount : 0;
            			$property->save();
        		    }
                }
                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }
    public function delete_email(Request $request){
        if($request->id){

            $review =Subscription::find($request->id);

            if($review->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }
    public function delete_enquiry(Request $request){
        if($request->id){

            $enquiry =Enquiry::find($request->id);

            if($enquiry->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }
     public function delete_contact(Request $request){
        if($request->id){

            $enquiry =Contact::find($request->id);

            if($enquiry->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

    public function delete_booking(Request $request){
        if($request->id){

            $enquiry =Payment::find($request->id);

            if($enquiry->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

}