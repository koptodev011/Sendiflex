<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoadSign;
use App\Models\SubRoadSign;
use App\Models\Feedback;
use App\Models\User;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function studentfeedback(Request $request)
    {

    $today = Carbon::today();
    $studentfeedback = Feedback::whereDate('created_at', $today)
        ->get(['user_id', 'student_feedback', 'trainer_id']);

    $userIds = $studentfeedback->pluck('user_id')->unique()->values()->toArray();
    $trainerIds = $studentfeedback->pluck('trainer_id')->unique()->values()->toArray();

    $users = User::select('users.*','branches.branch_name')
    ->leftJoin('branches','users.branch','=','branches.id')
    ->whereIn('users.id', $userIds)->get(['id', 'name', 'role']);

     $trainers = User::whereIn('id', $trainerIds)->get(['id', 'name']);

    $userData = $users->mapWithKeys(function ($user) use ($studentfeedback, $trainers) {
        $roleLabel = $user->role == 1 ? 'Student' : 'Other';
        $feedback = $studentfeedback->where('user_id', $user->id)->first();
        $feedbackContent = $feedback ? $feedback->student_feedback : 'No feedback';
        $trainerName = $feedback ? $trainers->where('id', $feedback->trainer_id)->pluck('name')->first() : 'No trainer';

        return [$user->id => [
            'name' => $user->name,

            'feedback' => $feedbackContent,
            'trainer' => $trainerName,
             'branch_name' => $user->branch_name
        ]];
    })->toArray();
    // return response()->json($userData);

    return view('studentfeeback', ['users' => $userData]);


    }



    public function trainerfeedback(Request $request){

        $today = Carbon::today();
        $studentfeedback = Feedback::whereDate('created_at', $today)
            ->get(['user_id', 'trainer_feedback', 'trainer_id']);

        $userIds = $studentfeedback->pluck('user_id')->unique()->values()->toArray();
        $trainerIds = $studentfeedback->pluck('trainer_id')->unique()->values()->toArray();

        // $users = User::whereIn('id', $userIds)->get(['id', 'name', 'role']);
         $users = User::select('users.*','branches.branch_name')
         ->leftJoin('branches','users.branch','=','branches.id')
         ->whereIn('users.id', $userIds)->get(['id', 'name', 'role']);

        $trainers = User::whereIn('id', $trainerIds)->get(['id', 'name']);

        $userData = $users->mapWithKeys(function ($user) use ($studentfeedback, $trainers) {
            $roleLabel = $user->role == 1 ? 'Student' : 'Other';
            $feedback = $studentfeedback->where('user_id', $user->id)->first();
            $feedbackContent = $feedback ? $feedback->trainer_feedback : 'No feedback';
            $trainerName = $feedback ? $trainers->where('id', $feedback->trainer_id)->pluck('name')->first() : 'No trainer';

            return [$user->id => [
                'name' => $user->name,
                'feedback' => $feedbackContent,
                'trainer' => $trainerName,
                'branch_name' => $user->branch_name
            ]];
        })->toArray();
        // return response()->json($userData);

        return view('trainerfeedback', ['users' => $userData]);
    }



}
