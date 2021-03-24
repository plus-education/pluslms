<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/students/{topicId}', function ($topicId) {
   $student = \App\Models\Topic::find($topicId)->course->users->map(function ($student) use($topicId) {
       $comment = ($student->topics->where('id', $topicId)->first()) ? $student->topics->where('id', $topicId)->first()->pivot->comment : '';

        return [
            'id' => $student->id,
            'name' => $student->name,
            'comment' => $comment
        ];
   });

   return $student;
});

Route::post('/saveComment/{topicId}', function (Request $request, $topicId){
    $student = \App\Models\User::find($request->post('studentId'));

    $commnet = $student->topics->where('id', $topicId)->first();

    if ($commnet) {
        return $student->topics()->updateExistingPivot($topicId, [
            'comment' => $request->post('comment')
        ]);
    }

    return $student->topics()->attach($topicId, [
        'comment' => $request->post('comment')
    ]);
});
