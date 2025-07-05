<?php

namespace App\Http\Controllers\Hotels;

use App\Classes\Hotels\HotelService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotels\HotelRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelController extends Controller
{

    public function __construct(public HotelService $hotel) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([$this->hotel->index()], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        $createHotel = $this->hotel->store($request->validated());
        return response()->json(['message' => 'Hotel con ID '. $createHotel->id .' creado de manera exitosa'], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $hotelDetail = $this->hotel->show($id);
        return response()->json([$hotelDetail], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, int $id)
    {
        $this->hotel->update($request->validated(), $id);
        return response()->json(['message' => 'Hotel con ID '. $id .' actualizado de manera exitosa'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->hotel->destroy($id);
        return response()->json(['message' => 'Hotel borrado exitosamente.'], Response::HTTP_OK);
    }

    /**
     * return hotels configuration rooms type list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        return $this->hotel->assign($request);
    }

    /**
     * return cities resource list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function cities()
    {
        return response()->json([$this->hotel->cities()], Response::HTTP_OK);
    }

    /**
     * return room types resource list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        $roomTypes = $this->hotel->roomTypes();
        return response()->json([$roomTypes], Response::HTTP_OK);
    }

    /**
     * return accommodations types by room types resource list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function accommodationTypes(int $roomTypeId)
    {
        $roomTypes = $this->hotel->accommodationTypes($roomTypeId);
        return response()->json([$roomTypes], Response::HTTP_OK);
    }
}
