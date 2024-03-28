<?php

namespace App\Http\Controllers;

use App\Events\PrivateEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        event(new PrivateEvent($request->name));
    }
}
