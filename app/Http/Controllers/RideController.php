<?php

namespace App\Http\Controllers;
use App\Models\Location;
use App\Models\Ride;

use App\Models\Rider;
use App\Models\Chat;
use App\Models\Customer;
use App\Models\Token;

use App\Http\Requests\StoreRideRequest;
use App\Http\Requests\UpdateRideRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RideController extends Controller
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
     * @param  \App\Http\Requests\StoreRideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRideRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ride  $ride
     * @return \Illuminate\Http\Response
     */
    public function show(Ride $ride)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ride  $ride
     * @return \Illuminate\Http\Response
     */
    public function edit(Ride $ride)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRideRequest  $request
     * @param  \App\Models\Ride  $ride
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRideRequest $request, Ride $ride)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ride  $ride
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ride $ride)
    {
        //
    }
    public function rideRequestDisplay(){
        $locations = Location::all();
        return view('customer.ride.rideRequest')->with('locations', $locations);
    }
    public function getDistance($latitude1,$longitude1,$latitude2,$longitude2){
        $earthRadius = 6371;
        $latform = deg2rad($latitude1);
        $lonform =deg2rad($longitude2);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);
        $latDelta = $latTo - $latform;
        $lonDelta = $lonTo - $lonform;

        $angle = 2*asin(sqrt(pow(sin($latDelta/2),2)+cos($latform)*cos($latTo)*pow(sin($lonDelta/2),2)));
        return round($earthRadius*$angle);
    }

    public function rideRequestSubmit(Request $request)
    {
        $validate = $request->validate([
            "pickLocation" => "required",
            'dropLocation' => 'required'
        ]);

        $pickLocation = Location::where('location', $request->pickLocation)->first();
        $dropLocation = Location::where('location', $request->dropLocation)->first();


             if($pickLocation){

                if($dropLocation){

                $rideValid = Ride::
                where(function ($query) {
                    $query->where('customerId',session()->get('id'));
                })
                ->Where(function($q) {
                    $q->orWhere('customerStatus', 'Waiting for rider...');
                    $q->orWhere('customerStatus', 'Approve');
                    $q->orWhere('customerStatus', 'ongoing');
                    })
                ->first();
                 if($rideValid){
                 return redirect()->back()->with('failed', 'You have already requested for a ride. Please Cancel it for new request or if ride on going after this ride you can request for new ride');
                   //return $rideValid;
                 }
                 else{


                $lat1 = $pickLocation->latitude;
                $long1 = $pickLocation->longitude;

              $lat2 = $dropLocation->latitude;
              $long2 = $dropLocation->longitude;

              $distance = $this->getDistance($lat1, $long1, $lat2, $long2);
              $status = "Waiting for rider...";

              $getDiscountAmount = Customer::where('id', session()->get('id'))->first();

              $discountAmount = $getDiscountAmount->discount;

              $baseBill = 50;
              $perKiloBill = 10;
               if(($baseBill + ($perKiloBill * $distance) - $discountAmount)<0){
                $bill = 0;
                $getDiscountAmount->discount = -($baseBill + ($perKiloBill * $distance) - $discountAmount);
                $getDiscountAmount->save();
               }
               else{
                $bill = $baseBill + ($perKiloBill * $distance) - $discountAmount;
                $getDiscountAmount->discount = 0;
                $getDiscountAmount->save();
               }

              //date_default_timezone_set('Asia/Dhaka');
               // $date = date('d-m-y h:i:s');
               date_default_timezone_set('Asia/Dhaka');
               $time =  date('d F Y, h:i:s A');
              $ride = new Ride();
               $ride->customerName = $request->session()->get('name');
               $ride->customerId = $request->session()->get('id');
               $ride->customerPhone = $request->session()->get('phone');
               $ride->pickupPoint = $request->pickLocation;
               $ride->destination = $request->dropLocation;
               $ride->length = $distance;
               $ride->cost = $bill;
               $ride->customerStatus = $status;
               $ride->rideRequestTime = $time;
               $result = $ride->save();
               if($result){

               // session()->put('rating',$total_rating);

                $success = "Congratulations your ride request confirm successfully. You will 10 rating points after the ride complete";

                return redirect()->back()->with('success', $success)
                ->with('destination',$distance.'kilo')
                ->with('price','Bill: '.$bill.'Tk');
               }

                }
            }
                else{
                    return redirect()->back()->with('failed', 'Drop Location is not correct.Please check correct location from your suggestion box');
                }
              }
              else{
                return redirect()->back()->with('failed', 'Pickup location is not correct.Please check correct location from your suggestion box');
              }









    }

    public function rideList(){
        $rideList = Ride::where('customerId',session()->get('id'))->paginate(8);
        return view('customer.ride.rideList')->with('rideList', $rideList);
    }

    public function getRideInformation(Request $request){
        $rideCancel = Ride::where('id',$request->id)->first();
        return $rideCancel;
    }
    public function rideCancel(Request $request){
        $validate = $request->validate([
            "rideid" => "required"

        ]);
        $rideCancel = Ride::where('id',$request->rideid)->first();

        date_default_timezone_set('Asia/Dhaka');
       $time =  date('d F Y, h:i:s A');

        $rideCancel->customerStatus = "Cancel";
        $rideCancel->cancelTime = $time;
        $rideCancel->riderId=null;
        $rideCancel->riderName=null;
        $rideCancel->riderPhone=null;
        $rideCancel->riderStatus=null;
        $rideCancel->riderApprovalTime=null;
        $result = $rideCancel->save();
        if($result){

            return redirect()->back()->with('success', 'Ride Cancel');
        }

    }

    //Rider_Part



    public function rideHis(){
        $req = "Ride complete";
        $rideHis = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get();
        return view('rider.rideHis')->with('rideHis', $rideHis);
    }

    public function riderBalance(){
        $req = "Ride complete";
        $rideHis = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get();
        $rideCount = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get()->count();
        $rider = Rider::where('id',session()->get('id'))->first();
        return view('rider.riderBalance')->with('rideHis', $rideHis)->with('rideCount', $rideCount)->with('rider', $rider);
    }
    public function rideexl(){
        $req = "Ride complete";
        $rideHis = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get();
        return view('rider.excel')->with('rideHis', $rideHis);

    }

    public function checkReq(){
        $req = "Waiting for rider...";
        $on = "ongoing";
        $chk = null;
        $rs = "Approve";
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
        $ongo = Ride::where('riderId',session()->get('id'))->where('customerStatus',$on)->where('riderStatus',$on)->first();
        $rideCol = Ride::where('riderId',$chk)->where('customerStatus',$req)->where('riderStatus',$chk)->get();
        return view('rider.checkReq')->with('rideCol', $rideCol)->with('ridez', $ridez)->with('ongo', $ongo);

    }

    public function reqProg(Request $request){

        $req = "Waiting for rider...";
        $chk = null;
        $rs = "Approve";


        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y, h:i:s A');

        $ride = Ride::where('id', $request->id)->first();

        $ride->riderId = session()->get('id');
        $ride->riderName = session()->get('name');
        $ride->riderPhone = session()->get('phone');
        $ride->customerStatus = $rs;
        $ride->riderStatus = $rs;
        $ride->riderApprovalTime= $time;
        $result = $ride->save();
        if($result){
            $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
            $rideCol = Ride::where('riderId',$chk)->where('customerStatus',$req)->where('riderStatus',$chk)->get();
            return view('rider.checkReq')->with('rideCol', $rideCol)->with('ridez', $ridez);
        }

    }

    public function rideProgs(){



        $rs = "Approve";
        $on = "ongoing";


        $rs = "Approve";

        $chk = null;
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
        $ongoing = Ride::where('riderId',session()->get('id'))->where('customerStatus',$on)->where('riderStatus',$on)->first();
        $start = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->where('riderStartingTie',$chk)->first();
        return view('rider.reqProgress')->with('ridez', $ridez)->with('start', $start)->with('ongoing', $ongoing);

    }

    public function progSub(Request $request){


        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y, h:i:s A');

        $rs = "Approve";
        $on = "ongoing";

        $rs = "Approve";

        $chk = null;
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
        $ridez->riderStartingTie= $time;
        $ridez->riderStatus= $on;
        $ridez->customerStatus= $on;
        $result = $ridez->save();

        if($result){
            $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$on)->where('riderStatus',$on)->first();
            $start = Ride::where('riderId',session()->get('id'))->where('customerStatus',$on)->where('riderStatus',$on)->where('riderStartingTie',$chk)->first();
            return view('rider.reqProgress')->with('ridez', $ridez)->with('start',$start);
        }

    }

    public function progCancel(Request $request){

        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y, h:i:s A');
        $rs = "Approve";
        $cn = "Cancel";
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
        $ridez->cancelTime= $time;
        $ridez->riderStatus= $cn;
        $ridez->customerStatus= $cn;

        $result = $ridez->save();


        if($result){
            $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
            return view('rider.reqProgress')->with('ridez', $ridez);
        }

    }

    public function progComplete(Request $request){

        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y, h:i:s A');

        $rs = "ongoing";
        $cn = "Ride complete";
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();

        $ridez->reachedTime= $time;
        $ridez->riderStatus= $cn;
        $ridez->customerStatus= $cn;
        $result = $ridez->save();

        if ($result) {
            $customer = Customer::where('id', $ridez->customerId)->first();
            $bonus_rating = 10;
            $total_rating = $customer->rating + $bonus_rating;
            $customer->rating = $total_rating;

            $customer->save();
        }


        $rider = Rider::where('id',session()->get('id'))->first();
        $rider->balance= $rider->balance + $request->bal;
        $rider->rpoint= $rider->rpoint + 3;
        $rider->save();


        if($result){
            $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
            return view('rider.reqProgress')->with('ridez', $ridez);
        }

    }



    public function riderPoint(){
        $req = "Ride complete";
        $rideHis = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get();
        $rideCount = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get()->count();
        $rider = Rider::where('id',session()->get('id'))->first();
        return view('rider.redeem')->with('rideHis', $rideHis)->with('rideCount', $rideCount)->with('rider', $rider);
    }

    public function redeem(Request $request){

        $req = "Ride complete";
        $rideHis = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get();
        $rideCount = Ride::where('riderId',session()->get('id'))->where('customerStatus',$req)->where('riderStatus',$req)->get()->count();
        $rider = Rider::where('id',session()->get('id'))->first();
        if($rider->rpoint >= 31)
        {
        $rider->balance= $rider->balance + $rider->rpoint;
        $rider->rpoint= $rider->rpoint - $rider->rpoint;
        $result = $rider->save();
        if($result){
            return view('rider.redeem')->with('rideHis', $rideHis)->with('rideCount', $rideCount)->with('rider', $rider);
        }
        }
        else{
            return redirect()->back()->with('failed', 'Doesnt have sufficient point to Redeem');
        }

    }

    public function chatapp(){
        $rs = "Approve";
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();
        if(empty($ridez->customerId))
        {
            $cusID = 0;
            $cus = Customer::where('id',$cusID)->first();
            $rider = Rider::where('id',session()->get('id'))->first();
            $chats = Chat::where('riderId',session()->get('id'))->where('customerId',$cusID)->get();
            return view('rider.chatapp')->with('ridez', $ridez)->with('rider', $rider)->with('cus', $cus)->with('chats', $chats);
        }
        else
        {
            $cusID = $ridez->customerId;
            $cus = Customer::where('id',$cusID)->first();
            $rider = Rider::where('id',session()->get('id'))->first();
            $chats = Chat::where('riderId',session()->get('id'))->where('customerId',$cusID)->get();
            return view('rider.chatapp')->with('ridez', $ridez)->with('rider', $rider)->with('cus', $cus)->with('chats', $chats);
        }

    }

    public function chatsend(Request $request){
        $rs = "Approve";
        $ridez = Ride::where('riderId',session()->get('id'))->where('customerStatus',$rs)->where('riderStatus',$rs)->first();

            if(!empty($request->msg))
            {
            date_default_timezone_set('Asia/Dhaka');
            $time =  date('d F Y, h:i:s A');
            $cusID = $ridez->customerId;
            $cus = Customer::where('id',$cusID)->first();
            $rider = Rider::where('id',session()->get('id'))->first();
            $chats = Chat::where('riderId',session()->get('id'))->where('customerId',$cusID)->get();
            $chatss = new Chat();
            $chatss->customerId = $cusID;
            $chatss->riderId = session()->get('id');
            $chatss->cmessage = null;
            $chatss->rmessage =  $request->msg;
            $chatss->time = $time;
            $result = $chatss->save();
            if($result){
            return view('rider.chatapp')->with('ridez', $ridez)->with('rider', $rider)->with('cus', $cus)->with('chats', $chats);
            }
            }
            else{

                $cusID = $ridez->customerId;
                $cus = Customer::where('id',$cusID)->first();
                $rider = Rider::where('id',session()->get('id'))->first();
                $chats = Chat::where('riderId',session()->get('id'))->where('customerId',$cusID)->get();
                return view('rider.chatapp')->with('ridez', $ridez)->with('rider', $rider)->with('cus', $cus)->with('chats', $chats);
            }




    }
