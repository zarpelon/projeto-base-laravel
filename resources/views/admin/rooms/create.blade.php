@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.room.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rooms.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.room.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.room.fields.name_helper') }}</span>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.room.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($room) ? $room->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.room.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
                <label for="capacity">{{ trans('cruds.room.fields.capacity') }}</label>
                <input type="number" step="1" pattern="\d+" id="capacity" name="capacity" class="form-control" value="{{ old('capacity', isset($room) ? $room->capacity : '') }}" step="0.01">
                @if($errors->has('capacity'))
                    <em class="invalid-feedback">
                        {{ $errors->first('capacity') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.room.fields.capacity_helper') }}
                </p>
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