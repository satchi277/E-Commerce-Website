<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Admin;
use Hash;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.admin_dashboard');
    }
    
    public function settings(){
        /* echo "<pre>"; print_r(Auth::guard('admin')->user()); die; */
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

            /* $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]); */

            /* ---------------- or ---------------- */
            /* customize validate the admin login page */

            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            $customMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'valid email is required',
                'password.required' => 'password is required',
            ];

            $this->validate($request,$rules,$customMessage);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }
            else{
                //For Error Message
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function chkCurrentPassword(Request $request){
        $data= $request->all();
        /* echo "<pre>"; print_r($data); */
/*         echo "<pre>"; print_r(Auth::guard('admin')->user()->password); die; */
        /* echo Auth::guard('admin')->user()->password(); die; */
        if(Hash::check($data ['current_pwd'],Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }
    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */
            //Check If Current Password is Correct
            if(Hash::check($data ['current_pwd'],Auth::guard('admin')->user()->password)){
                //Check if New and Confirm Password is maching
                if($data['new_pwd']==$data['confirm_pwd']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message','Password has been Updated Successfully!');
                } else{
                    Session::flash('error_message','New Password And Confirm Password is Not Match');
                }
        }else{
            Session::flash('error_message','Your Current Password is incorrect');
            }
            return redirect()->back();
        }
    }
}