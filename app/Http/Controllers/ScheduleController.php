<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Schedule;
use Hash;
use Auth;
use App\Models\Appointment;
use App\Models\Doctor;



class ScheduleController extends Controller
{
       public function createappo()
    {
        return view('doctor.schedules.create');
    }
      public function Insertappo(Request $request)
    {
           $validator = Validator::make($request->all(), [
             'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ], 
        [
            'day.required' => 'Please enter your day .',
            'start_time.required' => 'Please enter your start time.',
            'end_time.required' => 'Please enter a end time.',
            'end_time.after' => 'start date precvius date select.',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(['status' => 433, 'errors' => $errors]);
        }
        $schedule = new Schedule();
        $schedule->doctor_id = auth('doctor')->user()->id;
        $schedule->day =$request->day;
        $schedule->start_time = $request->start_time;    
        $schedule->end_time = $request->end_time;
        $schedule->is_available = true;
        $schedule->save();
        if ($schedule) {
            return response()->json(['status' => 200, 'msg' => 'Submit successful']);
        } else {
            return response()->json(['status' => 422, 'msg' => 'Something went wrong!']);
        }
    }
    public function Listappo()
    {
        $appointments = Appointment::where('doctor_id', auth('doctor')->user()->id)->where('status', 'pending')->get();
       
        return view('doctor.pendingappointments', compact('appointments'));
    }
     public function listusers()
    {
        return view('doctor.users');
    }
     public function listdata(Request $request)
    {
         $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
         $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        $user_total = $this->get_user_data(false, $search_term, $other_configs);
        $user_count = $this->get_user_data(true, $search_term, $other_configs);
        // print_r($user_total);die();
        $data = array();
        foreach($user_total as $row => $vals) {
           
            $nestedData = array();
            
            $nestedData[] = $vals->name;
            $nestedData[] = $vals->emails ;
            $nestedData[] = $vals->mobile_number;
            
            $data[] = $nestedData;
        }
         $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $user_count,
            'recordsFiltered' => $user_count,
            'data' => $data,
        );

        echo json_encode($output);
        
    }
    	
	
	public function get_user_data($count, $search_term = '', $other_configs)
	{
        $result = [];
        if(isset($search_term) && $search_term !="") {
            // $data = DB::table('ordered_products as op')
            //     ->where(function($query) use ($search_term, $other_configs){
            //         $query->where('orderid', $search_term);
            //         $query->orwhere('op.product_title', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.product_sku', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.order_accept_date', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.quantity', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.cost', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.vendorname', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.buyer_name', 'like', '%' . $search_term . '%');
            //         $query->orwhere('op.entry_by', 'like', '%' . $search_term . '%');
            //     })
            //     ->select('op.*')
            //     ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
            //     ->where('op.status','=','processing')
            //     ->orderBy('op.order_accept_date','desc');
                
            //     if(!$count && $other_configs['length']){
            //         $data->limit($other_configs['length']);
            //         $data->offset($other_configs['offset']);
            //     }
                
            //     $result = $data->get();
        }else{
           $data =  Doctor::select('name', 'emails', 'mobile_number')
            ->distinct();
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        
        if($count){
            return count($result);
        }else{
            return $result;
        }
	    
	}
	
    
    
}
