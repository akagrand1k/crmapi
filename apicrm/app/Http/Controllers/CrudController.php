<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CrudController extends Controller
{
    protected $model = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = $this->model->all();
        return $this->sendResponse($all->toArray());//
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
        $input = $request->all();/*
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }*/
        $new = $this->model->create($input);
        return $this->sendResponse($new->toArray(), 'Row created successfully.');
        /*
        $id = $this->model->insertGetId($this->getDataByModel($request));
        return $this->sendResponse(['id'=> $id], 'ID of inserted row');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find = $this->model->find($id);
        if(is_null($find)){
            return $this->sendError('Row by ID ='.$id.' is not found.');
        }
        return $this->sendResponse($find->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);//
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

        $find = $this->model->find($id);
        if(is_null($find)){
            return $this->sendError('Row by ID ='.$id.' is not found.');
        }
        $input = $request->all();/*
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }*/
        //$product->name = $input['name'];
        //$product->detail = $input['detail'];
        //$product->save();
        $up = $find->update($input);
        //$find->save();
        return $this->sendResponse($input, 'Row by ID ='.$id.' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = $this->model->find($id);
        if(is_null($find)){
            return $this->sendError('Row by ID ='.$id.' is not found.');
        }
        $find->delete();
        return $this->sendResponse([], 'Row by ID ='.$id.' deleted successfully.');
    }
}
