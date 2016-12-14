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

class StatisticController extends Controller
{

  public function statistic()
  {
        $id_user = Auth::user()->id;
        $com =  Comment::where('id_profile', $id_user )->get();
        $pub =  Publication::where('id_profile', $id_user )->get();
        $date = User::where('id', $id_user )->get();
        $prof = Profile::where('id_user', $id_user )->get();

        // как посчитать лайки?
        $likes = Profile::where('id_user', $id_user)->sum('likes');

        $comments = count($com);
        $publications = count($pub);
        $profiles = count($prof);

        $data = [
            'title' => 'Today affairs',
            'comments' => $comments,
            'publications' => $publications,
            'likes' => $likes,
            'date' => $date,
            'profiles' => $profiles
          ];

      return view('statistic', $data);
  }




}
