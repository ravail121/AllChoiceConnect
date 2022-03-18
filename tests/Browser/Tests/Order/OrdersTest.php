<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrdersTest extends DuskTestCase
{
    const USER = [
        'email' => 'britex.test3@gmail.com',
        'password' => 'qwerty'
    ];

    const COUPONS = [
        'applies_to_all' => 'infinity001'
    ];

    // Important :- Delete customer_coupon table data before testing

    // Customer orders device only
    public function testDeviceOnly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign In')
                    ->waitForText('Sign into your account')
                    ->type('#identifier', self::USER['email'])
                    ->type('#password_login', self::USER['password'])
                    ->click('#sign-in-button')
                    ->waitForText('Account')
                    ->visit('/devices')
                    ->assertSee('Phones')
                    ->clickLink('Add Device')
                    ->waitForText('Add to cart without plan')
                    ->clickLink('Add to cart without plan')
                    ->waitForText('How would you like to proceed?')
                    ->clickLink('Check Out')->waitForText('You are almost done!')
                    ->click('#place-order-button')->waitForText('download your invoice')
                    ->clickLink('Log off')->clickLink('Sign In')
                    ->waitForText('Sign into your account');
        });
    }

    //Customer orders sim only.
    public function testSimOnly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign In')
                    ->waitForText('Sign into your account')
                    ->type('#identifier', self::USER['email'])
                    ->type('#password_login', self::USER['password'])
                    ->click('#sign-in-button')
                    ->waitForText('Account')
                    ->visit('/devices')
                    ->assertSee('Add Sim')
                    ->clickLink('Add Sim')
                    ->waitForText('Add to cart')
                    ->clickLink('Add to cart')
                    ->waitForText('How would you like to proceed?')
                    ->clickLink('Check Out')->waitForText('You are almost done!')
                    ->click('#place-order-button')->waitForText('download your invoice')
                    ->clickLink('Log off')->clickLink('Sign In')
                    ->waitForText('Sign into your account');
        });
    }

    //Device and sim with plan
    public function testCompleteSubscription()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign In')
                    ->waitForText('Sign into your account')
                    ->type('#identifier', self::USER['email'])
                    ->type('#password_login', self::USER['password'])
                    ->click('#sign-in-button')
                    ->waitForText('Account')
                    ->visit('/devices')
                    ->assertSee('Phones')
                    ->clickLink('Add Device')
                    ->waitForText('Add to cart and choose plan')
                    ->click('#choose-plan')
                    ->waitForText('Start Your Business Package By Choosing Your Wireless Solution Below.')
                    ->clickLink('Get Started')
                    ->waitForText('Select Your Sim')->assertSee('I want to buy one')
                    ->click('#buy-sim-yes')
                    ->click('#sim-label-1')
                    ->click('#label-porting-2')
                    ->type('#area-code', '123')
                    ->assertSee('Add To Cart')
                    ->clickLink('Add To Cart')->waitForText('How would you like to proceed?')
                    ->clickLink('Check Out')->waitForText('You are almost done!')
                    ->click('#place-order-button')->waitForText('download your invoice')
                    ->clickLink('Log off')->clickLink('Sign In')
                    ->waitForText('Sign into your account');
        });
    }

    // 1 Standalone device + 1 subscription(device + sim(bringing own) + plan) + 1 coupon that applies to all + add new card
    // Delete coupon from customer_coupon table
    public function testStandaloneDeviceAndSubscription()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') //Visit main page
                    ->clickLink('Sign In')->waitForText('Sign into your account') // Click sign in button and wait for inputs to appear
                    ->type('#identifier', self::USER['email'])->type('#password_login', self::USER['password'])->click('#sign-in-button') // Enter creds and click sign-in
                    ->waitForText('Account') // Get redirected to account page
                    ->visit('/plans')->assertSee('Voice')->clickLink('Voice') // Open plans page and select voice plans tab
                    ->click('#plan-5')->waitForText('Select Your Sim') // Select a plan and wait for modal to open
                    ->assertSee('I will bring my own Sim Card')->click('#buy-sim-no')->click('#sim-label-3') // Choose bring own sim and select second sim to bring
                    ->type('#sim-number', '1234567891234567891') // Type 19 digit sim number
                    ->type('#area-code', '789') // Type 3 digit area code
                    ->assertSee('Add To Cart & Choose Device')->clickLink('Add To Cart & Choose Device') // Select the option to choose device for the plan
                    ->waitForText('Phones')->click('#device-3')->waitForText('Add to cart')->clickLink('Add to cart')->waitForText('How would you like to proceed?') // Choose device and add it to cart
                    ->clickLink('+ Add New Device')->waitForText('The Device/Plan was added successfully.') // Click option to add another device
                    ->click('#device-5')->waitForText('Add to cart without plan')->clickLink('Add to cart without plan')->waitForText('added to cart')->clickLink('Check Out') // Add device and checkout
                    ->waitForText('The Device/Plan was added successfully.') // See message to confirm item was added
                    ->type('#coupon', self::COUPONS['applies_to_all'])->click('#coupon-apply')->waitForText('Coupon added successfully') //Apply coupon successfully
                    ->click('#new-card-label')->assertSee('Pay with Visa, Mastercard, Maestro & Amex') // Select option to add new card
                    ->click('#place-order-button')->assertSee('Please provide the Card Holder Name') // Place order without entering card deatils and see error
                        //Enter new card details and place order and logout
                    ->type('#payment-card-no', '4111111111111111')
                    ->type('#payment-card-holder', 'Test')
                    ->type('#expires-mmyy', '0129')
                    ->type('#payment-cvc', '256')
                    ->click('#place-order-button')->waitForText('download your invoice')
                    ->clickLink('Log off')->clickLink('Sign In')
                    ->waitForText('Sign into your account');
        });
    }

    // Plan with sim and porting and trying to use already used coupon from the last test.
    public function testPlanWithSimPorting()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Sign In')->waitForText('Sign into your account')
                    ->type('#identifier', self::USER['email'])->type('#password_login', self::USER['password'])->click('#sign-in-button')
                    ->waitForText('Account')
                    ->visit('/plans')->assertSee('Voice')->clickLink('Voice')
                    ->click('#plan-1')->waitForText('Select Your Sim')->click('#buy-sim-yes')->click('#sim-label-1')
                    ->click('#label-porting-1')->type('#port-number', '1234567891')
                    ->clickLink('Add To Cart w/o Device')->waitForText('added to cart')->clickLink('Check Out')->waitForText('The Device/Plan was added successfully.')
                    ->type('#coupon', self::COUPONS['applies_to_all'])->click('#coupon-apply')->waitForText('You have already used this coupon')
                    ->click('#place-order-button')->waitForText('download your invoice')
                    ->clickLink('Log off')->clickLink('Sign In')
                    ->waitForText('Sign into your account');
        });
    }

}
