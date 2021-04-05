<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list($activityId, $type)
    {
        $model = comment::TYPE[$type];
        return $model::findOrFail($activityId)->comments->sortByDesc('id');
    }

    public function store(Request $request, $type)
    {
        $comment = new Comment();
        $comment->comment = $request->get('comment');

        $comment->user()->associate(auth()->user());

        $model = comment::TYPE[$type];
        $model = $model::find($request->get('activityId'));
        return $model->comments()->save($comment);
    }

    public function answers($id) {
        return Comment::where('parent_id', $id)->get();
    }

    public function storeAnswer(Request $request, $type) {
        $comment = new Comment();
        $comment->comment = $request->get('comment');
        $comment->parent_id = $request->get('parent_id');

        $comment->user()->associate(auth()->user());
        $model = comment::TYPE[$type];
        $activity = $model::find($request->get('activityId'));
        return $activity->comments()->save($comment);
    }

    public function delete(Request $request)
    {
        $comment = Comment::find($request->get('commentId'));
        $comment->delete();
    }
}
