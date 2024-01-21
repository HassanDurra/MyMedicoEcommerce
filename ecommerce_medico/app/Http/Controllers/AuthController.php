<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Carbon\Carbon;
use Mail;
class AuthController extends Controller
{
        public $parentModel = User::class;

        public function admin_login(){
            return view("Admin.Auth.login");
        }
        public function admin_register(){
            return view('Admin.Auth.register');
        }
        public function login(Request $request){
            $email     = $request->email;
            $password  = $request->password;
            $checkLogin = $this->parentModel::where('email' , $email)->first();

            if($checkLogin == true && Hash::checK($password , $checkLogin->password)){
                if($checkLogin->email_verified_at != null){
                    if($checkLogin->role == 1){
                        session()->put("admin" , $checkLogin);
                        return redirect()->route('admin.dashboard');
                    }
                    if($checkLogin->role == 0){
                        session()->put("user" , $checkLogin);
                        return redirect()->route('home');
                    }
                }
                else{
                return redirect()->back()->with("error" , 'Please verify your email address..! Check Your email. ');
                }
            }
            else{
                return redirect()->back()->with("error" , 'Invalid Credentials');
            }


        }
        // Registeration function
        public function register(Request $request){
            $image      = null ;
            $username   = $request->username;
            $email      = $request->email;
            $password   = $request->password;
            $role       = $request->role;
            // Email Validation
            $checkEmail = $this->parentModel::where('email' , $email)->first();
            if($checkEmail != null){
                return redirect()->back()->with("error" ,'Email Already Exists..!');
            }

            if($request->hasFile('image')){
                $image = time().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('UserImages/' , $image);
                $image = asset('UserImages/'. $image );
            }
            $RegisterUser = $this->parentModel::create([
                'image'    => $image ,
                'name'     => $username ,
                'email'    => $email,
                'password' => Hash::make($password) ,
                'role'     => $role
            ]);
            if($RegisterUser){
                // Sending Mails For Verification
                $emailData =[
                    'to' => $email ,
                    'from' => env('MAIL_FROM_ADDRESS') ,
                    'subject' => 'Email Verification'];
                $route         = Route('auth.email.verify' , $RegisterUser->id);
                $sendEmail     = Mail::send('EmailTemplates.email_verification' , ['verificationRoute' => $route], function($message) use ($emailData){
                    $message->to($emailData['to']);
                    $message->from($emailData['from']);
                    $message->subject($emailData['subject']);
                });
                if($role == "1"){
                    return redirect(route('admin.login.view'))->with('success' , 'Registeration SuccessFull ..! Please Verify your email check your inbox.');
                }
                if($role == "0"){
                    return redirect(route('user.login.view'))->with('success' , 'Registeration SuccessFull ..! Please Verify your email check your inbox.');
                }
            }
            else{
                return redirect(route('user.login.view'))->with('error' , 'Failed to save your information..!');
            }
        }

        //
        public function verify_email_address($id = null){
            $userData = $this->parentModel::where('id' , $id)->first();
            $verify   = $this->parentModel::where('id' , $id)->update([
                'email_verified_at' => Carbon::now()
            ]);
            if($verify){
                // Sending Mails For Verification

                if($userData->role == 1){
                    return redirect(route('admin.login.view'))->with('success' , 'Your email has been Verified.');
                }
                if($userData->role == 0){
                    return redirect(route('user.login.view'))->with('success' , 'Your email has been Verified.');
                }
            }
        }

        // Logout Function
        public function admin_logout(){
        session()->forget('admin');
        return redirect(route('admin.login.view'));
        }
        public function user_logout(){
        session()->forget('user');
        return redirect(route('user.login.view'));
        }

}
