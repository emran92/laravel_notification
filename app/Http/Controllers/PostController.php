<?php

namespace App\Http\Controllers;

use App\Notifications\PostCreateNotification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{

    public function addPost(Request $request){

        $data = $request->all();

//        dd($data);

        $post = Post::create(
            [
                'title'=>$data['title'],
                'body'=>$data['body'],
            ]
        );
        $users = User::all();

        foreach ($users as $user){
            Notification::send($user, new PostCreateNotification($post));
        }
        return redirect()->back();

    }
}
