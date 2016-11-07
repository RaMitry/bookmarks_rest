<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller
{
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
     * Add new comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bm_url = Bookmark::where('id', '=', $request->input('bm_id'))
            ->first();


        if(!isset($bm_url->id)){
            return response()->json(['error' => 'wrong bm_id']);
        }

        $ip =  $this->getIp();

        $id = Comment::insertGetId([
            'bm_id' => $request->input('bm_id'),
            'ip'  => $ip,
            'com_text'=> $request->input('com_text')
        ]);

        return response()->json(['id' => $id]);
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
     * Update a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updated_comment = Comment::where('id', '=', $id)
            ->first();

        $this_ip = $this->getIp();


        if( $this->checkTimeCreated($updated_comment->created_at) && $updated_comment->ip  == $this_ip){

            Comment::where('id', '=', $id)
                ->update([
                    'com_text' => $request->input('com_text')
                ]);

            return response()->json(['success' => 'the comment has been updated']);

        }else{

            return response()->json(['error' => 'you have no access or the comment is too old']);

        }
    }

    /**
     * Delete a comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_comment = Comment::where('id', '=', $id)
            ->first();

        if(!isset($deleted_comment->id)){
            return response()->json(['error' => 'such сomment does not exist']);
        }

        $ip = $this->getIp();


        if( $this->checkTimeCreated($deleted_comment->created_at) && $deleted_comment->ip == $ip){

            Comment::where('id', $id)
                ->delete();

            return response()->json(['success' => 'comment has been removed']);

        }else{

            return response()->json(['error' => 'you have no access or the comment is too old']);

        }
    }

    /**
     * Get request IP

     *
     * @return ip
     */

    protected function getIp() {

        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        }
        return $ip;
    }

    /**
     * Check Bookmark time
     *
     * @param $created
     *
     * @return Boolean
     */

    protected function checkTimeCreated($created)
    {
        if((time() - strtotime($created) > 3600)){

            return false;

        }else{

            return true;

        }

    }
}
