<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Http\Resources\HotelResource;
use App\Models\GroupHotel;
use App\Repositories\HotelRepository;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $repository;

    public function __construct(HotelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {//$this->repository->search($request->input())->dd();
        return  HotelResource::collection($this->repository->search($request->input())->simplePaginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'group_hotel_id' => 'required|exists:hotels_groups,uuid',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'starts' => 'required|numeric|min:1|max:5',
        ]);
        $group_id = GroupHotel::where('uuid', $request->group_hotel_id)->first()->id;
        $request->merge(['group_hotel_id' => $group_id]);
        //dd($validatedData, $request->input());
        $model = $this->repository->create($request->input());
        return HotelResource::make($model)->toArray($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $hotelUuid)
    {

        $model = $this->repository->find($hotelUuid);
        if(is_null($model)) {
            return response()->json([],404);
        }
        return  HotelResource::make($model)->toArray($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupHotel  $groupHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hotelUuid)
    {
        if($request->group_hotel_id) {
            $group_id = GroupHotel::where('uuid', $request->group_hotel_id)->first()->id;
            $request->merge(['group_hotel_id' => $group_id]);
        }
        $data =$request->only(['group_hotel_id', 'name', 'address', 'city', 'starts']);
        if($this->repository->update($data, $hotelUuid)) {
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
    public function destroy($hotel)
    {
        if($this->repository->delete($hotel)) {
            return response()->json(["error" => false,"msg"=>"OK"],200);
        }
        return response()->json([],404);
    }
}
