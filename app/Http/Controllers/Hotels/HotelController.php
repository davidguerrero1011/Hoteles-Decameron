<?php

namespace App\Http\Controllers\Hotels;

use App\Classes\Hotels\HotelService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotels\HotelRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        try {
            $hotels = $this->hotel->index();

            return response()->json([
                'state' => 200,
                'message' => $hotels->isEmpty()
                    ? 'Todavía no hay hoteles registrados en el sistema'
                    : 'Hoteles obtenidos correctamente',
                'data' => $hotels
            ]);
        } catch (\Exception $e) {
            Log::info("Message Error: " . $e->getMessage());

            return response()->json([
                'state' => 500,
                'message' => 'Ocurrió un error al intentar mostrar los registros de los hoteles.',
                'data' => []
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        return $this->hotel->store($request);
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        try {
            $hotelDetail = $this->hotel->show($id);
            return response()->json(['state' => 200, 'data' => $hotelDetail]);
        } catch (\Throwable $e) {
            Log::info("error message: " . $e->get->getMessage());
            return response()->json(['state' => 500, 'message' => 'Algo ocurrio al intentar mostrar el detalle del hotel']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, int $id)
    {
        return $this->hotel->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->hotel->destroy($id);
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
    public function cities(int $id)
    {
        try {
            return response()->json(['state' => 201, 'data' => $this->hotel->cities($id)]);
        } catch (Exception $e) {
            Log::info("message error: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Ocurrio algo listado las ciudades']);
        }
    }

    /**
     * return room types resource list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        try {
            $roomTypes = $this->hotel->roomTypes();
            return response()->json(['state' => 200, 'data' => $roomTypes]);
        } catch (Exception $e) {
            Log::info("message error: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Hubo algún inconveniente listando los tipos de cuartos']);
        }
    }

    /**
     * return accommodations types by room types resource list
     * 
     *  @return \Illuminate\Http\Response
     */
    public function accommodationTypes(int $roomTypeId)
    {
        try {
            $roomTypes = $this->hotel->accommodationTypes($roomTypeId);
            return response()->json(['state' => 200, 'data' => $roomTypes]);
        } catch (Exception $e) {
            Log::info("message error: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Hubo algún incoveniente listando las acomodaciones']);
        }
    }
}
