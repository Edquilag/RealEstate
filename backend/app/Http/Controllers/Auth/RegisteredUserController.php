<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * Handle registration.
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('role', 'client');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'in:client,broker'],
        ];

        if ($role === 'broker') {
            $rules = array_merge($rules, [
                'company_name' => ['required', 'string', 'max:255'],
                'office_address' => ['required', 'string', 'max:500'],
                'prc_license_number' => ['required', 'string', 'max:100'],
                'prc_license_expiry' => ['required', 'date', 'after:today'],
                'tin' => ['required', 'string', 'max:50'],
            ]);
        }

        $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'status' => $role === 'broker' ? 'pending' : 'approved',
            'company_name' => $request->input('company_name'),
            'office_address' => $request->input('office_address'),
            'prc_license_number' => $request->input('prc_license_number'),
            'prc_license_expiry' => $request->input('prc_license_expiry'),
            'tin' => $request->input('tin'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'broker') {
            return redirect()->route('dashboard')->with('status', 'Broker registration submitted. Your account is pending admin approval.');
        }

        return redirect()->route('client.dashboard');
    }
}