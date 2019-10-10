<?php

namespace App\Http\Controllers;

use App\GroupHotel;
use App\Http\Resources\GroupHotelResource;
use App\Repositories\GroupHotelRepository;
use Illuminate\Http\Request;

class GroupHotelController extends Controller
{
    protected $repository;

    public function __construct(GroupHotelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return  GroupHotelResource::collection($this->repository->search($request->input())->simplePaginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->repository->create($request->input());
        return GroupHotelResource::make($model)->toArray($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $groupHotelUuid)
    {

        $model = $this->repository->find($groupHotelUuid);
        if(is_null($model)) {
            return response()->json([],404);
        }
        return  GroupHotelResource::make($model)->toArray($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupHotel $groupHotel)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $groupHotelUuid)
    {
        $data =$request->only(['name', 'description']);
         if($this->repository->update($data, $groupHotelUuid)) {
             return response()->json(["error" => false,"msg"=>"OK"],200);
         }
        return response()->json([],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($groupHotelUuid)
    {
        if($this->repository->delete($groupHotelUuid)) {
            return response()->json(["error" => false,"msg"=>"OK"],200);
        }
        return response()->json([],404);
    }
}
