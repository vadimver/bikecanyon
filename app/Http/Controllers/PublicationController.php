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
      $id = Auth::user()->id;

      // get all subscribes
      $sub = Subscribe::where('my_profile', $id)->pluck('sub_profile');

      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::whereIn('id_profile', $sub)->paginate(12),
        'comments' => Comment::all()
      ];

      return view('subscribe', $data);
    }

    public function tags()
    {
      if(isset($_POST['test'])) {
          $id_test = $_POST['test'];
      } else {
          $id_test[0] = 0;
      }


      $data = [
        'title' => 'Today affairs',
        'publications' => Publication::whereIn('tags', $id_test)->paginate(12),
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
