<?php

namespace App\Http\Controllers;

use App\Mail\customerRegConfirmation;
use App\Models\Customer;
use App\Models\Token;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function customerCreate(){
        return view('customer.authentication.registration');
    }
    public function customerCreateSubmit(Request $request){

      $validate = $request->validate([
            "name"=>"required",
            'dob'=>'required|date',
            'email'=>'required|email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
            'address'=>'required',
            'username'=>'required|min:5',
            'password'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg'
        ],
        ['password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special charactee, 1 numbers"]
    );
    $rating = 0;
    $ErrorMsg = "User name doesn't exist";


    $userCheck = Customer::where('username',$request->username)->first();
    if($userCheck){

        return redirect()->back()->with('failed', 'Username already exist');
    }
    else{
        $emailCheck = Customer::where('email',$request->email)->first();
        if($emailCheck){
            return redirect()->back()->with('failed', 'Email already exist');
        }
        else{

        $nameImage = $request->file('image')->getClientOriginalName();
        $folder = $request->file('image')->move(public_path('customer_image').'/',$nameImage);

      $customer = new Customer();
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->password = md5($request->password);
        $customer->rating = $rating;
        $customer->image = $nameImage;
        $customer->discount = 0;
        $customer->status = "0";
        $code = rand(1000,9000);
            $details = [
                'title' => 'Registration Confirmation',
                'code' => $code
            ];
            $customer->otp = $code;

            Mail::to($request->email)->send(new customerRegConfirmation($details));
        $result = $customer->save();

        if($result){

            //$image->storeAs('public/images',$nameImage);
            return redirect()->back()->with('success', 'Registration Done successfully. An otp already send in your email.');
        }
        else{
            return redirect()->back()->with('failed', 'Registration Failed');
        }
    }
    }

    }

    public function CustomerRegistrationApi(Request $request){

    $rating = 0;
    $ErrorMsg = "User name doesn't exist";


    $userCheck = Customer::where('username',$request->username)->first();
    if($userCheck){

        //return redirect()->back()->with('failed', 'Username already exist');
        return response()->json([
            'message'=>'Username already exist'
        ]);
    }
    else{
        $emailCheck = Customer::where('email',$request->email)->first();
        if($emailCheck){
            //return redirect()->back()->with('failed', 'Email already exist');
            return response()->json([
                'message'=>'Email already exist'
            ]);
        }
        else{

       /* $nameImage = $request->file('image')->getClientOriginalName();
        $folder = $request->file('image')->move(public_path('customer_image').'/',$nameImage);*/




      $customer = new Customer();
        $customer->name = $request->name;
        $customer->dob = $request->dob;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->password = md5($request->password);
        $customer->rating = $rating;
        $customer->image ="profile.jpg";
        $customer->discount = 0;
        $customer->status = "0";
            $code = rand(1000,9000);
            $details = [
                'title' => 'Registration Confirmation',
                'code' => $code
            ];
            $customer->otp = $code;

            Mail::to($request->email)->send(new customerRegConfirmation($details));
        $result = $customer->save();

        if($result){

            //$image->storeAs('public/images',$nameImage);
            //return redirect()->back()->with('success', 'Registration Done successfully');
            return response()->json([
                'message'=>'Registration Successful. An otp send in your Email.'
            ]);
        }
        else{
            //return redirect()->back()->with('failed', 'Registration Failed');
            return response()->json([
                'message'=>'Registration Failed'
            ]);
        }
    }
    }
    }

    public function customerLoginSubmit(Request $request){
        $validate = $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]
    );

    $loginCheck = Customer::where('username',$request->username)->where( 'password',md5($request->password))->first();

    if($loginCheck){
        $request->session()->put('id',$loginCheck->id);
        $request->session()->put('name',$loginCheck->name);
        $request->session()->put('dob',$loginCheck->dob);
        $request->session()->put('phone',$loginCheck->phone);
        $request->session()->put('address',$loginCheck->address);
        $request->session()->put('customer_username',$loginCheck->username);
        $request->session()->put('email',$loginCheck->email);
        $request->session()->put('password',$loginCheck->password);
        $request->session()->put('image',$loginCheck->image);
        $request->session()->put('rating',$loginCheck->rating);

        if($loginCheck->status === "0"){
            return  redirect()->route('customerOtp');
        }
        else{
            return  redirect()->route('customerDash');
        }

    }
    else{
        return redirect()->back()->with('failed', 'Invalid username or password');
    }
    }

    public function customerLoginSubmitApi(Request $request){

    $loginCheck = Customer::where('username',$request->username)->where( 'password',md5($request->password))->first();

    if($loginCheck){
        $request->session()->put('id',$loginCheck->id);
        $request->session()->put('name',$loginCheck->name);
        $request->session()->put('dob',$loginCheck->dob);
        $request->session()->put('phone',$loginCheck->phone);
        $request->session()->put('address',$loginCheck->address);
        $request->session()->put('customer_username',$loginCheck->username);
        $request->session()->put('email',$loginCheck->email);
        $request->session()->put('password',$loginCheck->password);
        $request->session()->put('image',$loginCheck->image);
        $request->session()->put('rating',$loginCheck->rating);
            $api_token = Str::random(64);
            $token = new Token();
            $token->userid = $loginCheck->id;
            $token->token = $api_token;
            date_default_timezone_set('Asia/Dhaka');
            $time =  date('d F Y, h:i:s A');
            $token->created_at = $time;
            $token->save();

        //return  redirect()->route('customerDash');
        return response()->json([
            'message'=>'Login successful',
            'token'=>$token
        ]);
    }
    else{
        //return redirect()->back()->with('failed', 'Invalid username or password');
        return response()->json([
            'message'=>'Login Failed'
        ]);
    }
    }

    public function logout(){
        session()->forget('id');
        session()->forget('name');
        session()->forget('dob');
        session()->forget('phone');
        session()->forget('address');
        session()->forget('customer_username');
        session()->forget('email');
        session()->forget('password');
        session()->forget('image');
        session()->forget('rating');
        return redirect()->route('customerLogin');
    }


    public function otp(Request $request){
        $validate = $request->validate([
            'otp'=>'required',

        ]
    );

    $user = Customer::where('username',session()->get('customer_username'))->first();

    if($user->otp === $request->otp){
        $user->status = "1";
        $user->otp = "";
        $user->save();
        return  redirect()->route('customerDash');
    }
    else{
        return redirect()->back()->with('failed', 'Wrong OTP');
    }

    }

    public function OtpApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        $user = Customer::where('id',$token->userid)->first();
        if($user->otp === $request->otp){
            $user->status = "1";
            $user->otp = "";
            $user->save();
            return response()->json([
                'message'=>'Login Successfully'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Wrong code'
            ]);
        }

    }
    public function  logoutApi(Request $request){

        $token = Token::where('token',$request->token)->first();
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y, h:i:s A');
        if($token){
            $token->expire_at = $time;
            $token->save();
            return "Logout";
        }

    }
    public function CustomerInfoApi(Request $request){

        $token = Token::where('token',$request->token)->first();

        return  Customer::where('id', $token->userid)->first();
    }
    public function CustomerApi(Request $request){

        return  Customer::where('id', $request->id)->first();
    }

    public function CustomerEditApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        $user =  Customer::where('id', $token->userid)->first();
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $result = $user->save();
        if($result){

            //return redirect()->back()->with('success', 'Profile Update successfully');
            return response()->json([
                'status'=>1,
                'success'=>'Profile Update successfully',
                'customer'=>$user
            ]);
        }
        else{
            //return redirect()->back()->with('failed', 'Registration Failed');
            return response()->json([
                'status'=>0,
                'error'=>'Profile Updating failed'
            ]);
        }

    }



    public function customerProfile(){
        $user = Customer::where('username',session()->get('customer_username'))->first();
        return view('customer.profile.updateProfile')->with('user', $user);
    }

    public function customerEdit(Request $request){
       $validate = $request->validate([
            "name"=>"required",
            'dob'=>'required|date',
            'email'=>'required|email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
            'address'=>'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg'


        ]
    );
if($request->hasfile('image')){
    $nameImage = $request->file('image')->getClientOriginalName();
    $folder = $request->file('image')->move(public_path('customer_image').'/',$nameImage);
}
else{
    $nameImage = $request->session()->get('image');
}





    $user = Customer::where('username',$request->session()->get('customer_username'))->first();
    $user->name = $request->name;
    $request->session()->put('name',$request->name);
    $user->dob = $request->dob;
    $request->session()->put('dob',$request->dob);
    $user->email = $request->email;
    $request->session()->put('email',$request->email);
    $user->phone = $request->phone;
    $request->session()->put('phone',$request->phone);
    $user->address = $request->address;
    $request->session()->put('address',$request->address);
    $user->image = $nameImage;
    $request->session()->put('image',$nameImage);

    $result = $user->save();
    if($result){

        return redirect()->back()->with('success', 'Profile Update successfully');
    }
    else{
        return redirect()->back()->with('failed', 'Registration Failed');
    }

    }

    public function cpass(Request $request){

        $validate = $request->validate([
            "cpass"=>"required",
            'npass'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',
            'rpass'=>'required'
        ],
        ['npass.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special character, 1 number"]
    );

    $user = Customer::where('username',$request->session()->get('customer_username'))->first();

    if($user->password === md5($request->cpass)){

        if($request->npass === $request->rpass){

            $user->password = md5($request->npass);
            session()->put('password',md5($request->npass));
            $result = $user->save();
            if($result){
            return redirect()->back()->with('success', 'Password Updated');
            }
            else{
                return redirect()->back()->with('failed', 'Password Changing failed');
            }

        }
        else{
            return redirect()->back()->with('failed', 'retype password doesnt match');
        }

    }
    else{
        return redirect()->back()->with('failed', 'wrong password inserted');
    }


    }

    public function cpassApi(Request $request){

        $token = Token::where('token',$request->token)->first();
        $user =  Customer::where('id', $token->userid)->first();
        if($user->password === md5($request->cpass)){

            if($request->npass === $request->rpass){

                $user->password = md5($request->npass);

                $result = $user->save();
                if($result){
               // return redirect()->back()->with('success', 'Password Updated');
               return response()->json([
                'status'=>1,
                'success'=>'Password Updated'
            ]);

                }
                else{
                    //return redirect()->back()->with('failed', 'Password Changing failed');
                    return response()->json([
                        'status'=>0,
                        'error'=>'Password Changing failed'
                    ]);
                }

            }
            else{
                //return redirect()->back()->with('failed', 'retype password doesnt match');
                return response()->json([
                    'status'=>0,
                    'msg'=>'retype password doesnt match'
                ]);
            }

        }
        else{
            //return redirect()->back()->with('failed', 'wrong password inserted');
            return response()->json([
                'status'=>0,
                'msg'=>'wrong password inserted'
            ]);
        }


    }



}
