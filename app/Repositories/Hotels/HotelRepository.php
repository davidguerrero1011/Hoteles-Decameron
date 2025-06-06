<?php

namespace App\Repositories\Hotels;

use App\Http\Requests\Hotels\HotelRequest;
use App\Interfaces\Hotels\HotelInterface;
use App\Models\Cities;
use App\Models\HotelRoomConfigurations;
use App\Models\Hotels;
use App\Models\RoomTypeAccommodation;
use App\Models\RoomTypes;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HotelRepository implements HotelInterface
{

    public function __construct(public Hotels $hotels, public HotelRoomConfigurations $hotelRoomConfigurations) {}

    /**
     * hotels query.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->hotels::with('city')->get();
    }

    /**
     * Store hotels resource.
     *
     * @return \Illuminate\Http\Response
     * @param $request
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validated();

            $existHotel = $this->hotels::where(function ($query) use ($validate) {
                $query->where('name', 'LIKE', '%' . $validate['name'] . '%')
                    ->orWhere('nit', 'LIKE', '%' . $validate['nit'] . '%');
            })->exists();

            if ($existHotel) {
                return response()->json(['state' => 409, 'message' => 'El hotel ya existe, no puede crear un hotel con el mismo nombre.']);
            }

            $validate['status'] = filter_var($validate['status'], FILTER_VALIDATE_BOOLEAN);
            Hotels::create($validate);
            return response()->json(['state' => 200, 'message' => 'Fue creado de manera exitosa el hotel.']);
        } catch (Exception $e) {
            Log::info("Message Error: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Ocurrio algún suceso a la hora de crear el hotel.']);
        }
    }

    /**
     * Show hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function show($id)
    {
        return $this->hotels::where('id', $id)->first();
    }

    /**
     * Update hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id, $request
     */
    public function update(HotelRequest $request, int $id)
    {
        $validate = $request->validated();
        try {
            $hotelUpdate = $this->hotels::find($id);
            $hotelUpdate->update($validate);

            return response()->json(['state' => 200, 'message' => 'La información del hotel fue actualizada con exito.']);
        } catch (Exception $e) {
            Log::info("error message: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Hubo algún incoveniente actualizando la información del hotel.']);
        }
    }

    /**
     * Destroy hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function destroy(int $id)
    {
        try {
            $this->hotelRoomConfigurations::where('hotel_id', $id)->delete();
            $this->hotels::where('id', $id)->delete();

            return response()->json(['state' => 200, 'message' => 'El hotel con su respectiva configuracion fue borrado exitosamente.']);
        } catch (Exception $e) {
            Log::info("error message: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Hubo un inconveniente en eñ borrado del hotel.']);
        }
    }

    /**
     * Configuration rooms by hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $request
     */
    public function assign(Request $request)
    {
        try {
            $hotelId = $request->hotel_id;
            $roomTypeId = $request->room_type_id;
            $accommodationId = $request->acommodation_type_id;
            $amount = $request->amont;

            $invalidAccommodation = RoomTypeAccommodation::where([
                ['room_type_id', $roomTypeId],
                ['accommodation_type_id', $accommodationId]
            ])->doesntExist();

            if ($invalidAccommodation) {
                return response()->json(['state' => 204, 'message' => 'La acomodación no esta configurada al tipo de habitación.']);
            }

            $duplicateConfig = $this->hotelRoomConfigurations::where([
                ['hotel_id', $hotelId],
                ['room_type_id', $roomTypeId],
                ['acommodation_type_id', $accommodationId]
            ])->exists();

            if ($duplicateConfig) {
                return response()->json(['state' => 204, 'message' => 'La configuración que usted desea crear ya existe.']);
            }

            $hotel = $this->hotels::find($hotelId);
            if (!$hotel) {
                return response()->json(['state' => 204, 'message' => 'El hotel no existe.']);
            }

            $roomsHotel = $this->hotelRoomConfigurations::where('hotel_id', $hotelId)->sum('amont');
            $configurationRooms = $amount + $roomsHotel;

            if ($hotel->rooms < $configurationRooms) {
                return response()->json(['state' => 204, 'message' => 'La cantidad de cuartos configurados no pueden ser mayores a los creados para este hotel']);
            }

            $this->hotelRoomConfigurations::create([
                'hotel_id' => $hotelId,
                'room_type_id'         => $roomTypeId,
                'acommodation_type_id' => $accommodationId,
                'amont'                => $amount,
                'status'               => true,
                'created_at'           => now(),
                'updated_at'           => now()
            ]);

            return response()->json(['state' => 200, 'message' => 'La configuracion del hotel fue creada con exito']);
        } catch (Exception $e) {
            Log::info("message error: " . $e->getMessage());
            return response()->json(['state' => 500, 'message' => 'Hubo algún inconveniente creando la configuración del hotel']);
        }
    }

    /**
     * Cities List resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function cities(int $id)
    {
        return Cities::where('country_id', $id)->get();
    }

    /**
     * Room Types List resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        return RoomTypes::where('status', true)->get();
    }

    /**
     * Accomodation Types Query.
     * @param $roomTypeId
     *
     * @return \Illuminate\Http\Response
     */
    public function accommodationTypes(int $roomTypeId)
    {
        return RoomTypeAccommodation::join('acommodation_types AS at', 'room_type_accommodations.accommodation_type_id', '=', 'at.id')
            ->where([['at.status', true], ['room_type_accommodations.room_type_id', $roomTypeId]])
            ->get();
    }
}