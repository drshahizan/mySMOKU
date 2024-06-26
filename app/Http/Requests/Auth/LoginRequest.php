<?php

namespace App\Http\Requests\Auth;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_kp' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
    
        $credentials = $this->only('no_kp', 'password');
    
        if (empty($credentials['no_kp']) || empty($credentials['password'])) {
            // If either 'no_kp' or 'password' is not provided, throw an exception or handle it as needed.
            throw ValidationException::withMessages([
                'both' => trans('auth.credentials_not_provided'),
            ]);
        }

        $user = User::where('no_kp', $credentials['no_kp'])->first();
    
        if ($user && Auth::attempt(['no_kp' => $credentials['no_kp'], 'password' => $credentials['password']])) {
            // Authentication succeeded for both 'no_kp' and 'password'
            $user = Auth::user();
    
            // Check if the user's email is verified
            if (!$user->email_verified_at) {
                Auth::logout(); // Log the user out if email is not verified
                throw ValidationException::withMessages([
                    'email_verified_at' => trans('auth.email_not_verified'),
                ]);
            }

            //create log
            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent')
            ]);
    
            RateLimiter::clear($this->throttleKey());
    

        } else {
            // Authentication failed for 'no_kp' and 'password' or 'no_kp' doesn't exist
            RateLimiter::hit($this->throttleKey());
        
            // Check if 'no_kp' exists in the table
            if ($user) {
                // 'no_kp' exists, but the password is incorrect
                throw ValidationException::withMessages([
                    'password' => trans('auth.password'),
                ]);
            } else {
                // 'no_kp' doesn't exist in the table
                throw ValidationException::withMessages([
                    'both' => trans('auth.both_incorrect'),
                ]);
            }
        }
    }
    


    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'no_kp' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
            'email_verified_at' => trans('auth.email_not_verified'), // Add this line
            'password' => trans('auth.password'),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('no_kp')).'|'.$this->ip());
    }
}
