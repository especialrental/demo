          <?php
           function GetDays($sStartDate, $sEndDate){  

              // Firstly, format the provided dates.  

              // This function works best with YYYY-MM-DD  

              // but other date formats will work thanks

              // to strtotime().  

              $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  

              $sEndDate = gmdate("Y-m-d", strtotime($sEndDate)); 

              // Start the variable off with the start date  

             $aDays[] = gmdate("m-d-Y", strtotime($sStartDate)); 
             // Set a 'temp' variable, sCurrentDate, with  

             // the start date - before beginning the loop  

             $sCurrentDate = $sStartDate;  
             // While the current date is less than the end date  

             while($sCurrentDate < $sEndDate){
               // Add a day to the current date  

               $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
               // Add this new day to the aDays array  
               $date = DateTime::createFromFormat('Y-m-d', $sCurrentDate);
               $nice_date = $date->format('m-d-Y');
               $aDays[] = $nice_date; 

             }

             // Once the loop has finished, return the  

             // array of days.  

             return $aDays;  

           }   
          
           if(isset($events) && !empty($events)){  
                foreach($events as $eve){ 

               $sdate = DateTime::createFromFormat('Y-m-d', $eve->start_date);
               $start_dates = $sdate->format('m-d-Y');
              $edate = DateTime::createFromFormat('Y-m-d', $eve->end_date);
               $end_dates = $edate->format('m-d-Y');      
              
              @$start[] = $start_dates;
              
              @$end[] = $end_dates;
               
             @$ful[] = GetDays($eve->start_date, $eve->end_date);
             //dd($ful);
           }

           if(@$ful!="" ){
            foreach($ful as $val)

            {
                array_shift($val);

                array_pop($val);

                @$kd[] = $val;
           
              //$array ='';
              $array  = @$kd;
              $full = Arr::flatten($array);

              @$s_count = count($start);

              @$e_count = count($end);

              @$f_count = count($full);
               }

            }

             }
           ?>      
          <?php
            $a ="<div class='success-msg' style='display:none'></div>";
            echo $a;
            // for first table

            $month=date("n");

            $year=date("Y");


            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $currentTimeStamp = strtotime("$year-$month-$day");

            $monthName = date("F", $currentTimeStamp);
            $numDays = date("t", $currentTimeStamp);
            $counter = 0;

          ?>
          <input type="hidden" id="prop_id" name="prop_id" value="">
          @php $event = (isset($events->id))? $events->id :0
          @endphp
          <input type="hidden" name="events" id="events" value="{{$event}}">
          <div class="row">
             <div class="cal_details">
              <ul style="display: inline-flex;">
                <li>Current Date <img src="{{url('/')}}/public/calender/images/current_date.png" alt="am"></li>
                <li>Start Date <img src="{{url('/')}}/public/calender/images/pm.png" alt="am"></li>
                <li>End Date <img src="{{url('/')}}/public/calender/images/am.png" alt="pm"></li>
                <li>Booked <img src="{{url('/')}}/public/calender/images/full_book.png" alt="full Book"></li>
              </ul>
            </div>
            <div id="next-prev" class="prev-next">
            <div class="col-xs-6 width2">
              <div class="leftButton">
                @php $propId = (isset($propertyId))? $propertyId :0
                
                @endphp

                <button type="button" name="prev-button" id="pp" onClick="goLastMonth(<?php echo $month.",".$year.",".$propId ?>)" > <i aria-hidden="true" class="fa fa-arrow-left"></i> Previous Months </button>
              </div>
            </div>
            <!-- <div class="col-xs-4 remove_tab width2" align="center">
            <a class='' href='javascript:' ><button type="button">Refresh Calendar</button></a>
            </div> -->
            <div class="col-xs-6 width2 rightButton">
              @php $propId = (isset($propertyId))? $propertyId :0
                @endphp
              <button type="button" name="next-button" id="tt" onClick="goNextMonth(<?php echo $month.",".$year.",".$propId ?>)">Next Months <i aria-hidden="true" class="fa fa-arrow-right"></i></button>
            </div>
            <div style="clear:both;"></div>
            </div>

            <!-- <div id='spinner1' class="spinner"><img src="{{url('/')}}/public/calender/images/spinner.gif" class='out'/></div>
            <div id='spinner2' class="spinner"><img src="{{url('/')}}/public/calender/images/spinner.gif" class='out' /></div> -->
            
            
            <div class="container width3" id="call-box-s">
      <?php //--------- First and Second Table Starts -----------// ?>
      <div class="tabl" id="tabl">
        <div class="row">
      <div class="tabl_1 col-xs-6 width2">
          <table id="table-1">
            <tr class="hea">
              <td><div class="cell"></div></td>
              <td class="cell5" id="nn"><?php echo $monthName.", ".$year ;?></td>
              <td><div class="cell"></div></td>
            </tr>
            <tr class="day_name">
              <td><div class="cell">Sun</div></td>
              <td><div class="cell">Mon</div></td>
              <td><div class="cell">Tues</div></td>
              <td><div class="cell">Wed</div></td>
              <td><div class="cell">Thu</div></td>
              <td><div class="cell">Fri</div></td>
              <td><div class="cell">Sat</div></td>
            </tr>
            <?php
      echo "<tr>";
        for($i=1; $i < $numDays+1; $i++, $counter++)
          {
            $timeStamp = strtotime("$year-$month-$i");
            if($i==1)
            {
              $firstDay = date("w", $timeStamp);
            for($j=0; $j < $firstDay; $j++, $counter++)
            {
          //blank space
              echo "<td><div class='cell'></div></td>";
            }
            }
           if($counter%7 == 0)
            {
             echo "</tr><tr>";
            }
            $monthstring = $month;
            $monthlength = strlen($monthstring);
            $daystring = $i;
            $daylength = strlen($daystring);
            if($monthlength <= 1)
            {
            $monthstring = "0".$monthstring;  
            }
            if($daylength <= 1)
            {
            $daystring = "0".$daystring;  
            }

            $todaysDate = date("m-d-Y");
            $bookdate = $monthstring."-".$daystring."-".$year;
            $format = "m-d-Y";
             $date1  = DateTime::createFromFormat($format, $todaysDate);
             $date2  = DateTime::createFromFormat($format, $bookdate);
            echo "<td ";
            if($date2 < $date1)
            {
              echo "class='before-today' id='".$bookdate."'";
            }
            elseif($todaysDate==$bookdate)
            {
              echo "class='today' id='".$bookdate."'";
            }
            else
            {
              echo "class='booking-box' id='".$bookdate."'";
            }

            echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."</div>";
              //dd($start);
          if(isset($start)){
              
              for($k=0;$k<$s_count;$k++)
              {
                if($start[$k]==$bookdate)
                  {

                      echo "<div class='first-half-book'><img src='".url('/public/calender/img/left.png')."' /></div>";

                  }

              }    

        }

      if(isset($full)){

        for($l=0;$l<$f_count;$l++)

        {

          if($full[$l]==$bookdate)

            {

                echo "<div class='full-book'><img src='".url('/public/calender/img/full.png')."'/></div>";

            }
        }

        }
         
         if(isset($end)){

        for($m=0;$m<$e_count;$m++)
        {

          if($end[$m]==$bookdate)

            {

                echo "<div class='last-half-book'><img src='".url('/public/calender/img/right.png')."'/></div>";

            }
        }    

        }
      echo "</td>";

    }

