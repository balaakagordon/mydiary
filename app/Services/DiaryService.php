<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Exception;
use App\Models\Entry;
use App\Repositories\DiaryInterface;

class DiaryService implements DiaryInterface
{
    public function __construct()
    {
        $this->entriesPerPage = 10;
    }
    public function addNewEntry($entry)
    {
        $entry["author"] = Auth::user()->id;
        try {
            Entry::create($entry);
            return $this->getResponseArray('Entry added successfully!', 201);
        } catch (Exception $e) {
            return $this->getResponseArray($e->getMessage(), $e->getCode());
        }
    }

    public function getAllEntries()
    {
        try {
            $entries = Entry::where('author', Auth::user()->id)
            ->paginate($this->entriesPerPage)
            ->toArray();
            $entriesList = $entries['data'];
            $numEntries = sizeof($entriesList);
            $message = ( $numEntries >= 2 || $numEntries === 0 ) ?
                ($numEntries . ' entries found') :
                ($numEntries . ' entry found');
            return $this->getResponseArray($message, 200, $entries);
        } catch (Exception $e) {
            return $this->getResponseArray($e->getMessage(), $e->getCode());
        }
    }

    public function getOneEntry($id)
    {
        $entry = Entry::find($id);
        if ( !isset($entry) ) {
            return $this->entryNotFound();
        }
        return $this->getResponseArray('Entry found', 200, $entry->toArray());
    }

    public function editEntry($data, $id)
    {
        $entry = Entry::find($id);
        if (!isset($entry)) {
            return $this->entryNotFound();
        }
        $entry->title = $data['title'];
        $entry->body = $data['body'];
        $entry->save();
        return $this->getResponseArray('Entry updated successfully', 200, $entry->toArray());
    }

    public function deleteEntry($id)
    {
        if (Entry::destroy($id)) {
            return $this->getResponseArray('Entry deleted', 200);
        }
        return $this->entryNotFound();
    }

    public function entryNotFound()
    {
        return $this->getResponseArray('Entry not found', 404);
    }

    public function getResponseArray($message, $statusCode, $data = null) {
        return [
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data
        ];
    }

    public function getResponse($responseData)
    {
        if ((int)substr($responseData['statusCode'], 0, 1) === 2) {
            return $this->successResponse(
                $responseData['message'],
                $responseData['statusCode'],
                $responseData['data']
            );
        }
        return $this->errorResponse(
            $responseData['message'],
            $responseData['statusCode']
        );
    }

    public function successResponse($message, $statusCode, $data = null)
    {
        return response()->json(
            [
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ],
            $statusCode
        );
    }

    public function errorResponse($message, $statusCode)
    {
        return response()->json(
            [
                'status' => 'error',
                'message' => $message
            ],
            $statusCode
        );
    }
}
