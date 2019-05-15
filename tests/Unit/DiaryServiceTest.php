<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Services\DiaryService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Entry;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;

class DiaryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->diaryService = new DiaryService();

        $this->user = User::create([
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'testuser@email.com',
            'password' => 'Password',
            'confirmedPassword' => 'Password'
        ]);

        Auth::shouldReceive('user')->andReturn($this->user);

        $this->entryData = [
            'title' => 'Test Entry',
            'body' => 'This is a test entry'
        ];

    }

    /**
     * A test for adding new entries.
     *
     * @return void
     */
    public function testAddNewEntry()
    {
        $actual = $this->diaryService->addNewEntry($this->entryData);
        $entry = Entry::latest('created_at')->first();
        $expected = [
            'message' => 'Entry added successfully!',
            'statusCode' => 201,
            'data' => null
        ];
        $this->assertEquals($expected, $actual);
        $this->assertDatabaseHas('entries', $entry->toArray());
    }

    public function testGetAllEntries()
    {
        $this->diaryService->addNewEntry($this->entryData);
        $entry = Entry::latest('created_at')->first();
        $actual = $this->diaryService->getAllEntries();

        $expected = [
            'message' => '1 entry found',
            'statusCode' => 200,
            'data' => [
                0 => [
                    'id' => $entry->id,
                    'author' => $entry->author,
                    'title' => $entry->title,
                    'body' => $entry->body,
                    'created_at' => $entry->created_at,
                    'updated_at' => $entry->updated_at
                ]
            ]
        ];
        $this->assertEquals($actual, $expected);
    }

    public function testGetOneEntry()
    {
        $this->diaryService->addNewEntry($this->entryData);
        $entry = Entry::latest('created_at')->first();
        $actual = $this->diaryService->getOneEntry($entry->id);

        $expected = [
            'message' => 'Entry found',
            'statusCode' => 200,
            'data' => [
                'id' => $entry->id,
                'author' => $entry->author,
                'title' => $entry->title,
                'body' => $entry->body,
                'created_at' => $entry->created_at,
                'updated_at' => $entry->updated_at
            ]
        ];
        $this->assertEquals($actual, $expected);
    }

    public function testEditEntry()
    {
        $this->diaryService->addNewEntry($this->entryData);
        $entry = Entry::latest('created_at')->first();
        $actual = $this->diaryService->editEntry(
            [
                "title" => "Updated Entry",
                "body" => "This is the edited entry"
            ],
            $entry->id
        );
        $entry = Entry::latest('updated_at')->first();

        $expected = [
            'message' => 'Entry updated successfully',
            'statusCode' => 200,
            'data' => [
                'id' => $entry->id,
                'author' => $entry->author,
                'title' => 'Updated Entry',
                'body' => 'This is the edited entry',
                'created_at' => $entry->created_at,
                'updated_at' => $entry->updated_at
            ]
        ];
        $this->assertEquals($actual, $expected);
    }

    public function testDeleteEntry()
    {
        $this->diaryService->addNewEntry($this->entryData);
        $entry = Entry::latest('created_at')->first();
        $this->assertDatabaseHas('entries', $entry->toArray());
        $expected = [
            'message' => 'Entry deleted',
            'statusCode' => 200,
            'data' => null
        ];
        $actual = $this->diaryService->deleteEntry($entry->id);
        $this->assertEquals($actual, $expected);
        $this->assertDatabaseMissing('entries', $entry->toArray());
    }

    public function testEntryNotFound()
    {
        $expected = [
            "message" => "Entry not found",
            "statusCode" => 404,
            "data" => null
        ];
        $actual = $this->diaryService->entryNotFound();
        $this->assertEquals($actual, $expected);
    }

    public function testGetResponseArray()
    {
        $expected = [
            'message' => 'test message',
            'statusCode' => 200,
            'data' => null
        ];

        $actual = $this->diaryService->getResponseArray(
            'test message',
            200,
            null
        );
        $this->assertEquals($actual, $expected);
    }

}
