<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ImportForm extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testImport()
    {
      $this->get('/import')
        ->assertSee("CSV Import");
    }
    public function testFailForm()
    {
      $this->post('/import')
        ->assertStatus(422);
    }

}
