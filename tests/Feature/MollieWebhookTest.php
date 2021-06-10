<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MollieWebhookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreAction()
    {
        Session::start();
        $response = $this->call('POST', 'questions', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('questions');
    }
}
