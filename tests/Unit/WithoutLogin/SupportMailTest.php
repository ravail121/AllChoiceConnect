<?php

namespace Tests\Unit\WithoutLogin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportMailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_support_email()
    {
        $sendEmail = $this->call('post', '/support-email', [
            'name'      => 'Tester',
            'email'     => 'check@gmail.com',
            'subject'   => 'Test',
            'message'   => 'This is a test'
        ]);
        $sendEmail->assertRedirect('/')->assertStatus(302);
    }

}
