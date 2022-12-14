<?php

namespace App\Http\Controllers;

use App\Models\customerRating;
use App\Models\Ride;
use App\Models\Customer;
use App\Http\Requests\StorecustomerRatingRequest;
use App\Http\Requests\UpdatecustomerRatingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerRatingController extends Controller
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
     * @param  \App\Http\Requests\StorecustomerRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecustomerRatingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function show(customerRating $customerRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function edit(customerRating $customerRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecustomerRatingRequest  $request
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecustomerRatingRequest $request, customerRating $customerRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(customerRating $customerRating)
    {
        //
    }
    public function discountList(){
        $discount = customerRating::all();
        $user = Customer::where('username',session()->get('customer_username'))->first();
        return view('customer.ride.discount')->with('discount', $discount)->with('user', $user);
    }

    public function discountListApi(){
        $discount = customerRating::all();
       // $user = Customer::where('username',session()->get('customer_username'))->first();
        return $discount;
    }

    public function discountClaim(Request $request){
        $customer = Customer::where('username', session()->get('customer_username'))->first();
        $discount = customerRating::where('id',$request->id)->first();

        if($customer->rating >= $discount->point){


        $point = $discount->point;

         $discountAmount = $discount->amount;

         if(($customer->discount)<=0){


         $currentpoint = $customer->rating;
         $currentDiscount = $customer->discount;
         $totalDiscount = $discountAmount + $currentDiscount;
         $customer->discount = $totalDiscount;
         $customer->rating = $currentpoint - $point;
         session()->put('rating',$customer->rating);
         $result = $customer->save();
         if($result){
            return redirect()->back()->with('success', '<strong>Congratulation</strong> You will get '.$totalDiscount.' TK discount on your next ride');
         }
        }
        else{

            return redirect()->back()->with('failed', '<strong>Sorry</strong> You can not claim more discount with using previous');
        }
        }
        else{
            return redirect()->back()->with('failed', '<strong>Sorry</strong> You have not sufficient point to claim this discount');
        }

    }
}