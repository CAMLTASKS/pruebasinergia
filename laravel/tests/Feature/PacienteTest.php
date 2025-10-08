<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Paciente;

class PacienteTest extends TestCase
{
    use RefreshDatabase;

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'password' => bcrypt('1234567890')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => '1234567890',
        ]);

        $this->token = $response->json('access_token');
    }

    public function puede_listar_pacientes()
    {
        $response = $this->withHeader('Authorization', "Bearer {$this->token}")
                         ->getJson('/api/pacientes');

        $response->assertStatus(200);
    }

    public function puede_crear_un_paciente()
    {
        $data = [
            'tipo_documento_id' => 1,
            'numero_documento' => 123456,
            'nombre1' => 'Juan',
            'apellido1' => 'Pérez',
            'genero_id' => 1,
            'departamento_id' => 1,
            'municipio_id' => 1,
            'correo' => 'juan@example.com'
        ];

        $response = $this->withHeader('Authorization', "Bearer {$this->token}")
                         ->postJson('/api/pacientes', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nombre1' => 'Juan']);
    }
}
