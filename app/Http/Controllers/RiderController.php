<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Ride;
use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RiderRegMail;
use DateTime;

class RiderController extends Controller
{


    public function riderCreateSubmit(Request $request){

        $validate = $request->validate([
              "fname"=>'required|max:20',
              "gender"=>"required",
              'dob'=>'required|date',
              "peraddress"=>"required",
              "preaddress"=>"required",
              'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
              'email'=>'required|email',
              'nid'=>'required|numeric|digits:10',
              'dlic'=>'required|numeric|digits:10',
              'username'=>'required|min:5',
              'password'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',

          ],
          ['fname.required'=>"The Full Name field is required.",
          'fname.max'=>"The Full Name field is access max 20 alphabet.",
          'peraddress.required'=>"The Permanent Address field is required.",
          'preaddress.required'=>"The Present Address field is required.",
          'password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special charactee, 1 number",
          'phone.regex'=>"Please use number or valid phone format",
          'nid.digits'=>"Please input your accurate 10 digit NID number",
          'dlic.digits'=>"Please input your accurate 10 digit Driving license number",
          'nid.required'=>"The NID NO. field is required.",
          'dlic.required'=>"The DRIVING LICENSE field is required."]
      );
      $status = "pending";
      $balance = 0;
      $rpoint = 0;
      $pass=$request->password;
      $cpass=$request->cpassword;

      if ($cpass == $pass)
      {

      $userCheck = Rider::where('username',$request->username)->first();
      if($userCheck){

          return redirect()->back()->with('failed', 'Username already exist');
      }
      else{
        $image = $request->file('image')->getClientOriginalName();


        //$image = $request->image;
        //$nameImage = $image->getClientOriginalName();

        $rider = new Rider();
          $rider->name = $request->fname;
          $rider->gender = $request->gender;
          $rider->dob = $request->dob;
          $rider->peraddress = $request->peraddress;
          $rider->preaddress = $request->preaddress;
          $rider->phone = $request->digit.$request->phone;
          $rider->email = $request->email;
          $rider->nid = $request->nid;
          $rider->dlic = $request->dlic;
          $rider->status = $status;
          $rider->rpoint = $rpoint;
          $rider->balance = $balance;
          $rider->username = $request->username;
          $request->session()->put('username',$request->username);
          $rider->password = md5($request->password);
          $rider->image = $image;
          $code = rand(1000,9000);
          $details = [
              'title' => 'Registration Confirmation',
              'code' => $code
          ];
          $rider->otp = $code;

          Mail::to($request->email)->send(new RiderRegMail($details));
          $result = $rider->save();
          if($result){
              $folder = $request->file('image')->move(public_path('img').'/',$image);
              return redirect()->route('riderOtp');
          }
          else{
              return redirect()->back()->with('failed', 'Registration Failed');
          }
      }

      }
      else{
        return redirect()->back()->with('failed', 'Confirm Password doesnt match with password');
    }
    }


    public function otpsend (Request $request){
        $validate = $request->validate([
            'otp'=>'required',
        ]);

    $user = Rider::where('username',session()->get('username'))->first();

    if($user->otp === $request->otp){
        $user->otp = "";
        $user->save();
        return  redirect()->route('riderLogin');
    }
    else{
        return redirect()->back()->with('failed', 'Wrong OTP');
    }

    }

    public function riderLoginSubmit(Request $request){
    //     $validate = $request->validate([
    //         'username'=>'required|min:5|max:15',
    //         'password'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/'
    //     ],
    //     ['password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special charactee, 1 number"]
    // );
    $loginCheck = Rider::where('username',$request->username)->where('password',md5($request->password))->first();

    if($loginCheck){
        if($loginCheck->status == "Approved")
        {
            $request->session()->put('id',$loginCheck->id);
            $request->session()->put('name',$loginCheck->name);
            $request->session()->put('gender',$loginCheck->gender);
            $request->session()->put('dob',$loginCheck->dob);
            $request->session()->put('phone',$loginCheck->phone);
            $request->session()->put('email',$loginCheck->email);
            $request->session()->put('peraddress',$loginCheck->peraddress);
            $request->session()->put('preaddress',$loginCheck->preaddress);
            $request->session()->put('nid',$loginCheck->nid);
            $request->session()->put('dlic',$loginCheck->dlic);
            $request->session()->put('username',$loginCheck->username);
            $request->session()->put('password',$loginCheck->password);
            $request->session()->put('image',$loginCheck->image);
            return  redirect()->route('riderDash');
        }
        else{
            return redirect()->back()->with('failed', 'Your Registered id is in observation, Please wait for Admins approval');
        }
    }
    else{
        return redirect()->back()->with('failed', 'Invalid username or password');
    }
    }

