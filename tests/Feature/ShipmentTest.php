<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_label_successfully()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Mock request payload
        $requestData = [
            'imageType' => 'pdf',
            'labelType' => 'international',
            'to_streetAddress' => '123 Street',
            'to_city' => 'City',
            'to_postalCode' => '12345',
            'to_country' => 'US',
            'from_streetAddress' => '456 Another Street',
            'from_city' => 'Another City',
            'from_state' => 'State',
            'from_ZIPCode' => '67890',
            'weight' => 5,
            'length' => 10,
            'width' => 10,
            'height' => 10,
            'mailClass' => 'Priority',
            'contentComments' => 'Gift',
            'restrictionType' => 'None',
            'customsContentType' => 'Merchandise',
            'roleName' => 'Role',
            'CRID' => '123CRID',
            'MID' => '123MID',
            'manifestMID' => '456MID',
            'accountType' => 'Permit',
            'accountNumber' => '123456',
            'permitNumber' => '7890',
            'permitZIP' => '12345',
        ];

        // Mock API responses
        Http::fake([
            'https://api.usps.com/oauth2/v3/token' => Http::response([
                'access_token' => 'fake_access_token',
            ], 200),
            'https://api.usps.com/payments/v3/payment-authorization' => Http::response([
                'paymentAuthorizationToken' => 'fake_payment_token',
            ], 200),
            'https://api.usps.com/international-labels/v3/international-label' => Http::response([
                'labelMetadata' => [
                    'internationalTrackingNumber' => 'TRACK12345',
                    'postage' => 5.0,
                ],
                'labelImage' => 'base64encodedimage',
            ], 200),
        ]);

        // Send POST request
        $response = $this->postJson('/admin/shipment', $requestData);

        // Assert successful response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'labelMetadata' => [
                'internationalTrackingNumber',
                'postage',
            ],
            'labelImage',
        ]);
    }

    public function test_store_method_fails_on_invalid_request()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/admin/shipment', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'imageType',
            'labelType',
            'to_streetAddress',
            'to_city',
        ]);
    }
}
