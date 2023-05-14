<?php

namespace App\Jobs;

use App\Mail\NewsLetter;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewsLetterWeekly implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // get Posts created within 7 Days
        $posts = Post::where('created_at', '>=', Carbon::now()->subDays(7))->latest()->limit(10)->get();

        // users emails
        $subscribed_users = User::select('email')->where('news_letter', true)->pluck('email');

        // get website email and name
        $website_details = Setting::select('contact_mail', 'site_name')->where('id',1)->first();

        foreach ($subscribed_users as $email) {
            Mail::to($email)->send(new NewsLetter($website_details->site_name, $website_details->contact_mail, $posts));
        }

    }
}
