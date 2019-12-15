@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.update", [$booking->id]) }}" enctype="multipart/form-data">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.booking.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ Auth::user()->name }}" readonly="readonly">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.name_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('room_id') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="room_id">{{ trans('cruds.booking.fields.room') }}</label>
                    <select class="form-control" id="room_id" name="room_id">
                        <option value="">Selecione</option>
                        @foreach($rooms as $room)
                            @php 
                                $selected = ($booking->room_id == $room->id) ? "selected='selected'" : ""
                            @endphp
                            <option {{ $selected }} value="{{$room->id}}">{{ $room->name }} - capacidade para {{ $room->capacity }} pessoa(s)</option>
                        @endforeach
                    </select>
                </div>  
                @if($errors->has('room_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('room_id') }}
                    </em>
                @endif
            </div>

            <div class="form-group">
                <label for="from_date">{{ trans('cruds.booking.fields.from_date') }}</label>
                <input class="form-control datetime {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text" name="from_date" id="from_date" value="{{ $booking->from_date }}">
                @if($errors->has('from_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.from_date_helper') }}</span>
            </div>

            <div class="alert alert-info alert-block">
                <strong>Todas as reservas de sala tem duração de 1 hora a partir do período inicial.</strong>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>

$('#from_date').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1,
    onSelect: function () {
        $('#edate').val(this.value);
    }
});


</script>
@endsection