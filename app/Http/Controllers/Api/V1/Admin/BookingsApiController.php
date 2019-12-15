<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Booking;

class BookingsApiController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return $bookings;
    }

    public function store(StoreBookingRequest $request)
    {
        return Booking::create($request->all());
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        return $booking->update($request->all());
    }

    public function show(Booking $booking)
    {
        return $booking;
    }

    public function destroy(Booking $booking)
    {
        return $room->delete();
    }
}
