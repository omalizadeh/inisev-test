<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable
{
    use Queueable, SerializesModels;

    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function build()
    {
        return $this->from('no_reply@test.com', 'Test Name')->view('emails.posts.published', [
            'title' => $this->post->title,
            'description' => $this->post->description,
        ]);
    }
}
