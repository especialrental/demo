@extends('admin.layouts.admin')

@section('content')



    <!-- Content Wrapper. Contains page content -->

 

    <div class="content-wrapper" style="min-height: 505px;">

      <section class="content-header">

            <div class="pull-left">

             <div id="message"></div>

            </div> 

            @if(Session::get('message'))

            <h4 class="pull-left alert alert-success">{{Session::get('message')}}</h4>

            @endif

            @if ($errors->any())

              <div class="alert alert-danger col-md-6">

                  <ul>

                      @foreach ($errors->all() as $error)

                          <li>{{ $error }}</li>

                      @endforeach

                  </ul>

              </div>

            @endif

        </section>
        <!-- Content Header (Page header) -->



        <span style="color:red;"> </span>

        <section class="content">

            <div class="row">

                <div class="col-md-12" >

                    <div class="box box-info">

                        <div class="box-header">

                            <h3 class="box-title">Property location

                            </h3>

                        </div>

                        <!-- /.box-header -->

                        <div class="box-body pad">
                         <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/journey/save')}}" enctype = "multipart/form-data">
                             @csrf
                             @php $jid = isset($journey->id)? $journey->id : 0 ; @endphp
                             <input type="hidden" name="jId" value="{{$jid}}">
                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label>City</label>
                                    @php $cityData= \App\Model\City::get(); @endphp
                                    <select class="form-control" id="city" data-live-search="false" name="name" >
                       
                                      <option value="">Select City</option>
       
                                      @foreach($cityData as $city)

                                        @php $selected = (isset($journey->city)) ? (($journey->city == $city->id) ? 'selected' : '') : ''; @endphp

                                        <option value="{{ $city->id }} "{{$selected}}>{{ $city->city_name }}</option>

                                      @endforeach

                                      </select>

                                </div>

                                <div class="form-group">
                                  <label for="upload_image">Image</label>
								  <!-- <div class="input-group">
									<input class="form-control">
									<span class="input-group-addons" style="padding:0px;"><button class="btn btn-light">Choose Image</button></span>
								  </div> -->
                                  <input type="file" class="form-control" id="upload_image" name="upload_image" required="">
                                  <div class="invalid-feedback">
                                      Please provide a valid image.
                                  </div>
                                </div>  
                               <button type="submit" class="btn btn-info pull-right">Submit</button> 
                            </div>
                         </form>
                        </div>

                    </div>

                </div>

                <!-- /.col-->

            </div>

            <!-- ./row -->

         </section>



 <script>



    $(document).ready(function(){



      var token="{{csrf_token()}}";



      var url="{{url('admin')}}";



      $('.editArea').click(function(){



        console.log($(this).attr('data-id'));



        var id=$(this).attr('data-id');



        var data={_token:token,id:id};



        $.ajax({



          url:url+'/destination/edit-area',



          data:data,



          method:'POST',



          success:function(data,status,xhr){



            console.log(data);



            if(data.status==1){



              var value=data.data;



              $('#editarea').html('');



              $('#editarea').html(data.data);







                $('#areaModal').modal();



            }







          },



          failure:function(status){



            console.log(status);



          }



        });



      });



      $('.deleteArea').click(function(){



        console.log($(this).attr('data-id'));



        var id=$(this).attr('data-id');



        var data={_token:token,id:id};



        var status=confirm('Are Want to Delete This Record!');



          if(!status){



            return false;



          }



        $.ajax({



          url:url+'/destination/delete-area',



          data:data,



          method:'POST',



          success:function(data,status,xhr){



            console.log(data);



            if(data.status==1){



              $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');



            }







          },



          failure:function(status){



            console.log(status);



          }



        });



      });



    });



  </script>



  <script src="{{url('public')}}/customjs/admin.js"></script>



@endsection