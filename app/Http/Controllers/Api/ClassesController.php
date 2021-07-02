<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=Classes::get()->all();

        return response()->json([
           'data' => $classes,
           'commit' => 'All Data'
        ],200);
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
        $validate=$request->validate([
            'class_name' => 'unique:classes|required'
        ]);

        $data=array();
        $data['class_name']=$request->class_name;
        $result=Classes::create($data);
        return response()->json([
            'data' =>$result,
            'commit' => 'Inserted'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result=Classes::find($id);
        return response()->json([
            'data' =>$result,
            'commit' => 'Deleted'
        ],200);
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
    public function update(Request $request, $id)
    {
        $data=array();
        $data['class_name']=$request->class_name;
        $result=Classes::where('id',$id)->update($data);
        return response()->json([
            'data' =>$result,
            'commit' => 'Update'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=Classes::find($id);
        if ($result){
            $result=Classes::find($id)->delete();
            return response()->json([
                'data' =>$result,
                'commit' => 'Deleted'
            ],200);
        }
        return response()->json([
            'data' =>$result,
            'commit' => 'Record Not Found'
        ],200);

    }
}
