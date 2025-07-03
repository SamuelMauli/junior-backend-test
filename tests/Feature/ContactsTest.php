<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Contact;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ContactsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_should_be_able_to_create_a_new_contact(): void
    {
        $this->withoutVite();

        $data = [
            'name' => 'Rodolfo Meri',
            'email' => 'rodolfomeri@contato.com',
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->post(route('contacts.store'), $data);

        $response->assertRedirect(route('contacts.index'));

        $expected = $data;
        $expected['phone'] = preg_replace('/\D/', '', $expected['phone']);

        $this->assertDatabaseHas('contacts', $expected);
    }

    #[Test]
    public function it_should_validate_information(): void
    {
        $data = [
            'name' => 'ro',
            'email' => 'email-errado@',
            'phone' => '419'
        ];

        $response = $this->post(route('contacts.store'), $data);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone'
        ]);

        $this->assertDatabaseCount('contacts', 0);
    }

    #[Test]
    public function it_should_be_able_to_list_contacts_paginated_by_10_items_per_page(): void
    {
        $this->withoutVite();

        Contact::factory(20)->create();

        $response = $this->get(route('contacts.index'));

        $response->assertStatus(200);

        $response->assertInertia(fn ($page) => $page
            ->component('Contacts/Index')
            ->has('contacts.data', 10)
        );
    }

    #[Test]
    public function it_should_be_able_to_delete_a_contact(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->delete(route('contacts.destroy', $contact));

        $response->assertRedirect(route('contacts.index'));

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    #[Test]
    public function the_contact_email_should_be_unique(): void
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Rodolfo Meri',
            'email' => $contact->email,
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->post(route('contacts.store'), $data);

        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseCount('contacts', 1);
    }

    #[Test]
    public function it_should_be_able_to_update_a_contact(): void
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Rodolfo Meri',
            'email' => 'emailatualizado@email.com',
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->put(route('contacts.update', $contact), $data);

        $response->assertRedirect(route('contacts.index'));

        $expected = $data;
        $expected['phone'] = preg_replace('/\D/', '', $expected['phone']);

        $this->assertDatabaseHas('contacts', $expected);
    }
}