<?php

namespace App\Exports;

use App\Models\ScanState;
use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */




    public function view(): View
    {
                $State  = ScanState::OrderBy('id','desc')->with('ScanSender', 'ScanReceiver','StateCompany')->get()->unique('receiver_id');
                $company = Company::OrderBy('id', 'desc')->get();
                return view('ExportExele.History', compact('State', 'company'));
    }





}
