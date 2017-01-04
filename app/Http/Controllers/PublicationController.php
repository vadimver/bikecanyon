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

class PublicationController extends Controller
{
    public function all(Request $request)
    {
      if( isset($request->search)) {
        $search = $request->search;
      } else {
        $search = '';
      }
      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::
        where('text', 'like', "%$search%")->
        select('publications.*', 'profiles.name_profile', 'tags.name_tag')
        ->leftJoin('profiles', function($join) {
          $join->on('publications.id_profile', '=', 'profiles.id_profile');
        })
        ->leftJoin('tags', function($join) {
          $join->on('publications.tags', '=', 'tags.id_tag');
        })
        ->orderBy('id_publication', 'DESC')->get(),
        'comments' => Comment::
          leftJoin('users', function($join) {
          $join->on('comments.id_user', '=', 'users.id');})
          ->get()
      ];

      return view('all', $data)->with(["page" => "all"]);
    }

    public function subscribe()
    {
      $id = Auth::user()->id;

      // get all subscribes
      $sub = Subscribe::where('my_profile', $id)->pluck('sub_profile');


      $data = [
        'title' => 'Подписки',
        'menu_subscribe' => 'active',
        'publications' => Publication::
        select('publications.*', 'profiles.name_profile', 'tags.name_tag')
        ->whereIn('publications.id_profile', $sub)
        ->leftJoin('profiles', function($join) {
          $join->on('publications.id_profile', '=', 'profiles.id_profile');
        })
        ->leftJoin('tags', function($join) {
          $join->on('publications.tags', '=', 'tags.id_tag');
        })
        ->orderBy('id_publication', 'DESC')->get(),
        'comments' => Comment::
        leftJoin('users', function($join) {
        $join->on('comments.id_user', '=', 'users.id');})
          ->get()
      ];

      return view('subscribe', $data)->with(["page" => "subscribe"]);
    }

    public function tags()
    {
      if(isset($_POST['list_tags'])) {
          $id_tags = $_POST['list_tags'];
      } else {
          $id_tags[0] = 0;
      }


      $data = [
        'title' => 'Теги',
        'menu_tags' => 'active',
        'publications' => Publication::whereIn('tags', $id_tags)
        ->select('publications.*', 'profiles.name_profile', 'tags.name_tag')
        ->leftJoin('profiles', function($join) {
          $join->on('publications.id_profile', '=', 'profiles.id_profile');
        })
        ->leftJoin('tags', function($join) {
          $join->on('publications.tags', '=', 'tags.id_tag');
        })
        ->orderBy('id_publication', 'DESC')->get(),
        'comments' => Comment::
          leftJoin('users', function($join) {
          $join->on('comments.id_user', '=', 'users.id');})
          ->get(),
        'tags' => Tag::all()
      ];

      return view('tags', $data)->with(["page" => "tags"]);
    }

    public function add_publication()
    {

      $data = [
        'title' => 'Добавление публикаций',
        'menu_add' => 'active',
        'tags' => Tag::all(),
        'profiles' => Profile::where('id_user', Auth::user()->id)->get()
      ];

      return view('add_publication', $data)->with(["page" => "add_publication"]);
    }

    public function create(Request $request)
   {
       $a = new Publication;

       if( isset($request->images)) {
         $this->validate($request, [
           'text' => 'required|min:5',
           'tags' => 'required',
           'images' => 'required|image|mimes:jpeg,png,jpg|max:2048'
          ]);

       $imageName = time().'.'.$request->images->getClientOriginalExtension();
       $request->images->move(public_path('images/publications/'."$request->id_profile"), $imageName);
       $a->img = $imageName;
       } elseif($request->video) {
         $this->validate($request, [
           'text' => 'required|min:5',
           'tags' => 'required',
           'video' => 'required'
          ]);

         $a->video = $request->video;
       }

       $a->text = $request->text;
       $a->tags = $request->tags;
       $a->id_profile = $request->id_profile;
       $a->id_user = $request->id_user;
       $a->likes = 1;

       $a->save();

       // add my like
       // get last id publication
       $last_post_id = Publication::max('id_publication');
       $post_id =  $last_post_id;
       $like = new Like;
       $like->user_id = Auth::user()->id;
       $like->post_id = $post_id;

       $like->save();
       $a->save();

       return redirect('/');

   }

   public function pub_like(Request $request)
   {

      $haves = Like::where('post_id', $_POST['postid'])->pluck('user_id');


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
          $a->post_id = $request->postid;
          $a->save();

          $likes = Publication::where('id_publication', $request->postid)->pluck('likes');
          $plus = $likes[0] + 1;

          Publication::where('id_publication', $request->postid)
                              ->update(['likes' => $plus]);
          echo $plus;

      } else {
          $likes = Publication::where('id_publication', $request->postid)->pluck('likes');
          echo $likes[0];
         }

   }




}
