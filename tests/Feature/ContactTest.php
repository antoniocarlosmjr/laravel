<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    private $oUser;

    public function setUp() {
    	parent::setUp();
    	$this->oUser = createOne('App\User');
    	$this->actingAs($this->oUser);
    }

    public function testWeCanGetContacts()
    {
        $this->get('/contacts')->assertStatus(200);
    }

    public function testWeCanGetCreateContactPage()
    {
        $this->get('/contacts/create')->assertStatus(200);
    }

    public function testWeCanSeeSpecificContact()
    {
    	$oContact = createOne('App\Contact', ['user_id' => $this->oUser->id]);
        $this->get('/contacts')->assertSee($oContact->phone);
    }

    public function testWeCanCreateContact() {
        $this->post('/contacts', ['name' => 'Testeabsurdo', 'phone'=>'4434', 'email' => 'a@teste.com']);
        $this->get('/contacts')->assertSee('Testeabsurdo');   
    }

    public function testWeCanSeeShowContactPage() {
        $oContact = createOne('App\Contact', ['user_id' => $this->oUser->id]);
        $this->get('/contacts/1')->assertSee($oContact->name);
    }

    public function testWeCanSeeEditContactPage() {
        $oContact = createOne('App\Contact', ['user_id' => $this->oUser->id]);
        $this->get('/contacts/1/edit')->assertSee($oContact->name);
    }
}
