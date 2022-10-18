<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\UserModel;

class PasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userModel = new UserModel();

        if(!empty(session('userInfo'))) $id = session('userInfo')['id'];
        $user = $userModel->getItem(['id' => $id], ['task' => 'get-item'])->toArray();
        $oldPassword = $user['password'];
        return md5($value) === $oldPassword;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The old password incorrect';
    }
}
