@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.store") }}" enctype="multipart/form-data">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                            <option value="{{$room->id}}">{{ $room->name }} - capacidade para {{ $room->capacity }} pessoa(s)</option>
                        @endforeach
                    </select>
                </div>  

                @if($errors->has('room_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('room_id') }}
                    </em>
                @endif

            <!-- Botão para acionar modal -->
            <a href="{{ route('admin.bookings.verifyRoom', ['room_id' => '1']) }}" 
                data-endpoint="{{ route('admin.bookings.verifyRoom', ['room_id' => '1']) }}" 
                data-toggle="modal" 
                data-target="#modalExemplo"
                data-cache="false",
                data-async="true">Verificar Reservas das Salas</a>
            </div>

            <div class="form-group">
                <label for="from_date">{{ trans('cruds.booking.fields.from_date') }}</label>
                <input class="form-control datetime {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text" name="from_date" id="from_date" value="{{ old('from_date') }}"
                onblur="$('#to_date').val(this.value)">
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

<!-- Modal de Disponibilidade -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datas Reservadas das Salas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id='result'>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</div>

@endsection

@section('scripts')
<script>

$('a[data-async="true"]').click(function(e){
    e.preventDefault();
    var self = $(this),
        url = self.data('endpoint'),
        target = self.data('target'),
        cache = self.data('cache');

    $.ajax({
        url: url,
        cache : cache,
        success: function(data){ 
           if (target !== 'undefined'){
                $('#result').html(data);
            }
        }
    });
});
</script>
@endsection