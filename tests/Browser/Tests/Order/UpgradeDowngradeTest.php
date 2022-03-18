<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpgradeDowngradeTest extends DuskTestCase
{
    const USER = [
        'email' => 'britex.test3+1911@gmail.com',
        'password' => '123456'
    ];

    public function testUpgrade()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Sign In')
                ->waitForText('Sign into your account')
                ->type('#identifier', self::USER['email'])
                ->type('#password_login', self::USER['password'])
                ->click('#sign-in-button')
                ->waitForText('Account')
                ->clickLink('Monthly Billing')
                ->waitForText('My Plans')
                ->click('#billPlans-section ul .billPlans-line:last-child div.menu a.trigger')
                ->waitForText('Change my plan')->clickLink('Change my plan')->waitForText('Monthly Cost')
                ->click('#option-6')
                ->click('#done-btn')->waitForText('Please confirm your upgrade request')
                ->assertSee('Upgrade to')->click('#place-order-button')
                ->waitForText('download your invoice')
                ->clickLink('Log off')->clickLink('Sign In')
                ->waitForText('Sign into your account');
        });
    }

}
