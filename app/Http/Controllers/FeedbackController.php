<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function save(FeedbackRequest $request)
    {
        $feedback = Feedback::create($request->toArray());

        return response()->json(['messages' => ['Feedback saved'], 'feedback' => $feedback]);
    }
}
