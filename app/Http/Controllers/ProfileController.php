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
            'title' => 'Today affairs',
            'profiles' => Profile::leftJoin('subscribes', function($join) {
              $join->on('profiles.id_profile', '=', 'subscribes.sub_profile');
            })->where('name_profile',"$search")->orderBy("$sort", "$inc")->get()
          ];
        } else {
          $data = [
            'title' => 'Today affairs',
            'profiles' => Profile::leftJoin('subscribes', function($join) {
              $join->on('profiles.id_profile', '=', 'subscribes.sub_profile');
            })->orderBy("$sort", "$inc")->get()
          ];
        }



      return view('list', $data);
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
}
