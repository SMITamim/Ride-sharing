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


class RiderApiController extends Controller
{
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

  public function regApi(Request $request){
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
      $result = $rider->save();
  }
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
}
