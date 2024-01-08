<?php
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = User::create([
            'email' => $request->email,
            'verification_code' => Str::random(40), // Genereer een willekeurige code
        ]);

        Mail::to($user->email)->send(new SetPasswordMail($user->verification_code));

        return redirect('/register')->with('success', 'Check je e-mail voor instructies om je wachtwoord in te stellen.');
    }

    public function setPasswordForm($code)
    {
        $user = User::where('verification_code', $code)->firstOrFail();
        return view('set-password', compact('user'));
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('verification_code', $request->verification_code)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->verification_code = null;
        $user->save();

        return redirect('/login')->with('success', 'Wachtwoord ingesteld! Log nu in.');
    }
}
?>