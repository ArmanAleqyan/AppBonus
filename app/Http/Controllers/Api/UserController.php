<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Validator;

use App\Mail\RegMail;

class UserController extends Controller
{

    /**
     * @OA\Post(
     * path="/api/register",
     * summary="register",
     * description="register",
     * operationId="register",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", format="text", example="ФИО"),
     *       @OA\Property(property="phone", type="string", format="text", example="+37493073584"),
     *       @OA\Property(property="email", type="string", format="email", example="arman-aleqyan@mail.ru"),
     *       @OA\Property(property="password", type="string", format="text", example="11111111"),
     *       @OA\Property(property="password_confirmation", type="string", format="text", example="11111111"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="register created",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */


    public function register(Request $request){
        $rules=array(
            'name' =>                              'required|max:254',
            'phone'  =>                               "required|max:254",
            'email' =>                             'required|max:254|email',
            'password' =>                          'required|min:6|max:254',
            'password_confirmation' => 'required_with:password|same:password|min:6|max:254',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }

        $rand = random_int(10000,99999);
        $get = User::where('login', $request->email)->first();
        if($get == null){
            $user =  User::create([
                'phone' => $request->phone,
                'login' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'veryfi_code' => $rand,
                'role_id' =>3,
                'status' => 'N'
            ]);

            $to      = $request->email;
            $subject = 'codigo de confirmacion';
            $message = 'su codigo de verificacion'.' '. $rand;
            $headers = 'From: info@cyberdatacontrol.com' . "\r\n" .
                'Reply-To: info@cyberdatacontrol.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
          //  Mail::to($request->email)->send(new RegMail($details));
            Auth::login($user);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return response()->json([
               'status' => true,
                'message' =>  'user created',
                'token' => $token
            ], 200);
        }else{
            if($get->veryfi_code == 1){
                return \response()->json([
                   'status' => false,
                   'message' =>  'user Alredi exist'
                ], 422);
            }else{
                Auth::login($get);
                User::where('id', auth()->user()->id)->update([
                   'veryfi_code' => $rand,
                ]);
                $to      = $get->login;
                $subject = 'codigo de confirmacion';
                $message = 'su codigo de verificacion'.' '. $rand;
                $headers = 'From: info@cyberdatacontrol.com'       . "\r\n" .
                    'Reply-To: info@cyberdatacontrol.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
                $token = $get->createToken('Laravel Password Grant Client')->accessToken;
                return \response()->json([
                   'status' => true,
                    'message' => 'no verify user',
                    'token' => $token
                ],202);
            }
        }
    }


    /**
     * @OA\Post(
     * path="/api/VerifyRegister",
     * summary="VerifyRegister",
     * description="VerifyRegister",
     * operationId="VerifyRegister",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="code", type="string", format="text", example="12345"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="VerifyRegister",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function VerifyRegister(Request $request ){
        $rules=array(
            'code' => 'required|max:254',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }

        $get = User::where('id', auth()->guard('api')->user()->id)->where('veryfi_code', $request->code)->first();
        if($get == null){
           return \response()->json([
               'status' => true,
               'message' => 'wrong code',
           ]) ;
        }else{
            $get = User::where('id', auth()->guard('api')->user()->id)->update(['veryfi_code' => 1]);

            return \response()->json([
               'status' => true,
               'message' => 'code true'
            ]);
        }
    }


    /**
     * @OA\Post(
     * path="/api/SendNewCode",
     * summary="SendNewCode",
     * description="SendNewCode",
     * operationId="SendNewCode",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="uxarkum eq  datark zapros   headersum  token@  vorpesi es noric  mailin cod  uxarkem",
     *    @OA\JsonContent(

     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="SendNewCode",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */


    public function SendNewCode(Request $request){
        $rand = random_int(10000,99999);
        $user = User::where('id', auth()->guard('api')->user()->id)->update(['veryfi_code'=> $rand]);
        $to      = auth()->guard('api')->user()->login;
        $subject = 'codigo de confirmacion';
        $message = 'su codigo de verificacion'.' '. $rand;
        $headers = 'From: info@cyberdatacontrol.com'       . "\r\n" .
            'Reply-To: info@cyberdatacontrol.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);

        return \response()->json([
           'status' => true,
           'message'  => 'code send your email'
        ], 200);
    }


