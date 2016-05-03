<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CustomerMaster;
use View;
use DB;
use Hash;
use Input;
use Auth;
use App\Response;
use App\CarBooking;

class CustomerMasterController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
	
	public function createCustomerMaster()
    {
		$user_name_exist = CustomerMaster::where('email',Input::get('email'))
							->first();
		
		if($user_name_exist){
			return json_encode("name_exist");
		}
		
        $create_user = new CustomerMaster();
		$create_user->name = Input::get('customer_name');
		$create_user->email = Input::get('email');
		$create_user->phone = Input::get('phone');
		$create_user->password = Hash::make(Input::get('password'));
		$create_user->save();
		
		return Response::success('200','',$create_user);
    }
	
	public function getRentedCars(){
		
		$rented_car_details_sql = "select car_mst.*, car_bking.*,
									cust_mst.*
									from customer_master as cust_mst
									left join car_booking as car_bking
									on car_bking.customer_id = cust_mst.id
									left join car_master as car_mst
									on car_bking.car_id = cust_mst.id
									where car_bking.lease_status = 1
									and car_bking.customer_id = ".Input::get('customer_id');
		$rented_car_details = DB::select(DB::raw($rented_car_details_sql));
		 
		return Response::success('200','',$rented_car_details);
	}
	
	public function customerRentACar()
    {
		$booking_exist = CarBooking::where('customer_id',Input::get('customer_id'))
							->where('lease_status',Input::get('lease_status'))
							->first();
		
		if($booking_exist){
			return json_encode("already booked a car");
		}
		
        $new_booking = new CarBooking();
		$create_user->car_id = Input::get('car_id');
		$create_user->customer_id = Input::get('customer_id');
		$create_user->dude_date = Input::get('dude_date');
		$create_user->amount = Input::get('amount');
		$create_user->lease_status = 1;
		$create_user->save();
		
		return Response::success('200','',$create_user);
    }
	
	public function customerEndLease()
    {
		$booking_exist = CarBooking::where('customer_id',Input::get('customer_id'))
							->where('lease_status',Input::get('lease_status'))
							->first();
		
		if($booking_exist){
			$booking_exist->lease_status = 0;
			$booking_exist->save();
			return Response::success('200','',$booking_exist);
		}
    }
}
