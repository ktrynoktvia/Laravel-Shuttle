<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShuttlesResource;
use App\Models\Shuttles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\View;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class ShuttlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shuttles = Shuttles::all();

        return new ShuttlesResource(true, 'Data Bus Shuttle', $shuttles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'idbus' => 'required|unique:shuttles,idbus',
            'busname' => 'required',
            'location' => 'required',
            'address' => 'required',
            'website' => 'required',
            'email' => 'required|email|unique:shuttles,email',
            'callcenter' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $shuttles = Shuttles::create(
                [
                    'idbus' => $request->idbus,
                    'busname' => $request->busname,
                    'location' => $request->location,
                    'address' => $request->address,
                    'website' => $request->website,
                    'email' => $request->email,
                    'callcenter' => $request->callcenter
                ]
                );

                return new ShuttlesResource(true, 'Data berhasil tersimpan', $shuttles);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $shuttles = Shuttles::find($id);

        if($shuttles){
            return new ShuttlesResource(true, 'Data Bus Shuttle Ditemukan!', $shuttles);
        }else{
            return response()->json([
                'message' => 'Data Bus Shuttle Tidak Ditemukan!'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'busname' => 'required',
            'location' => 'required',
            'address' => 'required',
            'website' => 'required',
            'email' => 'required',
            'callcenter' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $shuttles = Shuttles::find($id);

            if ($shuttles) {
                $shuttles->busname = $request->busname;
                $shuttles->location = $request->location;
                $shuttles->address = $request->address;
                $shuttles->website = $request->website;
                $shuttles->email = $request->email;
                $shuttles->callcenter = $request->callcenter;
                $shuttles->save();


                return new ShuttlesResource(true, 'Data Bus Shuttle berhasil diperbarui!', $shuttles);
            } else {
                return response()->json([
                    'message' => 'Data Bus Shuttle tidak ditemukan!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $shuttles = Shuttles::find($id);

            if ($shuttles) {
                $shuttles-> delete();


                return new ShuttlesResource(true, 'Data Bus Shuttle berhasil dihapus!', $shuttles);
            } else {
                return response()->json([
                    'message' => 'Data Bus Shuttle tidak ditemukan!'
                ]);
            }
    }
}
