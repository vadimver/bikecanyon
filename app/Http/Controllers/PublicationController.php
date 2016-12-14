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
        'publications' => Publication::
        select('publications.*', 'profiles.name_profile', 'tags.name_tag')
        ->leftJoin('profiles', function($join) {
          $join->on('publications.id_profile', '=', 'profiles.id_profile');
        })
        ->leftJoin('tags', function($join) {
          $join->on('publications.tags', '=', 'tags.id_tag');
        })
        ->get(),

        'comments' => Comment::
          leftJoin('profiles', function($join) {
          $join->on('comments.id_profile', '=', 'profiles.id_profile');})
          ->get()
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
         'tags' => 'required',
         'images' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

       $imageName = time().'.'.$request->images->getClientOriginalExtension();
       $request->images->move(public_path('images/publications/'."$request->id_user"), $imageName);


       $a = new Publication;
       $a->text = $request->text;
       $a->tags = $request->tags;
       $a->img = $imageName;
       $a->video = 123;
       $a->id_profile = $request->id_user;
       $a->likes = 0;

       $a->save();



       return redirect('/');
   }
}
