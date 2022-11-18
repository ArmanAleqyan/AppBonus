<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\ScanState;
use App\Models\ReplayInfo;
use App\Exports\UsersExport;
use App\Exports\AllUser;
use App\Exports\Companys;
use Maatwebsite\Excel\Facades\Excel;


class StateController extends Controller
{

    public function State(){
        $get = ScanState::with('ScanSender', 'ScanReceiver', 'StateCompany')->orderBy('id', 'desc')->paginate(20);

        return view('admin.State.AllState', compact('get'));
    }

    public function DownloadStateExcel(){
        return Excel::download(new UsersExport, 'Estadísticas_de_escaneo.xlsx');
    }

    public function DownloadUserExcel(){
        return Excel::download(new AllUser, 'una lista de usuarios.xlsx');
    }

    public function DownloadCompanyExcel(){
        return Excel::download(new Companys, 'Lista de empresas.xlsx');
    }

    public function UpdateInfo(Request $request){

            ReplayInfo::where('id', $request->info_id)->update([
               'email' => $request->email,
               'phone' => $request->phone
            ]);



            return redirect()->back();
    }

}
