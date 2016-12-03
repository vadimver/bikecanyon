<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Publication;
use App\Comment;
use App\Tag;

class PublicationController extends Controller
{
    public function all()
    {

      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::all(),
        'comments' => Comment::all()
      ];

      return view('all', $data);
    }

    public function subscribe()
    {

      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::all(),
        'comments' => Comment::all()
      ];

      return view('subscribe', $data);
    }

    public function tags()
    {

      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::all(),
        'comments' => Comment::all(),
        'tags' => Tag::all()
      ];

      return view('tags', $data);
    }

    public function add_publication()
    {

      $data = [
        'title' => 'Today affairs',
        'tags' => Tag::all()
      ];

      return view('add_publication', $data);
    }

    public function create(Request $request)
   {
       $this->validate($request, [
        'text' => 'required|min:5',
       ]);

       $a = new Publication;

       $a->text = $request->text;
       $a->img = $request->img;
       $a->tags = $request->tags;
       $a->id_profile = $request->id_user;
       $a->likes = 0;

       $a->save();
       return redirect('/tags');
   }
}
