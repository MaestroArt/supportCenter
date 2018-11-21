<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackPost;
use App\Feedback;
use App\UserVars;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Mail;
use App\Mail\ClientMessage;

class FeedbackController extends Controller
{
    public function saveFeedback(FeedbackPost $request)
    {
        $dtLastFeedback = UserVars::getValue('dt_last_feedback',Auth::id());
        if(null!=$dtLastFeedback)
        {
            $dt=Carbon::parse($dtLastFeedback);
            $dt=$dt->addMinutes(5);
            $today=Carbon::now();
            if($dt>$today) {
                $remainMinutes=$dt->diffInMinutes($today)+1;
                return Redirect::back()->withErrors(['freqRequest'=> "You can't create feedback too frequently. Please wait at least $remainMinutes minutes."]);
            }
        }

        $img = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/uploads');
            $imagePath = $destinationPath. "/".  $name;
            try {
                $image->move($destinationPath, $name);
                $img = $name;
            } catch (\Exception $e) {
                //file didn't load in our folder
            }
        }
        Feedback::create([
            'title' => $request['title'],
            'user_id' => Auth::id(),
            'msg' => $request['msg'],
            'img' => $img,
        ]);
        UserVars::setValue('dt_last_feedback',date("Y-m-d H:i:s"),Auth::id());

        $this->sendEmail();

        return redirect(url('/feedbacks'));
    }

    public function showForm()
    {
    	return view('feedbackform');
    }
    public function showAll()
    {
        $msgs=$columns=null;
        $names=['created_at'=>'Date','user_id'=>'User','title'=>'Title','status'=>'Status'];
        if("manager"==Auth::user()->role) {
            $msgs = Feedback::all();
            $columns=['created_at','user_id','title','status'];
        }
        else {
            $msgs = Feedback::where('user_id',Auth::id())->get();
            $columns=['created_at','title'];
        }

    	return view('feedbackreport', compact('msgs','columns','names'));
    }
    public function dialog($feedback_id)
    {
        $first = Feedback::where('id',$feedback_id)->get()[0];
        $msgs = Feedback::find($feedback_id)->dialogs;

        return view('dialogs', compact('first','msgs','feedback_id'));
    }
    public function saveDialog(Request $request)
    {
        if(!empty($request['msg'])) {
            $feedback = Feedback::find($request['feedback_id']);
            $feedback->dialogs()->create([
                'user_id' => Auth::id(),
                'msg' => $request['msg'],
            ]);
            if("manager"==Auth::user()->role) {
                $feedback->status='answered';
            }else {
                $feedback->status='question';
                $this->sendEmail();
            }
            $feedback->push();
        }
        
        return redirect(url('/dialog/'.$request['feedback_id']));
    }
    protected function sendEmail($to='support@maestrotools.ru')
    {
        try {    
            Mail::to($to)->send(new ClientMessage(Auth::user()->email));
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

}
