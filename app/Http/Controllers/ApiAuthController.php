<?php
namespace App\Http\Controllers;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;
use Laravel\Passport\TokenRepository;
use App\Http\Resources\Users;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function handleRegister(RegisterFormRequest $request)
    {
     $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
      $token = $user->createToken('User')->accessToken;

      $user['token']=$token;

        return new Users($user);

    }
    public function handleLogin(LoginFormRequest $request)
    {
        $validated = $request->validated();

        $is_user = Auth::attempt(['email' => $validated['email'],
        'password' => $validated['password']]);
        
        if($is_user){
            $user = User::where('email', $validated['email'])->first();
            $token = $user->createToken('User')->accessToken;
            $user['token']=$token;

            return 'You are authenticated';
      
           
        }else{
                return 'You are not authenticated';
        }
    }

    public function handleLogout(Request $request)
    {
        auth()->user()->token()->revoke();
        return 'Suc';
    }
    
}
