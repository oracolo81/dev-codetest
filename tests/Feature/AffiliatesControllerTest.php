<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class AffiliatesControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Records()
    {
        $response = $this->get('/');
        $html = $response->getContent();
        $data = $response->viewData('affiliates');

        $response->assertStatus(200);
        $this->assertCount(16, $data);
    }
}
