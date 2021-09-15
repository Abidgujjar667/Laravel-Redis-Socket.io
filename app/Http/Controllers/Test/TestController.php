<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function index(){
        $message='Welcome to redis';
        TestEvent::dispatch($message);
        //event(new TestEvent($message));
        return "event sent";
    }
}
