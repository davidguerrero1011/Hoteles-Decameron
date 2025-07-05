<?php

namespace App\Classes\Hotels;

use App\Interfaces\Hotels\HotelInterface;
use Illuminate\Http\Request;

class HotelService
{

    public function __construct(protected HotelInterface $hotelInterface) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->hotelInterface->index();
    }

    /**
     * store a resource.
     *
     */
    public function store(array $request)
    {
        return $this->hotelInterface->store($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (empty($id) || !is_numeric($id)) {
            return response()->json(['El ID '. $id . ' suministrado, no es un recurso disponible en este momento, reviselo']);
        }
        return $this->hotelInterface->show($id);
    }

    /**
     * update a resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $request, int $id)
    {
        if (empty($id) || !is_numeric($id)) {
            return response()->json(['El ID '. $id . ' suministrado, no es un recurso disponible en este momento, reviselo']);
        }
        return $this->hotelInterface->update($request, $id);
    }

    /**
     * Destroy a resource.
     *
     * @param $id
     */
    public function destroy(int $id)
    {
        if (empty($id) || !is_numeric($id)) {
            return response()->json(['El ID '. $id . ' suministrado, no es un recurso disponible en este momento, reviselo']);
        }
        return $this->hotelInterface->destroy($id);
    }

    /**
     * List of hotels configuration rooms .
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        return $this->hotelInterface->assign($request);
    }

    /**
     * List resources cities.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function cities()
    {
        return $this->hotelInterface->cities();
    }

    /**
     * Room types resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        return $this->hotelInterface->roomTypes();
    }

    /**
     * Room accommodation type resource list.
     *
     * @return \Illuminate\Http\Response
     *  @param $roomTypeId
     */
    public function accommodationTypes(int $roomTypeId)
    {
        if (empty($roomTypeId) || !is_numeric($roomTypeId)) {
            return response()->json(['El ID '. $roomTypeId . ' suministrado, no es un recurso disponible en este momento, reviselo']);
        }
        return $this->hotelInterface->accommodationTypes($roomTypeId);
    }
}
