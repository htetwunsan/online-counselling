<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role:counsellor'])->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::with('specialities')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialities.*' => ['required', Rule::in(Speciality::pluck('id'))]
        ]);

        $q = Question::create(['name' => $request->name]);

        $q->specialities()
            ->withTimeStamps()
            ->syncWithoutDetaching($request->specialities);

        return $q->load('specialities');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question->load('specialities');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialities.*' => ['required', Rule::in(Speciality::pluck('id'))]
        ]);

        $question->update([
            'name' => $request->name
        ]);
        $question->specialities()->withTimeStamps()->sync($request->specialities);

        return $question->load('specialities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response('', 204);
    }
}
