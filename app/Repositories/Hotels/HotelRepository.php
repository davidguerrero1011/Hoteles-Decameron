<?php

namespace App\Repositories\Hotels;

use App\Interfaces\Hotels\HotelInterface;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\HotelRoomConfigurations;
use App\Models\Hotels;
use App\Models\RoomTypeAccommodation;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

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
    public function store(array $request)
    {
        $request['status'] = isset($request['status']) && $request['status'] == 1 ? 1 : 0;
        return Hotels::create($request);
    }

    /**
     * Show hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function show(int $id)
    {
        return $this->hotels::where('id', $id)->first();
    }

    /**
     * Update hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id, $request
     */
    public function update(array $request, int $id)
    {
        $hotelUpdate = $this->hotels::find($id);
        $request["status"] = $request["status"] == 1 ? 0 : 1;
        $hotelUpdate->update($request);

        return $hotelUpdate;
    }

    /**
     * Destroy hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function destroy(int $id)
    {
        $this->hotelRoomConfigurations::where('hotel_id', $id)->delete();
        $deleteHotel = $this->hotels::where('id', $id)->delete();
        return $deleteHotel;
    }

    /**
     * Configuration rooms by hotel resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $request
     */
    public function assign(Request $request)
    {
        $hotelId = $request->hotel_id;
        $roomTypeId = $request->room_type_id;
        $accommodationId = $request->acommodation_type_id;
        $amount = $request->amont;

        $invalidAccommodation = RoomTypeAccommodation::where([
            ['room_type_id', $roomTypeId],
            ['accommodation_type_id', $accommodationId]
        ])->doesntExist();

        if ($invalidAccommodation) {
            return response()->json(['message' => 'La acomodación no esta configurada al tipo de habitación.']);
        }

        $duplicateConfig = $this->hotelRoomConfigurations::where([
            ['hotel_id', $hotelId],
            ['room_type_id', $roomTypeId],
            ['acommodation_type_id', $accommodationId]
        ])->exists();

        if ($duplicateConfig) {
            return response()->json(['message' => 'La configuración que usted desea crear ya existe.']);
        }

        $hotel = $this->hotels::find($hotelId);
        if (!$hotel) {
            return response()->json(['message' => 'El hotel no existe.']);
        }

        $roomsHotel = $this->hotelRoomConfigurations::where('hotel_id', $hotelId)->sum('room_number');
        $configurationRooms = $amount + $roomsHotel;

        if ($hotel->rooms_capacity < $configurationRooms) {
            return response()->json(['message' => 'La cantidad de cuartos configurados no pueden ser mayores a los creados para este hotel']);
        }

        $this->hotelRoomConfigurations::create([
            'hotel_id'             => $hotelId,
            'room_type_id'         => $roomTypeId,
            'acommodation_type_id' => $accommodationId,
            'room_number'          => $amount,
            'floor'                => 1,
            'created_at'           => now(),
            'updated_at'           => now()
        ]);

        return response()->json(['message' => 'La configuracion de su hotel fue creada con exito'], Response::HTTP_OK);
    }

    /**
     * Cities List resouce.
     *
     * @return \Illuminate\Http\Response
     * @param $id
     */
    public function cities()
    {
        $country = Countries::where('name', 'Colombia')->first();
        return Cities::where('country_id', $country->id)->get();
    }

    /**
     * Room Types List resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomTypes()
    {
        return RoomTypes::all();
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
            ->where('room_type_accommodations.room_type_id', $roomTypeId)
            ->get();
    }
}
