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

class ProfileController extends Controller
{
  public function index(Request $request)
  {

      // sort
      if(isset($request->sort)) {
        $sort = $request->sort;
          if($sort == 'name_profile') {
              $inc = 'ASC';
          } else{
              $inc = 'DESC';
          }
      } else {
        $sort = 'id_profile';
        $inc = 'ASC';
      }

      // Search
      if(isset($request->search)) {
        $search = $request->search;
          $data = [
            'title' => 'Профайлы',
            'menu_list' => 'active',
            'profiles' => Profile::leftJoin('subscribes', function($join) {
              $join->on('profiles.id_profile', '=', 'subscribes.sub_profile');
            })->where('description','like', "%$search%")->where('activate', 1)->orderBy("$sort", "$inc")->get()
          ];
        } else {
          $data = [
            'title' => 'Профайлы',
            'likes' => Profile::leftJoin('publications', function($join) {
              $join->on('profiles.id_profile', '=', 'publications.id_profile');})->get(),
            'menu_list' => 'active',
            'profiles' => Profile::leftJoin('subscribes', function($join) {
              $join->on('profiles.id_profile', '=', 'subscribes.sub_profile');
            })->where('activate', 1)->orderBy("$sort", "$inc")->get()
          ];
        }



      return view('list', $data)->with(["page" => "list"]);
  }

  public function subscribe(Request $request)
  {

      $my_profile = Auth::user()->id;

      $a = new Subscribe;

      $a->sub_profile = $request->id_profile;
      $a->my_profile = $my_profile;

      $a->save();

      $sub = Profile::where('id_profile', $request->id_profile)->pluck('subscribes');
      $sub = $sub[0]+1;

      Profile::where('id_profile', $request->id_profile)
                          ->update(['subscribes' => $sub]);

      return back();

  }

  public function unsubscribe(Request $request)
  {

      $unsub = $request->unsub;

      $del = Subscribe::where('id_sub', $unsub);
      $del->delete();

      $sub = Profile::where('id_profile', $request->id_profile)->pluck('subscribes');
      $sub = $sub[0]-1;

      Profile::where('id_profile', $request->id_profile)
                          ->update(['subscribes' => $sub]);

      return back();
  }
  /**
  * my profiles
  */

  public function my_profiles()
  {
      $my_profile = Auth::user()->id;

      $data = [
        'title' => 'My profiles',
        'profiles' => Profile::where('id_user',$my_profile)->where('activate', 1)->get()
      ];

      return view('my_profiles', $data);
  }

   public function create_profile(Request $request)
   {

       $a = new Profile;

       if (isset($request->images)) {
       $this->validate($request, [
           'name_profile' => 'required|min:3|unique:profiles',
           'description' => 'required|min:5',
           'images' => 'image|mimes:jpeg,png,jpg|max:2048',
       ]);


       $imageName = $request->id_user . '_' . time().'.'.$request->images->getClientOriginalExtension();
       $request->images->move(public_path('images/profiles/'), $imageName);
       $a->avatar = $imageName;
       } else {
         $this->validate($request, [
             'name_profile' => 'required|min:3|unique:profiles',
             'description' => 'required|min:5'
         ]);

         $a->avatar = 'default.jpg';
       }


       $a->id_user = $request->id_user;
       $a->name_profile = $request->name_profile;
       $a->description = $request->description;
       $a->likes = 0;
       $a->subscribes = 0;
       $a->activate = 1;

       $a->save();

       return redirect('/my_profiles');
   }


   public function edit_profile($id)
   {
        {
         $data = [
           'title' => 'Edit'
         ];

        $edit = Profile::where('id_profile', $id)->first();

        return view('edit_profile',$data)->with('edit', $edit);
       }
   }

  public function edit_profile_post(Request $request)
  {
      $this->validate($request, [
        'name_profile' => 'required|min:3|unique:profiles',
        'description' => 'required|min:5',
        'images' => 'image|mimes:jpeg,png,jpg|max:2048',
        'sex' => 'required'
       ]);

       $imageName = $request->id_user . '_' . time().'.'.$request->images->getClientOriginalExtension();
       $request->images->move(public_path('images/profiles/'), $imageName);

      $a = Profile::where('id_profile', $request->id_profile)->update([
        'id_user' => $request->id_user,
        'name_profile' => $request->name_profile,
        'description' => $request->description,
        'avatar' => $imageName,
        'sex' => $request->sex,
        'likes' => $request->likes,
        'subscribes' => $request->subscribes
      ]);

      return redirect('/my_profiles');
  }

  public function my_destroy($id)
  {

      Profile::where('id_profile', $id)
                          ->update(['activate' => 0]);
      return back();
  }
}
