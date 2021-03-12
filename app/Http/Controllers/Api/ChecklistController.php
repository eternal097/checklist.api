<?php

namespace App\Http\Controllers\Api;

use App\Checklist;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\ChecklistRequest;
use App\Http\Controllers\Api\BaseController as BaseController;

class ChecklistController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $checklists = $user->checklists;

        if ($checklists->count() == null) {
            $checklists = 'Checklist is empty';
        }

        return $this->sendResponse($checklists, 'Checklists retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChecklistRequest $request)
    {
        $checklist = Checklist::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return $this->sendResponse($checklist->toArray(), 'Checklists created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistRequest $request, $id)
    {
        $user_checklists = User::findOrFail(Auth::id())->checklists;
        $checklist = Checklist::find($id);

        if ($user_checklists->contains($checklist)) {

            $checklist->delete();

            return $this->sendResponse($checklist->toArray(), 'Product deleted successfully.',204);

        } else {

            return $this->sendError('Not Found', null, 404);
        }
    }
}
