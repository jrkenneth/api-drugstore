<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $data = $users->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Users Listed Successfully'
        ];

        return response()->json($response, 202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'username'=>'required',
            'password'=>'required',
            'location'=>'required',
            'phone_number'=>'required'
        ]);

        if ($validator->fails()){
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $user = User::create($input);

        $data = $user->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'User Created Successfully'
        ];        
        return response()->json($response, 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data = $user->toArray();

        if(is_null($user)){
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'User Not Found'
            ];
            return response()->json($response, 404);
        }else{
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'User Retrieved Successfully'
            ];
            return response()->json($response, 202);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'username'=>'required',
            'password'=>'required',
            'location'=>'required',
            'phone_number'=>'required'
        ]);

        if ($validator->fails()){
            $response = [
                'success' => false,
                'data' => 'Validation Error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        } 
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->username = $input['username'];
        $user->password = $input['password'];
        $user->location = $input['location'];
        $user->phone_number = $input['phone_number'];

        $user->save();

        $data = $user->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'User Updated Successfully'
        ];        
        return response()->json($response, 202);
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
}
