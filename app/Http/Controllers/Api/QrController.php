<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ScanState;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class QrController extends Controller
{

    /**
     * @OA\Get(
     * path="/api/ScanUser/user_id=1",
     * summary="ScanUser",
     * description="Veradarcnuma  Qr Code Activa te voch",
     * operationId="ScanUser",
     * tags={"Qr"},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Veradarcnuma  Qr Code Activa te voch",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function ScanUser($id){

        $get = User::where('id', $id)->first();



        if($get == null){
            return response()->json([
               'status' => false,
                'message' => 'wrong  user id'
            ]);
        }else{
            if($get->status == 'N' || $get->date  < Carbon::now()){
                return  \response()->json([
                   'status' => false,
                   'message' =>  'wrong  qr code'
                ], 422);
            }else{

                if(auth()->guard('api')->user() == null){
                    return \response()->json([
                       'status' =>  false,
                       'message' =>  'Token  error'
                    ], 422);
                }

                
                ScanState::create([
                    'user_id' => auth()->guard('api')->user()->id,
                    'company_id' => auth()->guard('api')->user()->Commpany->id,
                    'receiver_id' => $id
                ]);


                return \response()->json([
                   'status' => true,
                   'user' => $get,
                   'message' => 'Qr  code  active'
                ], 200);
            }
        }

    }
}