//--------------------API-------------------------------------------------------------------
    public function LocationList(){
        $location = Location::all();
        return $location;
    }

    public function rideRequestSubmitApi(Request $request)
    {

        $pickLocation = Location::where('location', $request->pickLocation)->first();
        $dropLocation = Location::where('location', $request->dropLocation)->first();
        if($pickLocation){

            if($dropLocation){

                $token = Token::where('token', $request->token)->first();
                $customer = Customer::where('id', $token->userid)->first();

                if($customer->status === "1"){

                    $rideControl = Ride::where('customerId',$customer->id)
                    ->Where(function($q) {
                        $q->orWhere('customerStatus', 'Waiting for rider...');
                        $q->orWhere('customerStatus', 'Approve');
                        $q->orWhere('customerStatus', 'ongoing');
                        })
                        ->first();
                    if(!$rideControl){
                        $lat1 = $pickLocation->latitude;
                        $long1 = $pickLocation->longitude;

                         $lat2 = $dropLocation->latitude;
                         $long2 = $dropLocation->longitude;

                        $distance = $this->getDistance($lat1, $long1, $lat2, $long2);
                        $status = "Waiting for rider...";
                        $discountAmount = $customer->discount;
                        $baseBill = 70;
                        $perKiloBill = 10;
                        $bill = $baseBill + ($perKiloBill * $distance) - $discountAmount;
                        date_default_timezone_set('Asia/Dhaka');
                        $time =  date('d F Y, h:i:s A');
                        $ride = new Ride();
                        $ride->customerName = $customer->name;
                        $ride->customerId = $customer->id;
                        $ride->customerPhone = $customer->phone;
                        $ride->pickupPoint = $request->pickLocation;
                        $ride->destination = $request->dropLocation;
                        $ride->length = $distance;
                        $ride->cost = $bill;
                        $ride->customerStatus = $status;
                        $ride->rideRequestTime = $time;
                        $result = $ride->save();
                        if($result){
                         $success = "Congratulations your ride request confirm successfully. You will 10 rating points after the ride complete";
                         return response()->json([
                            'statusId'=>200,
                            'success'=>$success,
                            'bill'=>$bill,
                            'distance'=>$distance,
                        ]);

                        }
                        else{
                            return response()->json([
                                'error'=>'Sorry..!Failed to take your ride request',
                            ]);
                        }

                    }
                    else{
                        return response()->json([
                            'error'=>'Please complete a ride before request for a new ride'
                        ]);
                    }

                }
                else{
                    return response()->json([
                        'error'=>'Please valid your email for a ride request'
                    ]);
                }

            }
            else{
                return response()->json([
                    'error'=>'Please select your drop location from our suggestion box'
                ]);

            }

        }
        else{
            return response()->json([
                'error'=>'Please select your pickup location from our suggestion box'
            ]);
        }
    }

    public function RideStatus(Request $request){
        $token = Token::where('token', $request->token)->first();
        $customer = Customer::where('id', $token->userid)->first();
        $rideControl = Ride::where('customerId',$customer->id)
        ->Where(function($q) {
            $q->orWhere('customerStatus', 'Waiting for rider...');
            $q->orWhere('customerStatus', 'Approve');
            $q->orWhere('customerStatus', 'ongoing');
            })
            ->first();
            if($rideControl){
                return response()->json([
                    'error'=>404
                ]);
            }
            else{
                return response()->json([
                    'success'=>200
                ]);
            }
    }

    public function RideHistory(Request $request){
        $token = Token::where('token', $request->token)->first();
        $customer = Customer::where('id',$token->userid)->first();
        $rideList = Ride::where('customerId',$customer->id)->get();
        return $rideList;



    }
    public function rideCancelApi(Request $request){

        $rideCancel = Ride::where('id',$request->rideid)->first();

        date_default_timezone_set('Asia/Dhaka');
       $time =  date('d F Y, h:i:s A');

        $rideCancel->customerStatus = "Cancel";
        $rideCancel->cancelTime = $time;
        $rideCancel->riderId=null;
        $rideCancel->riderName=null;
        $rideCancel->riderPhone=null;
        $rideCancel->riderStatus=null;
        $rideCancel->riderApprovalTime=null;
        $result = $rideCancel->save();
        if($result){

            //return redirect()->back()->with('success', 'Ride Cancel');
            return response()->json([
                'status'=>1,
                'message'=>'Ride Cancel'
            ]);
        }
        else{
            return response()->json([
                'status'=>0,
                'message'=>'Ride Cancelation failed'
            ]);
        }

    }



//

}
