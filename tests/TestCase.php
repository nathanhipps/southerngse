<?php

namespace Tests;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $user;

    public function setupAccount()
    {
        $this->user = (new CreateNewUser)->create([
            'name' => 'Nathan Hipps',
            'email' => 'nathan@clickable.dev',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
    }
}
