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
use App\Models\Course;

use Illuminate\Http\Request;

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
        $course_code = Course::find($course_id)["code"];
        
        /* $users = User::select("firebase_token")
                ->whereRaw("select user_email from user_has_favorites 
                                where users.email = user_has_favorites.user_email and course_id =  {$this->advertisement['course_id']}"); */
           
        $users = DB::select("select firebase_token from users where exists (
                            select user_email from user_has_favorites 
                                where users.email = user_has_favorites.user_email and course_id =  {$course_id} )");

        $tokens = array_map(function ($value) {
            return $value->firebase_token;
        }, $users);

        $server_key = env("FIREBASE_KEY");
        $headers = [
            'Authorization: key=' . $server_key,
            'Content-Type: application/json',
        ];
        if(empty($tokens)) return;
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
            "title" => "Nouvelle annonce!",
            "body" => "Un utilisateur à posté une nouvelle annonce dans {$course_code}",  
            "click_action" => $this->advertisement["id"],
            ],
        ];
        $dataString = json_encode($data);
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            
        $response = curl_exec($ch);
        return;
    }
}
