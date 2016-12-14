<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Publication;
use App\User;
use App\Comment;
use App\Tag;
use App\Profile;
use App\Subscribe;

class SettingsController extends Controller
{
  public function settings()
  {
        $user_id = Auth::user()->id;

        $data = [
            'title' => 'Today affairs',
            'settings' => User::where('id', $user_id )->get()
          ];

      return view('settings', $data);
  }

  public function update_settings(Request $request)
  {

      $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users'
      ]);

      $a = User::find($request->id_user);

      $a->name = $request->name;
      $a->email = $request->email;

      if ($request->password != null) {
        $a->password = bcrypt($request->password);

      }

      $a->save();
      return back();
  }

  public function stat()
  {
        $data = [
            'title' => 'Today affairs',
            'profiles' => 123
          ];

      return view('statistic', $data);
  }




}
