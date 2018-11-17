<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackPost;
use App\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function saveFeedback(FeedbackPost $request)
    {
        $img='';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name=$image->getClientOriginalName();
            $destinationPath = public_path('/uploads');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $img = $name;
        }
        Feedback::create([
            'title' => $request['title'],
            'user_id' => Auth::id(),
            'msg' => $request['msg'],
            'img' => $img,
        ]);
        
        return redirect(url('/home'));
    }

    public function showForm()
    {
    	return view('feedbackform');
    }

}
