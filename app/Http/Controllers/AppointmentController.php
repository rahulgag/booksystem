<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;



class AppointmentController extends Controller
{
   
    public function bookdetail(Request $request)
    {
          $doctorId = $request->did;
        $schedules = Schedule::where('doctor_id', $doctorId)->where('is_available', true)->get();
        return view('doctor.appointments', compact('schedules', 'doctorId'));


    }
     public function bookdoc(Request $request)
{
    $docid = $request->did;
    
    $validator = Validator::make($request->all(), [
        'schedule_id' => 'required|exists:schedules,id',
    ], [
        'schedule_id.required' => 'Please select schedule.',
        'schedule_id.exists' => 'Schedule does not exist.',
    ]);
    
    if ($validator->fails()) {
        $errors = $validator->errors()->toArray();
        return response()->json(['status' => 422, 'errors' => $errors]);
    }

    $schedule = Schedule::find($request->schedule_id);
    $existingAppointment = Appointment::where('schedule_id', $request->schedule_id)
                                      ->where('status', '!=', 'rejected')
                                      ->first();

    if ($existingAppointment) {
        return response()->json(['status' => 500, 'msg' => 'Selected time slot is already booked.']);
    }
    if ($schedule->is_available) {
        $Book = new Appointment();
        $Book->doctor_id = $docid;
        $Book->patient_id = auth('employe')->user()->id;
        $Book->schedule_id = $request->schedule_id;
        $Book->status = 'pending'; // New appointment is pending
        $Book->save();

        return response()->json(['status' => 200, 'msg' => 'Appointment booked successfully']);
    } else {
        return response()->json(['status' => 500, 'msg' => 'Selected time slot is no longer available.']);
    }
}
public function accept($appointmentId)
    {
       
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'accepted';
        $appointment->save();

        // Make the schedule unavailable for others
        $schedule = Schedule::find($appointment->schedule_id);
        $schedule->is_available = false;
        $schedule->save();

        return redirect()->back()->with('success', 'Appointment accepted and time slot is now unavailable!');
    }

    public function reject($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'rejected';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment rejected.');
    }

}
