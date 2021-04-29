<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserHasBookmarks;
use App\Models\AdvertisementHasTags;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
class BookmarksController extends Controller
{

    public function getBookmarksOfUser($user_email)
    {
        $bookmarks = UserHasBookmarks::where('user_email', $user_email)->get();
        $result = new \Illuminate\Database\Eloquent\Collection();
        if ($bookmarks != NULL){
            foreach ($bookmarks as $i){
                $ad = Advertisement::where('advertisements.id', $i->advertisement_id)
                ->join('users', 'users.email', '=', 'user_email')
                ->join('courses', 'courses.id', '=', 'course_id')
                ->leftjoin('advertisement_has_pictures', 'advertisement_has_pictures.advertisement_id', '=', 'advertisements.id')
                ->select('advertisements.*', 'users.name', 'advertisement_has_pictures.picture', 'courses.name as course_name')->first();

                $ad["tags"] = AdvertisementHasTags::where('advertisement_id', $ad['id'])->get();

                $result->add($ad);
            }
        }
        return $result->sortByDesc('created_at')->values();
    }

    public function deleteBookmark($user_email, $advertisement_id)
    {
        return UserHasBookmarks::where('user_email', $user_email)->where('advertisement_id', $advertisement_id)->delete();    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'user_email' => 'required|string',
            'advertisement_id' => 'required'
        ]);

        return UserHasBookmarks::create([
                'user_email' => $fields['user_email'],
                'advertisement_id' => $fields['advertisement_id']
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
