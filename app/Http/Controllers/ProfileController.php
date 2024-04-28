<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileFormRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    

    public function index() {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileFormRequest $request) {
        
        /** @var User $authenticatedUser */
        $authenticatedUser = Auth::user();

        $name = $request->validated('name');
        try {
            $password = $request->validated('password');
            $newPassword = $request->validated('new-password');
            $passwordConfirmation = $request->validated('password-confirmation');
        }
        catch(Exception $error){
            // 
        }

        if(! (bool) $password) {
            throw ValidationException::withMessages([
                'password' => 'Mot de passe invalide',
            ]);
        }


        if((bool)$password && (bool)$newPassword && (bool)$passwordConfirmation) {
            if(
                Hash::check($password, $authenticatedUser->password) 
                        &&
                $newPassword == $passwordConfirmation
                )
                {
                    $authenticatedUser->update([
                        'name' => $name !== null ? $name : $authenticatedUser->name,
                        'password' => Hash::make($newPassword), 
                    ]);
    
                    return redirect()->back()
                        ->with('profile-updated', 'Modification enregistrer avec succès');
                    }
                    
                    throw ValidationException::withMessages([
                        'password' => 'Mot de passe incorrect',
                    ]);
                }
                
                if($name != $authenticatedUser->name) {
                    $authenticatedUser->update([
                        'name' =>  $name,
                    ]); 
                    return redirect()->back()
                        ->with('profile-updated', 'Modification enregistrer avec succès');
                }

                return redirect()->back() ;

    }
}
