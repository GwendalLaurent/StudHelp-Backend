<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

use App\Models\UserHasFavorite;
use App\Models\User;

// credits: https://grafikart.fr/tutoriels/jobs-queue-889
class SendPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $advertisement;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ad)
    {
        $this->advertisement = $ad;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $course_id = $this->advertisement["course_id"];
        
        /* $users = User::select("firebase_token")
                ->whereRaw("select user_email from user_has_favorites 
                                where users.email = user_has_favorites.user_email and course_id =  {$this->advertisement['course_id']}"); */
           
        $users = DB::select("select firebase_token from users where exists (
                            select user_email from user_has_favorites 
                                where users.email = user_has_favorites.user_email and course_id =  {$course_id} )");

        foreach($users as $user){
            // TODO ask firebase to send the notif to the user
            echo $user->firebase_token;
        }
    }
}
