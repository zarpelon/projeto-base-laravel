<?php

namespace App\Http\Requests;

use App\Room;
use App\Booking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id'   => 'required',
            'room_id'   => 'required',
            'from_date' => 'date_format:d/m/Y H:i:s|after_or_equal:now'
        ];
    }
}