    public function logout(){
        session()->forget('id');
        session()->forget('name');
        session()->forget('gender');
        session()->forget('dob');
        session()->forget('phone');
        session()->forget('email');
        session()->forget('peraddress');
        session()->forget('preaddress');
        session()->forget('nid');
        session()->forget('dlic');
        session()->forget('username');
        session()->forget('password');
        session()->forget('image');
        return redirect()->route('riderLogin');
    }


    public function riderProfEdit(Request $request){
        $validate = $request->validate([
            "fname"=>'required|max:20',
            "gender"=>"required",
            'dob'=>'required|date',
            "peraddress"=>"required",
            "preaddress"=>"required",
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:14',
            'email'=>'required|email',
            'nid'=>'required|numeric|digits:10',
            'dlic'=>'required|numeric|digits:10',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg'

        ],
        ['fname.required'=>"The Full Name field is required.",
        'fname.max'=>"The Full Name field is access max 20 alphabet.",
        'peraddress.required'=>"The Permanent Address field is required.",
        'preaddress.required'=>"The Present Address field is required.",
        'password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special charactee, 1 number",
        'phone.regex'=>"Please use number or valid phone format",
        'phone.max'=>"The Phone Number must be 11 digits without country code.",
        'nid.digits'=>"Please input your accurate 10 digit NID number",
        'dlic.digits'=>"Please input your accurate 10 digit Driving license number",
        'nid.required'=>"The NID NO. field is required.",
        'dlic.required'=>"The DRIVING LICENSE field is required."]
     );
 if($request->hasfile('image')){
    $image = $request->file('image')->getClientOriginalName();
    $folder = $request->file('image')->move(public_path('img').'/',$image);
 }
 else{
     $nameImage = $request->session()->get('image');
 }

     $user = Rider::where('username',$request->session()->get('username'))->first();
     $user->name = $request->fname;
     $request->session()->put('name',$request->fname);
     $user->gender = $request->gender;
     $request->session()->put('gender',$request->gender);
     $user->dob = $request->dob;
     $request->session()->put('dob',$request->dob);
     $user->peraddress = $request->peraddress;
     $request->session()->put('peraddress',$request->peraddress);
     $user->preaddress = $request->preaddress;
     $request->session()->put('preaddress',$request->preaddress);
     $user->phone = $request->phone;
     $request->session()->put('phone',$request->phone);
     $user->email = $request->email;
     $request->session()->put('email',$request->email);
     $user->nid = $request->nid;
     $request->session()->put('nid',$request->nid);
     $user->dlic = $request->dlic;
     $request->session()->put('dlic',$request->dlic);
     $user->image = $image;
     $request->session()->put('image',$image);

     $result = $user->save();
     if($result){

        return redirect()->back()->with('success', 'Successfully Profile Updated');
    }
    else{
        return redirect()->back()->with('failed', 'Failure in Profile Updating');
     }

     }

    public function riderchangePass(Request $request){

        $validate = $request->validate([
            "password"=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',
            'npassword'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/',
            'cnpassword'=>'required|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{5,20}$/'
        ],
        ['password.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special character, 1 number",
        'npassword.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special character, 1 number",
        'cnpassword.regex'=>"Please use atleast 1 uppercase, 1 lowercase, 1 special character, 1 number",
        'npassword.required'=>"The new password field is required.",
        'cnpassword.required'=>"The repeated new password field is required."
        ]
    );

    $pass=$request->npassword;
    $rpass=$request->cnpassword;

    if ($rpass == $pass)
    {

    $user = Rider::where('username',$request->session()->get('username'))->where('password',md5($request->password))->first();

    if($user){

            $user->password = md5($request->npassword);
            session()->put('password',md5($request->npassword));
            $result = $user->save();
            if($result){
            return redirect()->back()->with('success', 'Password Successfully Updated');
            }
            else{
                return redirect()->back()->with('failed', 'Failure in Password Updating');
            }

    }
    else{
        return redirect()->back()->with('failed', 'Password Field Fill With Wrong User Password');
    }
    }
    else{
        return redirect()->back()->with('failed', 'Repeated New Password does not match with New Password');
    }
   }

