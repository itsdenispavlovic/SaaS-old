<?php

namespace Database\Factories;

use App\Models\Node;
use Illuminate\Database\Eloquent\Factories\Factory;

class NodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Node::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => $this->faker->word,
        'name' => $this->faker->word,
        'slug' => $this->faker->word,
        'menu_name' => $this->faker->word,
        'canonical_url' => $this->faker->word,
        'short_description' => $this->faker->text,
        'content' => $this->faker->text,
        'position' => $this->faker->randomDigitNotNull,
        'image' => $this->faker->word,
        'meta_title' => $this->faker->word,
        'meta_description' => $this->faker->word,
        'meta_keywords' => $this->faker->word,
        'published' => $this->faker->word,
        'is_menu' => $this->faker->word,
        'is_sitemap' => $this->faker->word,
        'is_homepage' => $this->faker->word,
        'access_type' => $this->faker->word,
        'node_type' => $this->faker->word,
        'node_properties' => $this->faker->text,
        'display_at' => $this->faker->date('Y-m-d H:i:s'),
        'ends_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
