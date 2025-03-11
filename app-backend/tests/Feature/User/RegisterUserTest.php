<?php

namespace Feature\User;

use Tests\BaseTest;

class RegisterUserTest extends BaseTest {

    public function testUserRegistration()
    {
        $url = 'http://localhost:10005/register';
        $data = ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'SecurePass123!'];

        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        $this->assertNotFalse($result, "Error server.");

        $response = json_decode($result, true);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('User registered successfully', $response['message']);
    }
}