    /**
     * @OA\Post(
     * path="/api/ForgotPassword",
     * summary="ForgotPassword",
     * description="ForgotPassword",
     * operationId="ForgotPassword",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="uxarkum eq  grancvac  mail@  zabil parol functional@ ashxatacnelu hamar  ete mail@ goyutyun chuni stanum eq wrong user email ev tvyal mail@ pahum eq  storagum vorpesi hajord zaprosum eli uxarkeq takic",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="text", example="arman-aleqyan@mail.ru"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="ForgotPassword",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function ForgotPassword(Request $request){

        $rules=array(
            'email' => 'required|max:254',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }

        $rand = random_int(10000,99999);
        $get = User::where('login', $request->email)->first();
        if($get ==null){
            return \response()->json([
               'status' => false,
                'message' => 'wrong user email'
            ]);
        }else{
            $to      = $get->login;
            $subject = 'codigo de confirmacion';
            $message = 'su codigo de verificacion'.' '. $rand;
            $headers = 'From: info@cyberdatacontrol.com'       . "\r\n" .
                'Reply-To: info@cyberdatacontrol.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);


            User::where('login', $request->email)->update([
               'forgot_code' => $rand
            ]);
            return \response()->json([
               'status' => true,
               'message' => 'code send your email'
            ], 200);
        }
    }


    /**
     * @OA\Post(
     * path="/api/ResetCodePassword",
     * summary="ResetCodePassword",
     * description="ResetCodePassword",
     * operationId="ResetCodePassword",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="uxarkum eq storagum pahvac  email@  ev  mailin ekac  kod@  stanumeq kam chishta kam sxala ev  tvyal kod@ ev mail@  pahumeq  storagum  vorpesi hajord zaprosin uxarkeq",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="text", example="arman-aleqyan@mail.ru"),
     *       @OA\Property(property="forgot_code", type="string", format="text", example="12345"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="ResetCodePassword",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function ResetCodePassword(Request $request){
        $rules=array(
            'email' => 'required|max:254',
            'forgot_code' => 'required|max:254',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $get = User::where('login', $request->email)->where('forgot_code', $request->forgot_code)->first();
        if($get == null){
            return \response()->json([
               'status' => false,
               'message' =>  'wrong code'
            ],422);
        }else{
            return \response()->json([
               'status' => true,
               'message' => 'code true'
            ]);
        }
    }


    /**
     * @OA\Post(
     * path="/api/NewPassword",
     * summary="NewPassword",
     * description="NewPassword",
     * operationId="NewPassword",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="uxarkum eq  storage mail@ ev cod@   ev nor password@  ",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="text", example="arman-aleqyan@mail.ru"),
     *       @OA\Property(property="forgot_code", type="string", format="text", example="12345"),
     *       @OA\Property(property="password", type="string", format="text", example="11111111"),
     *       @OA\Property(property="password_confirmation", type="string", format="text", example="11111111"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="NewPassword",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function NewPassword(Request $request){
        $rules=array(
            'email' => 'required|max:254',
            'forgot_code' => 'required|max:254',
            'password' =>                          'required|min:6|max:254',
            'password_confirmation' => 'required_with:password|same:password|min:6|max:254',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }

        $user = User::where('login', $request->email)->where('forgot_code', $request->forgot_code)->update([
           'password' => Hash::make($request->password),
            'forgot_code' => null
        ]);


        return \response()->json([
           'status' => true,
           'message' => 'password updated'
        ], 200);
    }



    /**
     * @OA\Post(
     * path="/api/UserLogin",
     * summary="UserLogin",
     * description="UserLogin",
     * operationId="UserLogin",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="uxarkum eq  login keyov  mail@   mekel password@     role_id =2  da menegerna  role_id=3 da appic  ogtvox sovorakan userna",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="text", example="arman-aleqyan@mail.ru"),
     *       @OA\Property(property="password", type="string", format="text", example="11111111"),

     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="UserLogin",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function UserLogin(Request $request){
        $rules=array(
            'login' => 'required|max:254',
            'password' =>  'required|max:254',

        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $getUser = User::where('login', $request->login)->first();
        if($getUser == null){

            return \response()->json([
               'status' => false,
               'message' => 'wrong  email'
            ],422);
        }else{
            $data = $request->all();
            $login = Auth::attempt($data);


            if($login == false){
                return \response()->json([
                   'status' => false,
                   'message' => 'wrong password'
                ]);
            }else{
                $token = \auth()->user()->createToken('Laravel Password Grant Client')->accessToken;

                if(auth()->user()->veryfi_code != 1){
                    $rand = random_int(10000,99999);
                    $to      = $request->login;
                    $subject = 'codigo de confirmacion';
                    $message = 'su codigo de verificacion'.' '. $rand;
                    $headers = 'From: info@cyberdatacontrol.com'       . "\r\n" .
                        'Reply-To: info@cyberdatacontrol.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                    User::where('id', auth()->user()->id)->update(['veryfi_code'=> $rand]);
                    if(auth()->user()->date < Carbon::now()){
                        $status = false;
                    }else{
                        $status = true;
                    }
                    return \response()->json([
                       'status' => true,
                       'message' =>  'no veryfi user',
                        'role_id' => \auth()->user()->role_id,
                        'user' =>  \auth()->user(),
                        'token' => $token,
                        'QrStatus' => $status
                    ]);
                }else{
                    if(auth()->user()->role_id == 3){
                        if(auth()->user()->date < Carbon::now()){
                            $status = false;
                        }else{
                            $status = true;
                        }
                        return \response()->json([
                            'status' => true,
                            'message' => 'veryfi user',
                            'role_id' => auth()->user()->role_id,
                            'user' => \auth()->user(),
                            'token' => $token,
                            'QrStatus' =>  $status
                        ]);
                    }
                    if(auth()->user()->role_id == 2){
                        if(auth()->user()->Commpany->date < Carbon::now()){
                            return \response()->json([
                               'status' => false,
                               'message' =>  'Admin is blocket your company'
                            ]);
                        }else{
                            return \response()->json([
                                'status' => true,
                                'message' => 'veryfi user',
                                'role_id' => auth()->user()->role_id,
                                'user' => \auth()->user(),
                                'token' => $token,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
