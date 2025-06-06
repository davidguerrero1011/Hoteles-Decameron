<?php

namespace App\Interfaces\Hotels;

use App\Http\Requests\Hotels\HotelRequest;
use Illuminate\Http\Request;

interface HotelInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(HotelRequest $request, int $id);
    public function destroy(int $id);
    public function assign(Request $request);
    public function cities(int $id);
}
