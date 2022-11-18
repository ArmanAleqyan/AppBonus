<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\ReplayInfo;

class CompanyController extends Controller
{

    /**
     * @OA\Get(
     * path="/api/ActiveCompany",
     * summary="ActiveCompany",
     * description="Veradarcnuma  bolor  active  companyner@   sortavoruma  @st iranc tvac bonusneri  nvazman kargov",
     * operationId="ActiveCompany",
     * tags={"Company List"},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Veradarcnuma  bolor  active  companyner@   sortavoruma  @st iranc tvac bonusneri  nvazman kargov",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */


    public function ActiveCompany(){
        $company = Company::orderBy('bonus', 'desc')->where('status', 'Y')->where('date', '<', Carbon::now() )->get();
        return response()->json([
           'status' => true,
           'data' =>  $company
        ],200);
    }


    public function CompanyInfo(){
        $get = ReplayInfo::get();
        return response()->json([
           'status' => true,
           'data' => $get
        ], 200);
    }

}
