<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DiaryInterface;
use App\Repositories\UserInterface;

class DiaryController extends Controller
{
    /**
     * New controller instance.
     *
     * @return void
     */
    public function __construct(
        DiaryInterface $diary,
        UserInterface $user
        )
    {
        $this->middleware('auth');
        $this->diary = $diary;
        $this->user = $user;
    }

    /**
     * Display all entries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = $this->diary->getAllEntries();
        return $this->diary->getResponse($entries);
    }

    /**
     * Store a newly created entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addNew = $this->diary->addNewEntry($request->all());
        return $this->user->updateUserData(
            $request->user(),
            'increment',
            'allentries',
            $this->diary->getResponse($addNew)
        );
    }

    /**
     * Display the specified entry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = $this->diary->getOneEntry($id);
        return $this->diary->getResponse($entry);
    }

    /**
     * Update the specified entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editedEntry = $this->diary->editEntry($request->all(), $id);
        return $this->diary->getResponse($editedEntry);
    }

    /**
     * Remove the specified entry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $deletedEntry = $this->diary->deleteEntry($id);
        return $this->user->updateUserData(
            $request->user(),
            'decrement',
            'allentries',
            $this->diary->getResponse($deletedEntry)
        );
    }
}
