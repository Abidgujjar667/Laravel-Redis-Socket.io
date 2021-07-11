<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=Employee::all();
        return response()->json($employee);
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
        /*$validate=$request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['email','unique:employee','required','string','max:255'],
            'phone' => ['required'],
            'salary' => ['required'],
            'address' => ['required'],
            'photo' => ['required'],
            'joindate' => ['required'],
        ]);*/

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['salary']=$request->salary;
        $data['address']=$request->address;
        $data['joindate']=$request->joindate;

        if ($request->photo) {
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $image_url=$request->photo->move(public_path('upload'), $imageName);

            $data['photo']=$image_url;
        }

        $result=Employee::create($data);
        if ($result){
            return response()->json([
                'message' => 'success'
            ],200);
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
}