echo "</tr>";

?>
    </table>
  </div>
<?php

// for second table

$date = date("Y-m-d");
$month = date("n", strtotime($date ."first day of +1 month"));
//dd($month);

if($month==1)
{
  $year=date('Y', strtotime('+1 year'));
}
else
{
  $year=date('Y');  
}

// Calender Variable

$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
//dd($month);
$currentTimeStamp = strtotime("$year-$month-$day");

$monthName = date("F", $currentTimeStamp);

$numDays = date("t", $currentTimeStamp);

$counter = 0;
?>
<div class="tabl_2 col-xs-6 width2">

<table id="table-2">
<tr class="hea">

  <td><div class="cell"></div></td>

  <td class="cell5"><?php echo $monthName.", ".$year ;?></td>

    <td><div class="cell"></div></td>

</tr>

<tr class="day_name">
<td><div class="cell">Sun</div></td>
<td><div class="cell">Mon</div></td>
<td><div class="cell">Tues</div></td>
<td><div class="cell">Wed</div></td>
<td><div class="cell">Thu</div></td>
<td><div class="cell">Fri</div></td>
<td><div class="cell">Sat</div></td>
</tr>

<?php
echo "<tr>";
for($i=1; $i < $numDays+1; $i++, $counter++)

    {
      $timeStamp = strtotime("$year-$month-$i");
      if($i==1)
      {
        $firstDay = date("w", $timeStamp);
      for($j=0; $j < $firstDay; $j++, $counter++)
      {
        //blank space
        echo "<td><div class='cell'></div></td>";
      }
      }
     if($counter%7 == 0)
      {
       echo "</tr><tr>";
      }
      $monthstring = $month;
      $monthlength = strlen($monthstring);
      $daystring = $i;
      $daylength = strlen($daystring);
      if($monthlength <= 1)
      {
      $monthstring = "0".$monthstring;  
      }
      if($daylength <= 1)
      {
      $daystring = "0".$daystring;  
      }
      $todaysDate = date("m-d-Y");



     $bookdate = $monthstring."-".$daystring."-".$year;



      $format = "m-d-Y";
       $date1  = DateTime::createFromFormat($format, $todaysDate);
       $date2  = DateTime::createFromFormat($format, $bookdate);
       echo "<td ";
      if($date2 < $date1)
      {

        echo "class='before-today' id='".$bookdate."'";
      }
      elseif($todaysDate==$bookdate)
      {
        echo "class='today' id='".$bookdate."'";
      }
      else
      {
        echo "class='booking-box' id='".$bookdate."'";
      }
      echo "><div class='ac cell' id='book-".$bookdate."' data-theme='div' data-seq='".$bookdate."' href=''>".$i."</div>";
     if(isset($start)){
        for($k=0;$k<$s_count;$k++)
        {
          if($start[$k]==$bookdate)
            {
            echo "<div class='first-half-book'><img src='".url('/public/calender/img/left.png')."' /></div>";
            }
        }    
        }
        if(isset($full)){
        for($l=0;$l<$f_count;$l++)
        {
          if($full[$l]==$bookdate)
            {
                echo "<div class='full-book'><img src= '".url('/public/calender/img/full.png')."'/></div>";
            }
        }    
        }
         if(isset($end)){
        for($m=0;$m<$e_count;$m++)
        {
          if($end[$m]==$bookdate)
            {
                echo "<div class='last-half-book'><img src= '".url('/public/calender/img/right.png')."' /></div>";
            }
        }
        }
      echo "</td>";
          }
      echo "</tr>";
      ?>
      </table>
      </div>
    </div>
      </div>
      <?php //--------- First and Second Table Ends -----------// ?>
      </div>
      <div id="demo" style="display:none"></div>
      <div class="table-responsive">
        <table class="table table-striped table-hover bg-clr22" id="hcal" align="center">
          <thead>
            <tr>
              <th>Check In</th>
              <th>Check Out</th>
              <th>Booking Date</th>
              <th>Delete</th>
            </tr>
          </thead>
          
          <tbody>

           @php if(isset($events) && !empty($events))  
                foreach($events as $eve){ @endphp
            <tr>
             <td >{{$eve->start_date}}</td>
             <td >{{$eve->end_date}}</td>
             <td>{{date_format($eve->updated_at,"m-d-Y")}}</td>
             <td><button type="button" class="editdbcal" data-id="{{$eve->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button><button type="button" class="delete_db_cal" data-id="{{$eve->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
             </tr>
             @php }
           @endphp        
          </tbody>
         </table>
        </div>
  <div class="modal fade" id="my-form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label=""><span>&times;</span></button>
          <h4 class="modal-title">Signup</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-md-4 col-md-offset-1">Name</label>
              <div class="col-md-5">
                <input type="text" class="form-control input-sm" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-5">
                <input type="button" class="form-control input-sm" />
              </div>
            </div>
            <div class="modal-footer"> </div>
          </form>
        </div>
      </div>
    </div>
  <div id="dialog" class="ui-dialog" title="Basic dialog">
    
        <div class="form-group">
          <label class="col-md-4 col-md-offset-1">First date</label>
            <div class="col-md-8">
              <input type="text" name="first" id="first-date" class="datepicker1" readonly/>
            </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 col-md-offset-1">Last date</label>
            <div class="col-md-8">
              <input type="text" name="last" id="last-date" class="datepicker1" readonly/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-center">
              <input type="hidden" name="id" value="<?php /*echo $myVar*/ ?>"  />
              <input type="button" name="book-sub" id="book-sub" class="form-control input-sm" value="Book" />
            </div>
        </div>
    </div>

  </div>

  <div id="my-cal" class="modal fade" role="dialog">

      <div class="modal-dialog">                                     

        <!-- Modal content-->

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">×</button>

            <h4 class="modal-title">Update Calendar</h4>

          </div>

          <div class="modal-body">
                
                <input type="hidden" name="propertyRates" id="calid" value=""> 
                
                 <div class="form-group">
                 <label class="col-md-4 col-md-offset-1">Start Date</label>
                <input type="date" name="start" id="ustart" value=""> </div> 

                
                 <div class="form-group">
                 <label class="col-md-4 col-md-offset-1">End Date</label>
                <input type="date" name="start" id="uend" value=""> </div>

                 <button type="button" data-dismiss="modal" id="update_cal" class="btn btn-primary update_cal">Save</button>      
                 

          </div>

         

        </div>

    

      </div>

  </div>

          <!-- /.row -->

