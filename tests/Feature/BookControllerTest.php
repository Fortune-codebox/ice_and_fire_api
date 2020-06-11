<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Faker\Generator as Faker;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function testCreateBook()
    {
        // $availability = Availability::all()->first();
        $data = [
            'name' => 'Harry Potter',
            'isbn' => '123-45686398',
            'authors' => 'Mary mary',
            'number_of_pages' => '321',
            'publisher' => 'John Doe',
            'country' => 'United States',
            'release_date' => '2020-06-10'
        ];
        $response = $this->post('/api/v1/books', $data);
        $this->assertDatabaseHas('books', [
            'name' => 'Harry Potter',
            'isbn' => '123-45686398',
            'authors' => 'Mary mary',
            'number_of_pages' => '321',
            'publisher' => 'John Doe',
            'country' => 'United States',
            'release_date' => '2020-06-10'
        ]);
        $response->assertJson([
            'status_code' => 201,
            'status' => 'success',
            'data' => [],
        ]);

        // $availability_edited = Availability::all()->first()->toArray();
        // $this->assertContains('deactivated', $availability_edited);
    }
    public function testExternal() {
        $name = 'A Clash of Titans';
        $response = $this->get('http://localhost:8000/api/external-book?name=' . $name);
        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'data' => [],
        ]);
        
    }

    public function testGetBooks() {
        $book = factory(Book::class, 3)->create();

        $response = $this->getJson('/api/v1/books');
        
        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'data' => true,
        ]);
    }

    public function testGetBooksIfNoBooksExist() {
        $response = $this->getJson('/api/v1/books');
        
        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'data' => [],
        ]);
    }

    public function testBookNotFound() {

        $response = $this->getJson('/api/v1/books');
        
        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'data' => [],
        ]);
        
    }

    public function testGetBook() {
        $book = factory(Book::class, 1)->create();
        $id = 1;
        $response = $this->getJson('/api/v1/books/'. $id);

        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'data' => true,
        ]);
    }

    public function testUpdateBook()
    {
        $book = factory(Book::class)->create();
       
        $id = 1;
        $response = $this->patchJson('/api/v1/books/' . $id, [
            'name' => 'Mary Mary',
            'isbn' => '234-5675676',
            'authors' => 'Mary James',
            'number_of_pages' => 203,
            'publisher' => 'the mob',
            'country' => 'United States',
            'release_date' => '2020-10-09'
        ]);

        $response->assertJson([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'The book Mary Mary was updated successfully',
            'data' => [
                    "name" => "Mary Mary",
                    "isbn" => "234-5675676",
                    "authors" => [
                        "Mary James"
                    ],
                    "number_of_pages" => 203,
                    "publisher" => "the mob",
                    "country" => "United States",
                    "release_date" => "2020-10-09"
            ],
        ]);
        
    }

    public function testUpdateBookNotFound() {
        $id = 1;
        $response = $this->patchJson('/api/v1/books/' . $id, [
            'name' => '',
            'isbn' => '234-5675676',
            'authors' => 'Mary James',
            'number_of_pages' => 203,
            'publisher' => 'the mob',
            'country' => 'United States',
            'release_date' => '2020-10-09'
        ]);
        
        $response->assertJson([
            "data" => []
        ]);
    }

    public function testCreateBookFieldNotFound() {
        $data = [
            'name' => '',
            'isbn' => '123-45686398',
            'authors' => 'Mary mary',
            'number_of_pages' => '321',
            'publisher' => '',
            'country' => '',
            'release_date' => '2020-06-10'
        ];
        $response = $this->post('/api/v1/books', $data);
        $response->assertJson([
            "errors" => [
                "name" => [
                    "The name field is required."
                ],
                "publisher"=> [
                    "The publisher field is required."
                ],
                "country" => [
                    "The country field is required."
                ]
            ]
        ]);
    }

    public function testDeleteBook() {
        $book = factory(Book::class)->create();
        $id = 1;
        $response = $this->deleteJson('/api/v1/books/'. $id);
        $response->assertJson([
            'status_code' => 204,
            'status' => 'success',
            'message' => 'The book ' . $book->name . ' was deleted successfully',
            'data' => [],
        ]);
    }

    

}
