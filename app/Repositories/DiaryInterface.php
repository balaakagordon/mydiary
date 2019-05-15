<?php

namespace App\Repositories;

interface DiaryInterface {

    public function addNewEntry($entry);

    public function getAllEntries();

    public function getOneEntry($id);

    public function editEntry($request, $id);

    public function deleteEntry($id);

    public function entryNotFound();

    public function successResponse($message, $statusCode, $data = null);

    public function errorResponse($error, $statusCode);
}