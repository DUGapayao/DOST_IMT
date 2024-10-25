<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Http\Controllers\Controller;
use App\Models\MajorFinalOutput;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Notification; 
use App\Models\User; 
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $majorFinalOutputID): RedirectResponse
    {
        $majorFinalOutput = MajorFinalOutput::find($majorFinalOutputID);

        $request->validate([
            'comment' => ['required', 'string']
        ]);

        $comment = $majorFinalOutput->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

       
        $users = User::all();

        
        Notification::send($users, new CommentNotification($comment));

        return redirect(route('primaryIndicators.index'));
    }

    public function update($commentID, Request $request): RedirectResponse
    {
        $comment = Comment::findOrFail($commentID);

        $data = $request->validate([
            'comment' => ['nullable', 'string', 'max:255'],
        ]);

        $comment->update($data);

        return redirect(route('primaryIndicators.index'));
    }

    public function destroy($indicatorID)
    {
        $comment = Comment::findOrFail($indicatorID);
        $comment->delete();

        return redirect(route('primaryIndicators.index'));
    }
}
