<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Features;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean()
        ];
    }

    /**
     * Indicate that the user should have a type id.
     */
    public function withTypeId(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Type::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $document->name.'\'s Document',
                    'type_id' => $document->type_id
                ])
                ->when(is_callable($callback), $callback),
            'ownedTypes'
        );
    }
}
