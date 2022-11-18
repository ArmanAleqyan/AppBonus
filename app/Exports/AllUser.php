<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllUser implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $user = User::where('role_id', 3)->OrderBy('id', 'desc')->get();

        return view('ExportExele.AllUser', compact('user'));
    }
//    public function collection()
//    {
//        return User::OrderBy('id','desc')->get();
//    }
}
