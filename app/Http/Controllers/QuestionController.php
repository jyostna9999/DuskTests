<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;
use App\Http\Controllers\GatesController;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $question = new Question();
        $edit= FALSE;
        return view('questionForm',['question' => $question,'edit' => $edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',
        ]);
        $input = request()->all();
        $question = new Question($input);
        $question->user()->associate(Auth::user());
        $question->save();
        return redirect()->route('home')->with('message', 'IT WORKS!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
       // dd($question);
        return view('question')->with('question', $question);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if (Gate::allows('editDeleteQuestions-auth', $question)) {
            $edit = TRUE;
            return view('questionForm', ['question' => $question, 'edit' => $edit]);
        }
        else (Gate::denies('editDeleteQuestions-auth', $question)) ;
        {
            return redirect()->route('home')->with('message', 'Access Denied');
        }

    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',
        ]);

        $question->body = $request->body;
        $question->save();
        return redirect()->route('question.show',['question_id' => $question->id])->with('message', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Request $request)
    {
        if (Gate::allows('editDeleteQuestions-auth', $question)) {
            $question->delete();
            return redirect()->route('home')->with('message', 'Deleted');

        }
        else (Gate::denies('editDeleteQuestions-auth', $question)) ;
        {
            return redirect()->route('home')->with('message', 'Access Denied');
        }



        //test
        /*if(Auth::user()->id == $request->id)
        {
            $question->delete();
        }

        return redirect()->route('home')->with('message', 'Deleted');*/
    }
}
