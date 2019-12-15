<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Validation\BookingValidation;
use App\Booking;
use App\Room;

class BookingsController extends Controller
{

    public function __construct(BookingValidation $bookValidate) {
        $this->bookingValidator = $bookValidate;
    }

    public function index()
    {
        abort_unless(\Gate::allows('booking_access'), 403);

        $bookings = Booking::orderby('from_date', 'desc')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('booking_create'), 403);

        return view('admin.bookings.create', ['rooms' => Room::all()]);
    }

    public function store(StoreBookingRequest $request)
    {
        abort_unless(\Gate::allows('booking_create'), 403);

        # Validação negocial
        $validation = $this->bookingValidator->validate($request->toArray());

        if (!$validation['success']) {
            return redirect()->back()->with('error', $validation['msg']);        
        }

        $booking = Booking::create($request->all());

        return redirect()->route('admin.bookings.index')->with('success', trans('global.save_success'));
    }

    public function edit(Booking $booking)
    {
        abort_unless(\Gate::allows('booking_edit'), 403);

        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        abort_unless(\Gate::allows('booking_edit'), 403);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', trans('global.save_success'));
    }

    public function show(Booking $booking)
    {
        abort_unless(\Gate::allows('booking_show'), 403);

        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_unless(\Gate::allows('booking_delete'), 403);

        $booking->delete();

        return back()->with('success', 'Registro excluído com sucesso');
    }

    public function massDestroy(MassDestroyBookingRequest $request)
    {
        Booking::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
