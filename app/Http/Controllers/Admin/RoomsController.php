<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Room;

class RoomsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('room_access'), 403);

        $rooms = Room::all();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('room_create'), 403);

        return view('admin.rooms.create');
    }

    public function store(StoreRoomRequest $request)
    {
        abort_unless(\Gate::allows('room_create'), 403);

        $room = Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', trans('global.save_success'));
    }

    public function edit(Room $room)
    {
        abort_unless(\Gate::allows('room_edit'), 403);

        return view('admin.rooms.edit', compact('room'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        abort_unless(\Gate::allows('room_edit'), 403);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', trans('global.save_success'));
    }

    public function show(Room $room)
    {
        abort_unless(\Gate::allows('room_show'), 403);

        return view('admin.rooms.show', compact('room'));
    }

    public function destroy(Room $room)
    {
        abort_unless(\Gate::allows('room_delete'), 403);

        $room->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoomRequest $request)
    {
        Room::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
