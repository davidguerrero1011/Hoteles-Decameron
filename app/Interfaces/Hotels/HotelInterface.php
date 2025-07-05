<?php

namespace App\Interfaces\Hotels;

use Illuminate\Http\Request;

interface HotelInterface
{
    public function index();
    public function store(array $request);
    public function show(int $id);
    public function update(array $request, int $id);
    public function destroy(int $id);
    public function assign(Request $request);
    public function cities();
    public function roomTypes();
    public function accommodationTypes(int $roomTypeId);
}
