<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Publication;
use App\Comment;
use App\Tag;
use App\Profile;

class ProfileController extends Controller
{
  public function index()
  {

    $data = [
      'title' => 'Today affairs',
      'profiles' => Profile::all()
    ];

    return view('list', $data);
  }
}
