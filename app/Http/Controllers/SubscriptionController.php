<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Http\Requests\SubscribeRequest;

class SubscriptionController extends Controller
{
    public function subscribe(SubscribeRequest $request)
    {
        $subscriber = Subscriber::create($request->toArray());
        return response()->json([
            'messages' => ['Subscriber saved'],
            'subscriber' => $subscriber
        ]);
    }
}
