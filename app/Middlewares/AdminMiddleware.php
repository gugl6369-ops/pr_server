<?php


namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        if (!Auth::user()->isAdmin()){
            app()->route->redirect('/hello');
        }
    }
}
