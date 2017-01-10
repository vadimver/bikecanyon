<?php
namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Publication;
use App\Comment;
use App\Tag;
use App\Profile;
use App\Subscribe;
use App\Like;

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
     public function create(Request $request)
    {


        $user_id = Auth::user()->id;

        $a = new Comment;

        $a->text = $request->text;
        $a->id_publication = $request->id_publication;
        $a->id_user = $user_id;
        $a->like_comments = 1;


        // add my like
        // get last id comment
        $last_comment_id = Comment::max('id_comment');

        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->comment_id = $last_comment_id;

        $a->save();
        $like->save();
        $a->name = Auth::user()->name;
        echo $a;

    }

    public function comment_like(Request $request)
    {

       $haves = Like::where('comment_id', $request->commentid)->pluck('user_id');
       // if isset my comments
       $have_like = 0;
       foreach($haves as $have) {
          if($have == Auth::user()->id) {
              $have_like = 1;
            }
       }

       if( $have_like == 0 ) {
           $a = new Like;
           $a->user_id = Auth::user()->id;
           $a->comment_id = $request->commentid;
           $a->save();

           $likes = Comment::where('id_comment', $request->commentid)->pluck('like_comments');
           $plus = $likes[0] + 1;

           Comment::where('id_comment', $request->commentid)
                               ->update(['like_comments' => $plus]);
           echo $plus;
      } else {
           $likes = Comment::where('id_comment', $request->commentid)->pluck('like_comments');
           echo $likes[0];

      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
