<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list($activityId)
    {
        $activity = Activity::find($activityId);
        return $activity->comments->sortByDesc('id');
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->get('comment');
        $comment->user()->associate(auth()->user());

        $activity = Activity::find($request->get('activityId'));
        return $activity->comments()->save($comment);
    }

    public function delete(Request $request)
    {
        $comment = Comment::find($request->get('commentId'));
        $comment->delete();
    }
}
