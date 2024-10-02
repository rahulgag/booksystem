<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;
use Hash;
use Auth;
use DB;
use App\Models\Appointment;

class Usercontrtoller extends Controller
{
     public function userregisterget()
    {
        if (Auth::guard('employe')->check()) {
            return redirect()->route('book.list');
        }
        return view ("user.userregister");
    }
     public function userregistersign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|digits:10|numeric|unique:employe',
            'emails' => 'required|email|unique:employe',
            'passwordata' => 'required|string|min:6',
        ], 
        [
            'name.required' => 'Please enter your complete name.',
            'mobile_number.digits' => 'Mobile number must be 10 digits.',
            'mobile_number.numeric' => 'Mobile number must be numeric.',
            'mobile_number.unique' => 'Mobile number is already taken.',
            'emails.required' => 'Please enter your email.',
            'emails.email' => 'Please enter a valid email address.',
            'emails.unique' => 'Email is already taken.',
            'passwordata.required' => 'Please enter your password.',
            'passwordata.min' => 'Password must be at least 6 min characters.',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(['status' => 433, 'errors' => $errors]);
        }
        $user = new EmployeModel();
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->passwordata);    
        $user->emails = $request->emails;
        $user->save();
        if ($user) {
            return response()->json(['status' => 200, 'msg' => 'Submit successful']);
        } else {
            return response()->json(['status' => 422, 'msg' => 'Something went wrong!']);
        }
    }
     public function userlogin()
    {
          if (Auth::guard('employe')->check()) {
            return redirect()->route('app-list');
        }
        return view ("user.userlogin");
    }
    public function userauth(Request $req)
{
    $validator = Validator::make($req->all(), [
        'emails' => 'required',
        'passwordata' => 'required',
    ], 
    [
        'emails.required' => 'Please enter your email.',
        'passwordata.required' => 'Please enter your password.',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors()->toArray();
        return response()->json(['status' => 433, 'errors' => $errors]);
    }

    $input = $req->all();
    if (Auth::guard('employe')->attempt(['emails' => $input['emails'], 'password' => $input['passwordata']])) {
        return response()->json(['status' => 200, 'msg' => 'Login successful']);
    } else {
        return response()->json(['status' => 422, 'msg' => 'Invalid email or password']);
    }
}
     public function userlogout()
    {
          Auth::guard('employe')->logout();
    return response()->json(['status' => 200, 'message' => 'Logout successful']);
    }

     public function doctorregisterget()
    {
        if (Auth::guard('doctor')->check()) {
            return redirect()->route('doctor.dashboard');
        }
        return view ("doctor.doctorregister");
    }

      public function doctorregistersign(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|digits:10|numeric|unique:doctor',
            'emails' => 'required|email|unique:doctor',
            'passwordata' => 'required|string|min:6',
        ], 
        [
            'name.required' => 'Please enter your complete name.',
            'mobile_number.digits' => 'Mobile number must be 10 digits.',
            'mobile_number.numeric' => 'Mobile number must be numeric.',
            'mobile_number.unique' => 'Mobile number is already taken.',
            'emails.required' => 'Please enter your email.',
            'emails.email' => 'Please enter a valid email address.',
            'emails.unique' => 'Email is already taken.',
            'passwordata.required' => 'Please enter your password.',
            'passwordata.min' => 'Password must be at least 6 min characters.',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(['status' => 433, 'errors' => $errors]);
        }
        $user = new Doctor();
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->passwordata);    
        $user->emails = $request->emails;
        $user->save();
        if ($user) {
            return response()->json(['status' => 200, 'msg' => 'Submit successful']);
        } else {
            return response()->json(['status' => 422, 'msg' => 'Something went wrong!']);
        }
    }
     public function doctorlogin()
    {
          if (Auth::guard('doctor')->check()) {
            return redirect()->route('list-appo');
        }
        return view ("doctor.doctorlogin");
    }
     public function doctorauth(Request $req)
{
    $validator = Validator::make($req->all(), [
        'emails' => 'required',
        'passwordata' => 'required',
    ], 
    [
        'emails.required' => 'Please enter your email.',
        'passwordata.required' => 'Please enter your password.',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors()->toArray();
        return response()->json(['status' => 433, 'errors' => $errors]);
    }

    $input = $req->all();
    if (Auth::guard('doctor')->attempt(['emails' => $input['emails'], 'password' => $input['passwordata']])) {
        return response()->json(['status' => 200, 'msg' => 'Login successful']);
    } else {
        return response()->json(['status' => 422, 'msg' => 'Invalid email or password']);
    }
}
public function doctordashboard()
{
    return view('doctor.dashboard');

}
public function doctorlogout()
{
        Auth::guard('doctor')->logout();
    return response()->json(['status' => 200, 'message' => 'Logout successful']);

}
public function finddoctor()
{
    $data = DB::table('doctor')->get();
    return view('doctor.find-doctor',compact('data'));
}
public function dochistory()
{
    $appointments = Appointment::where('doctor_id',  auth('doctor')->user()->id)
                    ->whereIn('status', ['accepted', 'rejected'])
                    ->get();
    return view('doctor.history', compact('appointments'));
}
public function applist()
{
     $appointments = Appointment::where('patient_id',auth('employe')->user()->id) 
                    ->whereIn('status', ['accepted', 'rejected']) 
                    ->get();

    return view('user.history', compact('appointments'));
}

  
}
