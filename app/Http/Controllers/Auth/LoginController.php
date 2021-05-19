<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
            
        if(auth()->attempt(array('username' => $input['username'], 'password' => $input['password'], 'registration_payment' => 'Yes')))
        {
            $user = User::where('id', Auth::user()->id)->first();
            // if($user->status == "Deactive")
            // {
            //     Auth::logout();
            //     return redirect('/login')->with('danger', 'Your Account is not Activated');
            // }
            return redirect()->route('home');
        }else{
            return redirect()->route('login')
                ->with('danger','Username And Password Are Wrong.');
        }
          
    
          
    }
}