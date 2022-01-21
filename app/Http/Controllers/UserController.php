<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getRoleList()
    {
        // return $this->getProfileID();
        return $this->handleResponse(Role::all(), 'data success');
    }

    public function index()
    {
        

        if ($this->paid() == 1 && $this->getRole() == 1 ) {
         
            return $this->handleResponse(User::paginate(10), 'data success');
        } else {
            return $this->handleError('error', 'user is trial!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if ($this->paid() == 1 && Auth::user()->role_id == 1) {
            try {

                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'role_id' => 'required',
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                ]);

                if ($validator->fails()) {
                    
                    return $this->handleError($validator->errors());
                }

               
                $user = User::create(
                    array_merge(
                        $validator->validated(),
                        [   'password' => Hash::make($request->password),
                            'admin_id' => Auth::user()->id,
                            'trial_paid' => 1, // paid
                          
                        ]
                    )
                );
                $success['user'] =  $user;
                return $this->handleResponse($success, 'User successfully insert!');
            } catch (\Throwable $th) {
                
                return $this->handleError('error', $th);
            }
        } else {
            return $this->handleError('error', 'user is trial!');
        }
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
        if ($this->paid() == 1 && Auth::user()->role_id == 1) {
            $editUser = User::find($id);
            return $this->handleResponse($editUser, 'data success');
        } else {
            return $this->handleError('error', 'user is trial!');
        }
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

        if ($this->paid() == 1 && Auth::user()->role_id == 1) {
            try {
                $editUser = User::find($id);
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'role_id' => 'required',
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                ]);
                if ($validator->fails()) {
                    return $this->handleError($validator->errors());
                }
                $editUser->admin_id = Auth::user()->id;
                $editUser->name = $request->name;
                $editUser->phone = $request->phone;
                $editUser->role_id = $request->role_id;
                $editUser->password = Hash::make($request->password);
                $editUser->update();
                $success['user'] =  $editUser;
                return $this->handleResponse($success, 'User successfully update!');
            } catch (\Throwable $th) {
                return $this->handleError('error', $th);
            }
        } else {
            return $this->handleError('error', 'user is trial!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->paid() == 1 && Auth::user()->role_id == 1) {
            try {
                $deleteUser = User::find($id);
                $deleteUser->delete();
                return $this->handleResponse('Delete!', 'User successfully Delete!');
            } catch (\Throwable $th) {
                return $this->handleError('error', $th);
            }
        } else {
        }
    }
}
