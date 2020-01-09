<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user) {
            return view('admin.profile.index',[ 'user' => $user ]);
        }
        
        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if ($user) {

            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email'],
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100',]
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }
            // 1.0 Alteração do nome
            $user->name = $data['name'];

            // 2.0 Alteração do e-mail
            // 2.1 Verifica se o email foi alterado
            if ($user->email != $data['email']) {
                // 2.2 verifica se o novo e-mail existe
                $hasEmail = User::where('email', $data['email'])->get();
                // 2.3 Se não existe, altera o e-mail
                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique',[
                        'attribute' => 'email'
                    ]));
                }
                
            }
            // 3.0 Alteração da senha
            // 3.1 Verifica se o usuário digitou senha
            if (!empty($data['password'])) {     
                // 3.1 Verifica se a senha tem mais de 4 caracteres
                if (strlen($data['password']) >= 4) {                    
                    // 3.3 Verifica a confirmação da senha
                    if ($data['password'] === $data['password_confirmation']) {                    
                        // 3.4 Altera a senha
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed',[
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }      
            }

            if ( count($validator->errors()) > 0 ) {
                return redirect()->route('profile', ['user' => $loggedId])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('profile')->with('success','Perfil alterado com sucesso!');
        }
        
        return redirect()->route('profile');
    }
}
