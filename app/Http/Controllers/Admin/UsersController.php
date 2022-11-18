<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ScanState;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use App\Models\Company;
use phpseclib3\File\ASN1\Maps\RelativeDistinguishedName;

class UsersController extends Controller
{

    public function GetUsers(){
        $get = User::where('role_id', 3)->orderBy('id', 'Desc')->paginate(20);
        return view('admin.Users.User',compact('get'));

    }

    public function NewUser(){
        return view('admin.Users.newuser');
    }

    public function CreateUser(CreateUser $request){


        if($request->TrueOrFalse == 'Y'){
            $status = 'Y';
            $date = $request->date;
        }else{
            $status = "N";
            $date = null;
        }


        $create = User::create([
          'company_id' => $request->company_id,
             'login'  => $request->login,
          'password' => Hash::make($request->password),
          'name' => $request->name,
          'phone' => $request->phone,
          'role_id' => $request->role_id,
          'status' => $status,
          'date' => $date,
            'veryfi_code' => 1,
            'origin_password' => $request->password
      ]);

        if($create->role_id == 3){
            return redirect()->back()->with('UserCreated', 'UserCreated');
        }

    }


    public function ShowUser($id){
        $getUser = User::where('id', $id)->get();
        return view('admin.Users.newuser', compact('getUser'));
    }

    public function deleteUser($id){
        $get = User::where('id', $id)->first();

        ScanState::where('receiver_id', $id)->delete();

        $delete  = User::where('id', $id)->delete();

        if($get->role_id == 3){
            return redirect()->route('GetUsers')->with('delete','delete');
        }
    }


    public function Updateuser(Request $request ){
        $user = User::where('id', $request->user_id);
        $get= User::where('id', $request->user_id)->first();
        if(isset($request->password)){
            $user->update(['password' => Hash::make($request->password) , 'origin_password' => $request->password  ]);
        }
        if(isset($request->name)){
            $user->update(['name' => $request->name]);
        }
        if(isset($request->phone)){
            $user->update(['phone' => $request->phone]);
        }
        if(isset($request->login)){
            $user->update(['login' => $request->login]);
        }
        if (isset($request->TrueOrFalse)){
            $user->update([
                'status' => $request->TrueOrFalse
            ]);
            if($request->TrueOrFalse == 'Y'){
                if($get->status == 'N'){
                    $user->update(['date' => $request->dates]);
                }else{
                    $user->update(['date' => $request->date]);
                }
            }else{
                $user->update(['date' => NULL]);
            }

        }


        return redirect()->back()->with('updated','updated');
    }

    public function Company(){
        $get = Company::orderBy('id', 'desc')->paginate(20);
        return view('admin.Company.AllCompany', compact('get'));
    }

    public function CreateNewCompany(){
        return view('admin.Company.newCompany');
    }

    public function CreateCompany(CompanyRequest $request){
        $create = Company::create([
            'company_name' => $request->company_name,
            'address' => $request->address,
            'bonus' => $request->bonus,
            'phone' => $request->phone,
            'status' => $request->TrueOrFalse,
            'date' => $request->date
            ]);
        return redirect()->back()->with('created', 'created');
    }


    public function ShowCompany($id){
        $get = Company::where('id', $id)->get();
        $user = User::with('Commpany')->orderBy('id','desc')->where('company_id', $id)->get();
        return view('admin.Company.newCompany', compact('get', 'user'));
    }

    public function UpdateCompany(Request $request){



        $get =  Company::where('id', $request->company_id)->first();

        if($get->status == 'Y'){
            Company::where('id', $request->company_id)->update([
               'date'  =>$request->dates
            ]);
        }else{
            Company::where('id', $request->company_id)->update([
                'date' => $request->date
            ]);
        }

            $USER = Company::where('id', $request->company_id)->update([
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'bonus'=> $request->bonus,
                'status' =>  $request->TrueOrFalse,
               // 'date' => $request->date
            ]);
            return redirect()->back()->with('updated', 'updated');
    }


    public function CreateNewMeanger(Request $request){



        $get = User::where('login', $request->login)->get();


        $a = filter_var($request->login, FILTER_VALIDATE_EMAIL);



        if(!$get->isEmpty() || $a == false ){
            return response()->json([
               'status' => false,
               'message' => 'User exist'
            ]);
        }else{
            User::create([
               'login' => $request->login,
               'password' =>  Hash::make($request->password),
                'origin_password' =>  $request->password,
                'company_id' => $request->company_id,
                'status' =>  'Y',
                'veryfi_code' => 1,
                'role_id' => 2,
                'phone' => $request->phone,
                'name' => $request->name
                
            ]);


            return redirect()->back()->with('true', 'true');
        }
    }

    public function UpdateMeaneger(Request $request){
        $get = User::where('login', $request->login)->where('id' , '!=', $request->user_id)->get();
        $a = filter_var($request->login, FILTER_VALIDATE_EMAIL);
        if(!$get->isEmpty() || $a == false) {
            return response()->json([
                'status' => false,
                'message' => 'User exist'
            ]);
        }else{
         $user  =   User::where('id', $request->user_id);

        if(isset($request->password)){
            $user->update(['password' => Hash::make($request->password), 'origin_password' =>  $request->password]);
        }
        $user->update([
           'login' => $request->login,
            'status' => 'Y',
            'phone' => $request->phone,
            'name' => $request->name
        ]);

        return redirect()->back();
        }


    }

}
