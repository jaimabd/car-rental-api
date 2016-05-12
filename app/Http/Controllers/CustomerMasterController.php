<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CustomerMaster;
use View;
use DB;
use Hash;
use Session;
use Input;
use Auth;
use App\Response;
use App\CarBooking;
use App\CarMaser;

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
		$create_user->name = Input::get('name');
		$create_user->email = Input::get('email');
		$create_user->phone = Input::get('phone');
		$create_user->password = Hash::make(Input::get('password'));
		$create_user->save();
		
		return Response::success('200','',$create_user);
    }
	
	public function getCustomerMaster() {
		$customer_details = CustomerMaster::get();
		return Response::success('200','',$customer_details);
		
		
	}
	public function editCustomerMaster(){
		$edit_customers = CustomerMaster::where('id', Input::get('customer_id'))->first();
		return Response::success('200','',$edit_customers);
	}
	
	public function deleteCustomerMaster(){
		$delete_customers = CustomerMaster::where('id', Input::get('customer_id'))->delete();
		return Response::success('200','',$delete_customers);
	}
	
	public function updateCustomerMaster(){
		
		$create_user = CustomerMaster::where('id', Input::get('id'))->first();
		$create_user->name = Input::get('name');
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
									
			$rented_car_details_sql = "select car_master.*, car_booking.*, car_booking.id as car_id from car_booking left join car_master 
									on car_booking.car_id = car_master.id where car_booking.customer_id = '".Input::get('customer_id')."'
									and car_booking.lease_status = 1";
		$rented_car_details = DB::select(DB::raw($rented_car_details_sql));
		 
		return Response::success('200','',$rented_car_details);
	}
	
	public function customerRentACar()
    {
		
		$booking_exist = CarBooking::where('customer_id',Input::get('customer_id'))
							->where('lease_status',1)
							->get();
		
		if(count($booking_exist) > 0 ){
			
			return Response::success('202','already booked a car', '');
		}
		
		
        $new_booking = new CarBooking();
		$new_booking->car_id = Input::get('car_id');
		$new_booking->customer_id = Input::get('customer_id');
		$new_booking->dude_date = date('Y-m-d', strtotime(Input::get('due_date')));
		$new_booking->amount = Input::get('amount');
		$new_booking->lease_status = 1;
		$new_booking->save();
		
		$update_car = CarMaser::where('id', Input::get('car_id'))->first();
		$update_car->is_booked = 1;
		$update_car->save();
		
		return Response::success('200','',$new_booking);
    }
	
	public function customerEndLease()
    {
		
		$end_lease = CarBooking::where('id', Input::get('id'))
							->first();
							
		$end_lease->lease_status = 0;
	$end_lease->save();
$update_car = CarMaser::where('id', $end_lease->car_id)->first();
		$update_car->is_booked = 0;
		$update_car->save();
		
		return Response::success('200','success','');
	
		
    }
	public function customerLogin() {
		$name = Input::get('user_name');
	    $password = Input::get('password');		
		
		$customer_master = CustomerMaster::where('email', $name)->first();
		
     	if(Hash::check($password, $customer_master->password)){				
				
				Session::put('user_id',$customer_master->id);
				
				Session::put('email',$customer_master->email);
				Session::put('name',$customer_master->name);								
				return Response::success('200','true',$customer_master->id);
				
	        }
	        else{    
	            
	            return Response::failure('404','Failed');
	        }	
	}
}