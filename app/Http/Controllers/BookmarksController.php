<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserHasBookmarks;
use Illuminate\Support\Facades\DB;
class BookmarksController extends Controller
{

    public function getBookmarksOfUser($user_email)
    {
        return DB::select("select * from advertisements where exists (
            select advertisement_id from user_has_bookmarks
             where user_has_bookmarks.user_email = '{$user_email}' and user_has_bookmarks.advertisement_id = advertisements.id)");
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
