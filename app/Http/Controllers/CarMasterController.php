<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CarMaser;
use View;
use DB;
use Hash;
use Input;
use Auth;
use App\Response;

class CarMasterController extends Controller
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
        //
    }
	
	public function createCarMaster(){
		$create_user = new CarMaser();
		$create_user->name = Input::get('name');
		$create_user->brand_name = Input::get('brand_name');
		$create_user->description = Input::get('description');
		$create_user->type = Input::get('type');
		$create_user->color = Input::get('color');
		//$create_user->is_booked = Input::get('is_booked');		

		$create_user->save();
		
		return Response::success('200','',$create_user);
	}
	
	public function editCarMaster(){
		$edit_cars = CarMaser::where('id', Input::get('car_id'))->first();
		return Response::success('200','',$edit_cars);
	}
	
	public function deleteCarMaster(){
		$delete_cars = CarMaser::where('id', Input::get('car_id'))->delete();
		return Response::success('200','',$delete_cars);
	}
	
	public function updateCarMaster(){
		
		$update_user = CarMaser::where('id', Input::get('id'))->first();
		$update_user->name = Input::get('name');
		$update_user->brand_name = Input::get('brand_name');
		$update_user->description = Input::get('description');
		$update_user->type = Input::get('type');
		$update_user->color = Input::get('color');		
		$update_user->save();
		
		return Response::success('200','',$update_user);
		
	}
	
	public function getCarMaster(){
		$car_details = CarMaser::get();
		return Response::success('200','',$car_details);
	}
	
	public function getAvailableCars(){
		
		$car_details = CarMaser::where('is_booked', 0)->get();
		return Response::success('200','',$car_details);
	}
	
	public function getRentedCars(){
		$car_details = CarMaser::where('is_booked', 1)->get();
		return Response::success('200','',$car_details);
	}
}
