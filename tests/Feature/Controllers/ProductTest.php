<?php

namespace Tests\Feature\Controllers;

use App\Mail\ProductCreated;
use App\Mail\ProductUpdated;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker;

    public function testCreateProduct()
    {
        $category = Category::factory()->create();
        $title = $this->faker->realTextBetween(3, 12);
        $eid = $this->faker->numberBetween();
        $price = $this->faker->randomFloat(2, 0, 200);
        $response = $this->post('api/products', [
            'title' => $title,
            'eid' => $eid,
            'price' => $price,
            'categoriesEid' => [$category->id]
        ])->assertStatus(201)
            ->assertJsonFragment([
                'title' => $title,
                'eid' => $eid
            ]);

        $this->assertDatabaseHas('products', [
            'title' => $title,
            'eid' => $eid,
            'price' => $price
        ]);

        $this->assertDatabaseHas('category_product', [
            'product_id' => $response->json()['data']['id'],
            'category_id' => $category->id
        ]);

        Mail::assertSent(ProductCreated::class);
    }

    public function testCreateProductFailed()
    {
        $title = $this->faker->realTextBetween(3, 12);
        $eid = $this->faker->numberBetween();
        $this->post('api/products', [])->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'title' => $title,
            'eid' => $eid
        ]);
    }

    public function testShowProduct()
    {
        $product = Product::factory()->create();
        $this->get('api/products/'.$product->id)
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $product->title,
            ]);
    }

    public function testUpdateProduct()
    {
        $product = Product::factory()->create();
        $this->put(
            'api/products/'.$product->id,
            [
                'title' => 'Hello world'
            ]
        )
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Hello world'
            ]);

        $this->assertDatabaseMissing('products', [
            'title' => $product->title
        ]);
        $this->assertDatabaseHas('products', [
            'title' => 'Hello world',
        ]);

        Mail::assertSent(ProductUpdated::class);
    }

    public function testDelete()
    {
        $product = Product::factory()->create();
        $this->delete('api/products/'.$product->id)
            ->assertStatus(202);

        $this->assertDatabaseMissing('products', [
            'title' => $product->title
        ]);
    }

    public function testIndex()
    {
        $product = Product::factory()->create();

        $this->get('api/products')
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $product->title,
            ]);
    }
}
