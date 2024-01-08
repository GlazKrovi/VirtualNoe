<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function connect(Request $request) {
        $this->forget($request);

        if (!$request->has('email') || !$request->has('password')) {
            return to_route('view_signin')->with('message',"Some POST data are missing.");
        }

        // fetch user
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password())) {   // also verify password
            return to_route('view_signin')->with('message', "Wrong email/password.");
        }
        
        $request->session()->put('user', $user); 
        return to_route('view_account')->with('message',"You are succesfully connected!");
    }

    public function create(Request $request){
        $this->forget($request);
        
        if (!$request->has('email') || !$request->has('password') || !$request->has('confirm')) {
            return to_route('view_signup')->with('message',"Some POST data are missing.");
        }

        if ($request->input('password') !== $request->input('confirm')) {
            return to_route('view_signup')->with('message',"The two passwords differ.");
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));  // encrypt password
        $user->save();

        return to_route('view_signin')->with('message',"Account created! Now, signin.");
    }

    public function updatePassword(Request $request){
        if (!$request->session()->has('user')) {
            return to_route('view_signin');
        }
    
        $newPassword = $request->input('newpassword');
        $confirmPassword = $request->input('confirmpassword');
    
        if ($newPassword !== $confirmPassword) {
            return to_route('view_formpassword')->with('message',"Error: passwords are different.");
        }

        $user = $request->session()->get('user');
        try {
            $user->password = Hash::make($newPassword);  // encrypt new password
            $user->save();
            return to_route('view_account')->with('message',"Password successfully updated.");
        } catch (\Exception $e) {
            return to_route('view_formpassword')->with('message',$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $this->forget($request);

        if (!$request->session()->has('user')) {
            return to_route('view_signin');
        }

        $user = $request->session()->get('user');
        try {
            $user->delete();
            $this->disconnect();
            return to_route('view_signin')->with('message',"Account successfully deleted.");
        } catch (\Exception $e) {
            return to_route('view_account')->with('message',$e->getMessage());
        }
    }

    public function disconnect()
    {
        session()->flush();
        return to_route('view_signin')->with('message',"You have successfully logged out!");
    }

    private function forget(Request $request) : void {
        $request->session()->forget('message');        
    }
}

?>