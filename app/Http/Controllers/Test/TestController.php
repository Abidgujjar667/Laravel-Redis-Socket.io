<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function index(){
        $message='Laravel Event Broadcasting With Redis and Socket.io';
        TestEvent::dispatch($message);
        //event(new TestEvent($message));
        return "event sent";
    }
}
