<?php

namespace Tests\Unit\Order;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_device_page()
    {
        $this->get('/devices')
            ->assertSee('Add Device')
            ->assertStatus(200);
    }

    public function test_plan_page()
    {
        $this->get('/plans')
            ->assertSee('Get started')
            ->assertStatus(200);
    }

    public function test_account_page_without_login()
    {
        $this->get('/account')
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    public function test_support_page()
    {
        $this->get('/support')
            ->assertSee('Got Questions?')
            ->assertStatus(200);
    }
}
