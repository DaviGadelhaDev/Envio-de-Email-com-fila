<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Jobs\JobSendWelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendWelcomeEmail;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $request->validated();

        DB::beginTransaction();
        try {   
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  bcrypt($request->password),
            ]);
            //Enviar o email
            //Mail::to($user->email)->send(new SendWelcomeEmail($user));

            //Agendar
            JobSendWelcomeEmail::dispatch($user->id)->onQueue('default');
            DB::commit();
            return redirect()->route('user.create')->with('success', 'Usuário cadastrado com sucesso');
        }catch(Exception){
            DB::rollBack();
            return back()->withInput()->with('error', 'Usuário não cadastrado');
        }

    }   
}
