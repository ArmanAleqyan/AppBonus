<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use http\Env\Response;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function searchUser(Request  $request){


        if($request->search == null){
            return redirect()->route('GetUsers');
        }

        $get = User::where('login' , 'Like', '%'. $request->search.'%')->orderBy('id', 'desc')->paginate(20);


        return view('admin.Users.Search', compact('get'));
    }

    public function searchCompany(Request $request){
        if($request->search == null){
            return redirect()->route('Company');
        }

        $get = Company::where('company_name' , 'Like', '%'. $request->search.'%')->orderBy('id', 'desc')->paginate(20);


        return view('admin.Company.Search', compact('get'));

    }
}
