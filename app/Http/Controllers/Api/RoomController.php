<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoomRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\RoomsStoreRequest;
use App\Http\Requests\RoomUpdateRequests;
use App\Http\Controllers\Controllers;

class RoomController extends BaseController
{
    public function index( )
    {
        $roomsList = DB::table('rooms')->orderby('id','ASC')->get();
        return api_success(['data' => $roomsList],"");    
    }

     public function store(RoomsStoreRequest $request)
    {
        $rooms = Room::create($request->all());
        if ($rooms) {
        	return api_errors(400, ['errors' =>'this room does not exitst']);
        }else{
        	return api_success(['room' => $rooms]);
        }
       $rooms = Room::create($request->all());
        return api_success(['data' => $rooms], 200);
    }
    public function update(RoomUpdateRequests $request, $id)
    {
        $rooms = Room::findOrFail($id);
        $rooms->Update($request->all());

        return api_success(['data' => $rooms], 200);
    }
    public function destroy($id)
    {
        Room::destroy($id);
        return api_success(['message' => 'Delete Room'], 200);
    }

}
