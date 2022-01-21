<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProfileController extends BaseController
{
    public function getProfile($id)
    {
       
        if($this->getRole() == 1){
            try {
                $profile = Profile::where('user_id', $id)->get();
                return $this->handleResponse($profile, 'data success!');
            } catch (\Throwable $th) {
                return $this->handleError('error', ['error' => $th]);
            }
        }else{
            return $this->handleError('error', 'Your not admin!!');
        }
    }
    public function store(Request $request)
    {

       if($this->getRole() == 1 ){
        try {
            $validator = Validator::make($request->all(), [
                
                'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
                'company_email' => 'required|email',
                'company_name' => 'required',
                'invoice_name' => 'required',
                'company_phone' => 'required',
                'company_reg_number' => 'required',
                'city_sr_pcode' => 'required',
                'township_tw_code' => 'required',
                'company_address' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->handleError($validator->errors());
            }

            if ($compay_logo = $request->file('company_logo')) {
                $destinationPath = public_path('uploads/images');
                $profileImage = date('YmdHis') . $request->compay_logo . '.' . $request->company_logo->extension();
                $compay_logo->move($destinationPath, $profileImage);
            }

            if (!$request->user_id) {
                $userID = Auth::user()->id();
            } else {
                $userID = $request->user_id;
            }
            $profile = Profile::where('user_id', $userID)->first();
 
            $profile->user_id = $userID;
            $profile->company_logo = $profileImage;
            $profile->company_email = $request->company_email;
            $profile->company_name = $request->company_name;
            $profile->invoice_name = $request->invoice_name;
            $profile->company_phone = $request->company_phone;
            $profile->company_reg_number = $request->company_reg_number;
            $profile->city_sr_pcode = $request->city_sr_pcode;
            $profile->township_tw_code = $request->township_tw_code;
            $profile->company_address = $request->company_address;

            $profile->save();
        
            return $this->handleResponse($profile, 'data success!');
        } catch (Exception $e) {
            return $this->handleError('error', ['error' => $e]);
        }
       }else{
        return $this->handleError('error', 'Your not admin!!');
       }
    }

    public function update(Request $request, $profile_id)
    {

       if($this->getRole() == 1){
        try {
            $profile = Profile::find($profile_id);
            $validator = Validator::make($request->all(), [
                'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
                'company_email' => 'required|email',
                'company_name' => 'required',
                'company_phone' => 'required',
                'invoice_name' => 'required',
                'company_reg_number' => 'required',
                'city_sr_pcode' => 'required',
                'township_tw_code' => 'required',
                'company_address' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->handleError($validator->errors());
            }
            if ($compay_logo = $request->file('company_logo')) {
                $destinationPath = public_path('uploads/images');
                $profileImage = date('YmdHis') . $request->compay_logo . '.' . $request->company_logo->extension();
                $compay_logo->move($destinationPath, $profileImage);
            }

            if (!$request->user_id) {
                $userID = Auth::user()->id();
            } else {
                $userID = $request->user_id;
            }
            $profile->user_id = $userID;
            $profile->company_logo = $profileImage;
            $profile->company_email = $request->company_email;
            $profile->company_name = $request->company_name;
            $profile->invoice_name = $request->invoice_name;
            $profile->company_phone = $request->company_phone;
            $profile->company_reg_number = $request->company_reg_number;
            $profile->city_sr_pcode = $request->city_sr_pcode;
            $profile->township_tw_code = $request->township_tw_code;
            $profile->company_address = $request->company_address;
            $profile->updated_at = Carbon::now();
            $profile->update();
            return $this->handleResponse($profile, 'data success!');
        } catch (\Throwable $th) {
            return $this->handleError('error', ['error' => $th]);
        }
       }else{
        return $this->handleError('error', 'Your not admin!!');
       }
    }
    public function delete($profile_id)
    {
        if($this->getRole() == 1 ){
            try {
                $profile = Profile::find($profile_id);
                $profile->company_logo = null;
                $profile->company_email = null;
                $profile->company_name = null;
                $profile->invoice_name = null;
                $profile->company_phone = null;
                $profile->company_reg_number = null;
                $profile->city_sr_pcode = null;
                $profile->township_tw_code = null;
                $profile->company_address = null;
                
                $profile->update();
               
                return $this->handleResponse('delete!', 'data success!');
            } catch (\Throwable $th) {
                return $this->handleError('error', ['error' => $th]);
            }
        }else{
            return $this->handleError('error', 'Your not admin!!');
        }
    }
}
