<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\City;
use App\Models\CityOfDelivery;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\PriceByProductType;
use App\Models\ProductType;
use App\Models\Profile;
use App\Models\Township;
use App\Models\Track;
use App\Models\views\PriceByProductTypeView;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
class CodeSetupController extends BaseController
{
    public function getInvoice()
    {
        return $this->handleResponse(Invoice::where('profile_id',$this->getProfileID())->paginate(10), 'Data success!!');
    }

    public function invoiceStore(Request $request)
    {
       try {
        $validator = Validator::make($request->all(), [
            'invoice_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $invoice  =  Invoice::create([
            'profile_id' => $this->getProfileID(),
            'invoice_name' => $request->invoice_name,
           
        ]);
        return $this->handleResponse($invoice, 'data success!');
          
       } catch (\Throwable $th) {
        return $this->handleError('error', $th);
       }
    }

    public function invoiceUpdate(Request $request, $id)
    {
        try {
           if($id){
               $invoice = Invoice::find($id);
               $invoice->profile_id = $this->getProfileID();
               $invoice->invoice_name = $request->invoice_name;
               $invoice->update();
               return $this->handleResponse($invoice, 'Data success!!');
           }
        } catch (\Throwable $th) {
           return $this->handleError('error', $th);
        }
    }
    public function invoiceEdit($id)
    {
       if($id){
           $invoice = Invoice::find($id);
           return $this->handleResponse($invoice, 'Data success!!');
       }
    }
    public function invoiceDelete($id)
    {
        try {
           if($id){
            $invoice = Invoice::find($id);
            $invoice->delete();
            return $this->handleResponse($invoice, 'Data success!!');
           }
        } catch (\Throwable $th) {
            return $this->handleError('error', $th);
        }
    }

    public function getTrack()
    {
        return $this->handleResponse(Track::where('profile_id',$this->getProfileID())->paginate(10), 'Data success!!');
    }
      
