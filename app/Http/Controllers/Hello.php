<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Hello extends Controller
{
    /**
     * Display listing of resources
     * @return Response 
     */
    public function index(){
            return 'Hello from the controller.';
    }
    
    /**
     * Show the form for creating resource
     * 
     * @return Response 
     */
    public function create(){
        
    }
    
    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return  Response 
     */
    public function store(Request $request){
        
    }
    
    /**
     * Display the specified resource.
     * @param name $id
     * @return Response 
     */
    public function show($name){
           return view('hello', array('name'=>$name));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit($id){
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    
    
}
