<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class SendEmailToWebsiteSubscribersCommand extends Command
{
    protected $signature = 'email:website-subscribers {post_id}';
    protected $description = 'Send email to website subscribers.';

    public function handle()
    {
        $post = Post::find($this->argument('post_id'));

        if (is_null($post)) {
            return Command::FAILURE;
        }

        SubscriptionService::sendEmailToSubscribers($post);

        return Command::SUCCESS;
    }
}
