<?php

namespace App\Actions\Fortify;

use App\Models\Number;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'id_number' => [
                'required', 'string', 'max:255',
                Rule::exists('numbers', 'id_number')->where(function (Builder $query) {
                    return $query->where('user_id', null);
                }),
            ],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'id_number.exists' => 'Invalid student number. Please ensure you entered the correct one.',
        ])->validate();

        $user = User::create([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $number = Number::where('id_number', $input['id_number'])->where('user_id', null)->firstOrFail();
        $number->update(['user_id' => $user->id]);

        return $user;
    }
}
