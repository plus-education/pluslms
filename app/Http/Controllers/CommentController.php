<?php

namespace App\Http\Controllers;

use App\Bundles\Notifications\Aplication\CommentNotificator;
use App\Bundles\Notifications\Domain\Notification;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Roles;
use App\Notifications\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list($activityId, $type)
    {
        $model = comment::TYPE[$type];
        return $model::findOrFail($activityId)->comments->sortByDesc('id');
    }

    public function store(Request $request, $type, CommentNotificator $notificator)
    {
        $comment = new Comment();
        $comment->comment = $request->get('comment');

        $comment->user()->associate(auth()->user());

        $model = comment::TYPE[$type];
        $model = $model::find($request->get('activityId'));


        $notification = new Notification("Nuevo Comentario | {$model->course->name}  {$model->course->group->name}",
            substr(strip_tags($comment->comment), 0, 25) . '...',
            $request->get('resourceId'),
            $request->get('resourceName')
        );

        $notificator->sendToUsersWithRole( Roles::ADMIN, $notification);
        $notificator->sendToTeacherCourse($model->course, $notification);

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