    public function trackStore(Request $request)
    {
       try {
        $validator = Validator::make($request->all(), [
            'track_license' => 'required',
            'track_weight' => 'required',
            'track_type' =>'required',
            'oil_type' =>'required',
            'own_contract' =>'required',
           
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $track  =  Track::create([
            'profile_id' => $this->getProfileID(),
            'track_license' => $request->track_license,
            'track_weight' => $request->track_weight,
            'track_type' => $request->track_type,
            'oil_type' => $request->oil_type,
            'own_contract' => $request->own_contract
            
        ]);
        return $this->handleResponse($track, 'data success!');
          
       } catch (\Throwable $th) {
        return $this->handleError('error', $th);
       }
    }
    public function trackEdit($id)
    {
        if($id){
            $track = Track::find($id);
            return $this->handleResponse($track, 'Data success!!');
        }
    }

    public function trackUpdate(Request $request, $id)
    {
        try {
            if($id){
                $track = Track::find($id);
                $track->profile_id = $this->getProfileID();
                $track->track_license = $request->track_license;
                $track->track_weight = $request->track_weight;
                $track->track_type = $request->track_type;
                $track->oil_type = $request->oil_type;
                $track->own_contract = $request->own_contract;
                $track->update();
                return $this->handleResponse($track, 'Data success!!');
            }
         } catch (\Throwable $th) {
            return $this->handleError('error', $th);
         }
    }

    public function trackDelete($id)
    {
        try {
            if($id){
             $track = Track::find($id);
             $track->delete();
             return $this->handleResponse($track, 'Data success!!');
            }
         } catch (\Throwable $th) {
             return $this->handleError('error', $th);
         }
        
    }


    public function getDriver()
    {
        return $this->handleResponse(Driver::where('profile_id',$this->getProfileID())->paginate(10), 'Data success!!');
    }
      
    public function driverStore(Request $request)
    {
       try {
       
        $validator = Validator::make($request->all(), [
            // 'track_id' => 'required',
            'driver_name' => 'required', 
            'driver_license' => 'required',
            'driver_phone' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $track  =  Driver::create([
            'profile_id' => $this->getProfileID(),
            // 'track_id' => $request->track_id,
            'driver_name' => $request->driver_name,
            'driver_license' => $request->driver_license,
            'driver_phone' => $request->driver_phone
        ]);
        return $this->handleResponse($track, 'data success!');
          
       } catch (\Throwable $th) {
        return $this->handleError('error', $th);
       }
    }
    public function driverEdit($id)
    {
        if($id){
            $driver = Driver::find($id);
            return $this->handleResponse($driver, 'Data success!!');
        }
    }

    public function driverUpdate(Request $request, $id)
    {
        try {
            if($id){
                $driver = Driver::find($id);
                $driver->profile_id = $this->getProfileID();
                $driver->track_id = $request->track_id;
                $driver->driver_name = $request->driver_name;
                $driver->driver_license = $request->driver_license;
                $driver->driver_phone = $request->driver_phone;
                $driver->update();
                return $this->handleResponse($driver, 'Data success!!');
            }
         } catch (\Throwable $th) {
            return $this->handleError('error', $th);
         }
    }

    public function driverDelete($id)
    {
        try {
            if($id){
             $driver = Driver::find($id);
             $driver->delete();
             return $this->handleResponse($driver, 'Data success!!');
            }
         } catch (\Throwable $th) {
             return $this->handleError('error', $th);
         }
        
    }


    public function getType()
    {
        return $this->handleResponse(ProductType::where('profile_id',$this->getProfileID())->orWhere('profile_id',null)->paginate(10), 'Data success!!');
    }
      
    public function typeStore(Request $request)
    {
       try {
       
        $validator = Validator::make($request->all(), [

            'type_name' => 'required', 
           
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $type  =  ProductType::create([
            'profile_id' => $this->getProfileID(),
            'type_name' => $request->type_name,
           
        ]);
        return $this->handleResponse($type, 'data success!');
          
       } catch (\Throwable $th) {
        return $this->handleError('error', $th);
       }
    }
    public function typeEdit($id)
    {
        if($id){
            $type = ProductType::find($id);
            return $this->handleResponse($type, 'Data success!!');
        }
    }

    public function typeUpdate(Request $request, $id)
    {
        try {
            if($id){
                $type = ProductType::find($id);
                $type->profile_id = $this->getProfileID();
                $type->type_name = $request->type_name;
                $type->update();
                return $this->handleResponse($type, 'Data success!!');
            }
         } catch (\Throwable $th) {
            return $this->handleError('error', $th);
         }
    }

    public function typeDelete($id)
    {
        try {
            if($id){
             $type = ProductType::find($id);
             $type->delete();
             return $this->handleResponse($type, 'Data success!!');
            }
         } catch (\Throwable $th) {
             return $this->handleError('error', $th);
         }
        
    }



    public function getCityOfTown()
    {
       $getCityOfTown = CityOfDelivery::where('profile_id', $this->getProfileID())->get();
       foreach ($getCityOfTown as $v) {
        $getCity[] = City::where('sr_pcode', $v->city_sr_pcode)->get();
        $getTownShip[] = Township::where('tw_code',$v->township_tw_code)->get();
       }
       $data['city'] = array_unique($getCity);
       $data['township'] = array_unique($getTownShip);        
       return $this->handleResponse( $data, 'Data success!!');
    }
      
    public function CityOfTownStore(Request $request)
    {
       try {
       
        $validator = Validator::make($request->all(), [

            'city_sr_pcode' => 'required', 
            'township_tw_code'=>'required'
           
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $cityOfTownStore  =  ProductType::create([
            'profile_id' => $this->getProfileID(),
            'city_sr_pcode' => $request->city_sr_pcode,
            'township_tw_code' => $request->township_tw_code,
           
        ]);
        return $this->handleResponse($cityOfTownStore, 'data success!');
          
       } catch (\Throwable $th) {
        return $this->handleError('error', $th);
       }
    }
    public function cityOfTownEdit($id)
    {
        if($id){
            $cityOfTownEdit = CityOfDelivery::find($id);
            return $this->handleResponse($cityOfTownEdit, 'Data success!!');
        }
    }

    public function cityOfTownUpdate(Request $request, $id)
    {
        try {
            if($id){
                $cityOfTown = CityOfDelivery::find($id);
                $cityOfTown->profile_id = $this->getProfileID();
                $cityOfTown->city_sr_pcode = $request->city_sr_pcode;
                $cityOfTown->township_tw_code = $request->township_tw_code;

                $cityOfTown->update();
                return $this->handleResponse($cityOfTown, 'Data success!!');
            }
         } catch (\Throwable $th) {
            return $this->handleError('error', $th);
         }
    }

    public function cityOfTownDelete($id)
    {
        try {
            if($id){
             $cityOfTown = CityOfDelivery::find($id);
             $cityOfTown->delete();
             return $this->handleResponse($cityOfTown, 'Data success!!');
            }
         } catch (\Throwable $th) {
             return $this->handleError('error', $th);
         }
        
    }

    public function priceByProductType()
    {
       
      $getPrice =  PriceByProductTypeView::where('profile_id',$this->getProfileID())->orWhere('profile_id', null)->get();
      return $this->handleResponse($getPrice, 'data success');
    }







}
