<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SetPasswordMail;
use Illuminate\Support\Facades\URL;


class UserController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $customMessages = [
            'email.required' => 'Vul aub uw e-mailadres in.',
            'email.email' => 'Vul aub een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al geregistreerd.',
            'name.required' => 'Vul aub uw naam in.',
        ];
    
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ], $customMessages);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'passwordCode' => Str::random(40), // Genereer een willekeurige code
        ]);

        // Genereer de URL met de verificatiecode als parameter
        $verificationUrl = URL::to('/set-password/' . $user->passwordCode);

        Mail::to($user->email)->send(new SetPasswordMail($verificationUrl)); // Stuur de URL in de e-mail

        return redirect('/register')->with('success', 'Check je e-mail voor instructies om je wachtwoord in te stellen.');
    }

    public function setPasswordForm($code)
    {
        $user = User::where('passwordCode', $code)->firstOrFail();
        return view('set-password', compact('user'));
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',           
                'regex:/[A-Z]/',   
                'regex:/\d{2}/',   
                'regex:/[!@#$%^&*]/',
                'confirmed',       
            ],
            'password_confirmation' => 'required|string',
            'passwordCode' => 'required',  
        ]);
    
        $user = User::where('passwordCode', $request->passwordCode)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->passwordCode = null; // Assuming you want to nullify the passwordCode after setting the password
        $user->save();
    
        return redirect('/login')->with('success', 'Wachtwoord ingesteld! Log nu in.');
    }
    
}
?>
