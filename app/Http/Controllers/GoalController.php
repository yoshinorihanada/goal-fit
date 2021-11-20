<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of all the user's goal.
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $goals = $request->user()->tasks()->get();
        // return Goal::with('user')->orderBy('created_at', 'DESC')->get();
        // $user = auth()->user();
        $user = Auth::user();
        return $user->goals()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newGoal = new Goal;
        $newGoal->user_id = Auth::id();
        $newGoal->name = $request->goal["name"];
        $newGoal->due_date = $request->goal["dueDate"];
        $newGoal->save();

        return $newGoal;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingGoal = Goal::find($id);
        if($existingGoal){
            $existingGoal->completed = $request->goal['completed'] ? true : false;
            $existingGoal->completed_at = $request->goal['completed'] ? Carbon::now() : null;
            $existingGoal->save();
            return $existingGoal;
        }

        return "Goal not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingGoal = Goal::find($id);

        if($existingGoal){
            $existingGoal->delete();
            return "Item successfully deleted.";
        }

        return "Item not found";
    }
}
