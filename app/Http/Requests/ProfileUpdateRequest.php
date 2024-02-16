<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $user = Auth::user();

        if ($user->role === 'user') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'pfp' => ['required', 'image', 'mimes:png,svg,jpg,jpeg', 'max:10240'],
                'title' => ['required', 'string', 'max:255'],
                'post' => ['required', 'string', 'max:255'],
                'industry' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:255'],
                'aboutme' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'string', 'max:255'],
                'slogan' => ['required', 'string', 'max:255'],
                'industry' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            ];
        }
    }
}
