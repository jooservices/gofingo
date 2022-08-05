<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;

    public function testCreateCategory()
    {
        $title = $this->faker->realTextBetween(3, 12);
        $eid = $this->faker->numberBetween();
        $this->post('api/categories', [
            'title' => $title,
            'eid' => $eid
        ])->assertStatus(201)
            ->assertJsonFragment([
                'title' => $title,
                'eid' => $eid
            ]);

        $this->assertDatabaseHas('categories', [
            'title' => $title,
            'eid' => $eid
        ]);
    }

    public function testCreateCategoryFailed()
    {
        $title = $this->faker->realTextBetween(3, 12);
        $eid = $this->faker->numberBetween();
        $this->post('api/categories', [])->assertStatus(302);

        $this->assertDatabaseMissing('categories', [
            'title' => $title,
            'eid' => $eid
        ]);
    }

    public function testShowCategory()
    {
        $category = Category::factory()->create();
        $this->get('api/categories/'.$category->id)
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $category->title,
            ]);
    }

    public function testUpdateCategory()
    {
        $category = Category::factory()->create();
        $this->put(
            'api/categories/'.$category->id,
            [
                'title' => 'Hello world'
            ]
        )
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Hello world'
            ]);

        $this->assertDatabaseMissing('categories', [
            'title' => $category->title
        ]);
        $this->assertDatabaseHas('categories', [
            'title' => 'Hello world',
        ]);
    }

    public function testDelete()
    {
        $category = Category::factory()->create();
        $this->delete('api/categories/'.$category->id)
            ->assertStatus(202);

        $this->assertDatabaseMissing('categories', [
            'title' => $category->title
        ]);
    }

    public function testIndex()
    {
        $category = Category::factory()->create();

        $this->get('api/categories')
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $category->title,
            ]);
    }
}
