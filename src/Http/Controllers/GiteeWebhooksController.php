<?php

namespace Orh\LaravelGiteeWebhooks\Http\Controllers;

class GiteeWebhooksController extends Controller
{
    public function push()
    {
        $path = base_path();

        $command = config('gitee-webhooks.push_command');

        $code = exec("cd {$path} && {$command}");

        return response()->json("Success: {$code}");
    }
}
