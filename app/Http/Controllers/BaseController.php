<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BaseController extends Controller
{
    public function handleResponse($result, $msg)
    {

        $res = [
            'success' => true,
            'data'    => $result,
            'message' => $msg,
        ];
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($res, 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function handleError($error, $errorMsg = [], $code = 404)
    {

        $res = [
            'success' => false,
            'message' => $error,
        ];
        $header = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );


        if (!empty($errorMsg)) {
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code, $header, JSON_UNESCAPED_UNICODE);
    }
    public function paid()
    {
        $paid = Auth::user();
        return $paid->trial_paid;
    }
    public function getRole()
    {
        $authRole = Auth::user();
        return $authRole->role_id; 
    }
    public function getProfileID()
    {
        $id  =  User::where('id',Auth::user()->id)->first();
        // admin
        if($id->admin_id == null){
            $getID = Profile::where('user_id', Auth::user()->id)->first('id');
            return $getID->id;
        }else{
        //user
            $getProfileID = Profile::where('user_id', $id->admin_id)->first('id');
            return $getProfileID->id;
        }
        
    }
}
