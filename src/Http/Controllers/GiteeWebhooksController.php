<?php

namespace Orh\LaravelGiteeWebhooks\Http\Controllers;

class GiteeWebhooksController extends Controller
{
    public function push()
    {
        @exec(config('gitee-webhooks.push_command'));

        return response()->json('Success.');
    }
}
