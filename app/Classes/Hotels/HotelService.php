<?php

namespace App\Classes\Hotels;

use App\Http\Requests\Hotels\HotelRequest;
use App\Repositories\Hotels\HotelRepository;
use Illuminate\Http\Request;

class HotelService
{

    public function __construct(public HotelRepository $hotelRepository) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->hotelRepository->index();
    }

    /**
     * store a resource.
     *
     */
    public function store(Request $request)
    {
        return $this->hotelRepository->store($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->hotelRepository->show($id);
    }

    /**
     * update a resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(HotelRequest $request, int $id)
    {
        return $this->hotelRepository->update($request, $id);
    }

    /**
     * Destroy a resource.
     *
     * @param $id
     */
    public function destroy(int $id)
    {
        return $this->hotelRepository->destroy($id);
    }

    /**
     * List of hotels configuration rooms .
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        return $this->hotelRepository->assign($request);
    }

    /**
     * List resources cities.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function cities(int $id)
    {
        return $this->hotelRepository->cities($id);
    }

    /**
     * Room types resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        return $this->hotelRepository->roomTypes();
    }

    /**
     * Room accommodation type resource list.
     *
     * @return \Illuminate\Http\Response
     *  @param $roomTypeId
     */
    public function accommodationTypes(int $roomTypeId)
    {
        return $this->hotelRepository->accommodationTypes($roomTypeId);
    }
}