   public function cashout(Request $request){
    $validate = $request->validate([
        'amount'=>'required|regex:/^\+?[1-9]\d*$/',
        'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:14',
    ]
   );
   $rider = Rider::where('id',session()->get('id'))->first();
   if($request->amount >  $rider->balance){
    return redirect()->back()->with('failed', 'Doesnt have sufficient balance to cashout');
    }
    else{
   $rider->balance= $rider->balance - $request->amount;
   $result = $rider->save();
   if($result){
    return redirect()->back()->with('success', 'Transaction request is accepted. Please wait for 24 hours.');
     }
    }
   }


  //Api Start
  public function rideHisApi(Request $request){
    $token = Token::where('token',$request->token)->first();
    $req = "Ride complete";
    return Ride::where('riderId',$token->userid)->where('customerStatus',$req)->where('riderStatus',$req)->get();
    }

       public function riderCountApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        $req = "Ride complete";
        $rideCount = Ride::where('riderId',$token->userid)->where('customerStatus',$req)->where('riderStatus',$req)->get()->count();
        return $rideCount;
    }
    public function riderBalanceApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        return  Rider::where('id',$token->userid)->first();
    }

    public function totalPayApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        $req = "Ride complete";
        $total = 0;
        $rideHis = Ride::where('riderId',$token->userid)->where('customerStatus',$req)->where('riderStatus',$req)->get();

        foreach($rideHis as $ride)
        {
            $total += $ride->cost;
        }
        return $total;
        }


    public function redeemApi(Request $request){
        $token = Token::where('token',$request->token)->first();
        $req = "Ride complete";
        $rider = Rider::where('id',$token->userid)->first();
        $rider->balance= $rider->balance + $rider->rpoint;
        $rider->rpoint= $rider->rpoint - $rider->rpoint;
        $result = $rider->save();

    }

   public function cashoutApi(Request $request){
    $token = Token::where('token',$request->token)->first();
   $rider = Rider::where('id',$token->userid)->first();
   $rider->balance= $rider->balance - $request->amount;
   $result = $rider->save();

   }

public function  loginApi(Request $request){

    $user = Rider::where('username',$request->username)->where('password',md5($request->password))->first();
    if($user){
        // $request->session()->put('id',$user->id);
        $api_token = Str::random(64);
        $token = new Token();
        $token->userid = $user->id;
        $token->token = $api_token;
        $token->created_at = new DateTime();
        $token->save();
        return $token;
    }

    return "No user found";

}

public function  logoutApi(Request $request){

    $token = Token::where('token',$request->token)->first();

    if($token){
        $token->expire_at = new DateTime();
        $token->save();
        return "Logout";
    }

}

public function riderInfoApi(Request $request){

    $token = Token::where('token',$request->token)->first();

    return  Rider::where('id', $token->userid)->first();
}

public function riderInfoUpApi(Request $request){

 $token = Token::where('token',$request->token)->first();
 $user = Rider::where('id', $token->userid)->first();

 $user->name = $request->fname;
 $user->gender = $request->gender;
 $user->dob = $request->dob;
 $user->peraddress = $request->peraddress;
 $user->preaddress = $request->preaddress;
 $user->phone = $request->phone;
 $user->email = $request->email;
 $user->nid = $request->nid;
 $user->dlic = $request->dlic;
 $user->username = $request->username;
 $user->password = md5($request->password);
 $result = $user->save();
 }


 public function checkReqApi(){

    $req = "Waiting for rider...";
    $chk = null;
    return Ride::where('riderId',$chk)->where('customerStatus',$req)->where('riderStatus',$chk)->get();

}

public function ongoingReq(Request $request){

    $token = Token::where('token',$request->token)->first();
    $on = "ongoing";
    $re = 1;
    $user = Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();
    if($user){
        return $re;
    }

}
public function approveReq(Request $request){

    $token = Token::where('token',$request->token)->first();
    $rs = "Approve";
    $re = 1;
    $user = Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    if($user){
        return $re;
    }

}

