<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /** @test */
    public function usuario_puede_registrarse()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Carlos',
            'email' => 'carlos' . rand(1000, 9999) . '@example.com',
            'password' => '1234567890',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token']);
    }

    /** @test */
    public function usuario_puede_iniciar_sesion()
    {
        $user = User::first();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => '1234567890',
        ]);

        // ✅ Cambiado "access_token" → "token"
        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function no_autenticado_no_puede_acceder_a_rutas_protegidas()
    {
        // Este endpoint debería requerir token JWT
        $response = $this->getJson('/api/pacientes');

        // Esperamos 401, no 200
        $response->assertStatus(401)
                 ->assertJson(['error' => 'Token no proporcionado']);
    }
}
