<?php
namespace Database\Factories;

use App\Models\Asistente;
use App\Models\Tema;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsistenteFactory extends Factory
{
    protected $model = Asistente::class;

    public function definition()
    {
        return [
            'tema_id' => Tema::factory(),
            'nombre' => $this->faker->name(),
            'cargo' => $this->faker->jobTitle(),
            'confirmado' => $this->faker->boolean(),
        ];
    }
}

