<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\View;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();

        return new OrdersResource(true, 'Data Order Shuttle', $orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'idorder' => 'required|unique:orders,idorder',
            'busname' => 'required',
            'customername' => 'required',
            'customeremail' => 'required',
            'customerphone' => 'required|numeric',
            'customeraddress' => 'required',
            'total' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $orders = Orders::create(
                [
                    'idorder' => $request->idorder,
                    'busname' => $request->busname,
                    'customername' => $request->customername,
                    'customeremail' => $request->customeremail,
                    'customerphone' => $request->customerphone,
                    'customeraddress' => $request->customeraddress,
                    'total' => $request->total,
                    'price' => $request->price
                ]
                );

                return new OrdersResource(true, 'Data pemesanan berhasil tersimpan', $orders);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Orders::find($id);

        if($orders){
            return new OrdersResource(true, 'Data Order Shuttle Berhasil Ditemukan!', $orders);
        }else{
            return response()->json([
                'message' => 'Data Order Shuttle Tidak Ditemukan!'
            ], 422);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request   $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'busname' => 'required',
            'customername' => 'required',
            'customeremail' => 'required',
            'customerphone' => 'required|numeric',
            'customeraddress' => 'required',
            'total' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $orders = Orders::find($id);

            if ($orders) {
                $orders->busname = $request->busname;
                $orders->customername = $request->customername;
                $orders->customeremail = $request->customeremail;
                $orders->customerphone = $request->customerphone;
                $orders->customeraddress = $request->customeraddress;
                $orders->total = $request->total;
                $orders->price = $request->price;
                $orders->save();


                return new OrdersResource(true, 'Data Order Shuttle telah berhasil diperbarui!', $orders);
            } else {
                return response()->json([
                    'message' => 'Data Order Shuttle tidak ditemukan!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Orders::find($id);

            if ($orders) {
                $orders-> delete();


                return new OrdersResource(true, 'Data Order Shuttle telah berhasil dihapus!', '');
            } else {
                return response()->json([
                    'message' => 'Data Order Shuttle tidak ditemukan!'
                ]);
            }
    }
}
