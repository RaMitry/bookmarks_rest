<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Comment;
use App\Http\Requests;

class BookmarkController extends Controller
{
    /**
     * Get the list of last ten bookmarks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks_ten = Bookmark::limit(10)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($bookmarks_ten);
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
     * Add new bookmark.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $bm_url = Bookmark::where('url', '=', $request->input('url'))
            ->first();

        if(isset($bm_url->bm_id)){

            $bm_id = $bm_url->id;

        }else{

            $bm_id = Bookmark::insertGetId(
                [
                    'url' => $request->input('url')
                ]
            );

        }

        return response()->json(['bm_id' => $bm_id]);
    }

    /**
     * Get the bookmark with comment via its url.
     *
     * @param  string url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if(!$url){
            return response()->json(['error' => 'wrong request']);
        }

        $bookmark = Bookmark::where('url', '=', $url)
            ->get()
            ->toArray();

        $bookmark = $bookmark[0];

        $bookmark_id = $bookmark['id'];

        $comments = Comment::where('bm_id', '=', $bookmark_id)
            ->get()
            ->toArray();

        $bookmark['comments'] = $comments;

        return response()->json($bookmark);
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