public function reqApi(Request $request){



    $token = Token::where('token',$request->token)->first();
    $user = Rider::where('id', $token->userid)->first();
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y, h:i:s A');
    $rs = "Approve";
    $ride = Ride::orderBy('id','DESC')->first();

    $ride->riderId = $user->id;
    $ride->riderName = $user->name;
    $ride->riderPhone = $user->phone;
    $ride->customerStatus = $rs;
    $ride->riderStatus = $rs;
    $ride->riderApprovalTime= $time;
    $ride->save();
    return  $ride;
}



public function rideProgApi(Request $request){

    $token = Token::where('token',$request->token)->first();
    $rs = "Approve";
    $on = "ongoing";
    $user = Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    $useron = Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();
    if($user){
        return  Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    }
    elseif($useron)
    {
        return Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();
    }



}
public function rideButtonApi(Request $request){

    $token = Token::where('token',$request->token)->first();
    $rs = "Approve";
    $on = "ongoing";
    $re =1;
    $user = Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    $useron = Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();
    if($user || $useron){
        return $re;
    }

}

public function riderCombutton(Request $request){

    $token = Token::where('token',$request->token)->first();
    $on = "ongoing";
    $re =1;
    $useron = Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();
    if($useron){
        return $re;
    }

}


public function startApi(Request $request){


    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y, h:i:s A');
    $rs = "Approve";
    $on = "ongoing";
    $token = Token::where('token',$request->token)->first();
    $ridez = Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    $ridez->riderStartingTie= $time;
    $ridez->riderStatus= $on;
    $ridez->customerStatus= $on;
    $result = $ridez->save();
    return $result;

}

public function cancelApi(Request $request){

    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y, h:i:s A');
    $cn = "Cancel";
    $token = Token::where('token',$request->token)->first();
    $ridez = Ride::where('riderId',$token->userid)->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
    $ridez->cancelTime= $time;
    $ridez->riderStatus= $cn;
    $ridez->customerStatus= $cn;
    $result = $ridez->save();
    return $result;
}

public function completeApi(Request $request){

    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y, h:i:s A');
    $rs = "ongoing";
    $rs = "Ride complete";
    $token = Token::where('token',$request->token)->first();
    $ridez = Ride::where('riderId',$token->userid)->where('customerStatus',$on)->where('riderStatus',$on)->first();

    $ridez->reachedTime= $time;
    $ridez->riderStatus= $rs;
    $ridez->customerStatus= $rs;
    $ridez->save();

    $rider = Rider::where('id',$token->userid)->first();
    $rider->balance= $rider->balance +  130;
    $rider->rpoint= $rider->rpoint + 3;
    $rider->save();
    $result = "done";
    return $result;


}

public function riderRegistrationApi(Request $request){

    // $api_token = Str::random(64);
    // $token = new Token();
    // $token->userid = $user->id;
    // $token->token = $api_token;
    // $token->created_at = new DateTime();
    // $token->save();

    $status = "pending";
    $balance = 0;
    $rpoint = 0;

    $userCheck = Rider::where('username',$request->username)->first();
    if(!$userCheck){
        $rider = new Rider();
        $rider->name = $request->fname;
        $rider->gender = $request->gender;
        $rider->dob = $request->dob;
        $rider->peraddress = $request->peraddress;
        $rider->preaddress = $request->preaddress;
        $rider->phone = $request->digit.$request->phone;
        $rider->email = $request->email;
        $rider->nid = $request->nid;
        $rider->dlic = $request->dlic;
        $rider->status = $status;
        $rider->rpoint = $rpoint;
        $rider->balance = $balance;
        $rider->username = $request->username;
        $rider->password = md5($request->password);
        $rider->image = $request->image;
        $code = rand(1000,9000);
        $rider->otp = $code;
        $result = $rider->save();
        $details = [
                'title' => 'Registration Confirmation',
                'code' => $code
        ];
        Mail::to($request->email)->send(new RiderRegMail($details));


    }
    }




public function OtpApi(Request $request){
    $token = Token::where('token',$request->token)->first();
    $user = Rider::orderBy('id','DESC')->first();
    if($user->otp === $request->otp){
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

}
