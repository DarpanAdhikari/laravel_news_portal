<?php

namespace App\Http\Controllers\Update;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SubscriberNotification;

class VerifySubscriberController extends Controller
{
    public function verifySubscriber($token){
        $user = auth()->id() ? auth()->id() : null;
        $subscriber = Subscriber::where('remember_token',$token)->where('u_id',$user)->first();
        if($subscriber){
            $subscriber->email_verified_at = Carbon::now();
            $subscriber->remember_token = null;
            $subscriber->save();
            if(!$subscriber->u_id){
                session(['subscribed' => true]);
            }
            $subscriber->notify(new SubscriberNotification($subscriber));
            return redirect('/')->with([
                'type' => 'success',
                'title' => 'Subscribed',
                'message' => 'Thank you for subscribing us',
             ]);
        }else{
            return redirect('/')->with([
                'type' => 'error',
                'title' => 'Warning!',
                'message' => 'Unknown attempt!',
             ]);
        }
    }

    public function unSubscribe($id){
        $requiredPermissions = ['view post', 'delete post', 'update post', 'add post'];

        $usersWithPermissions = User::whereHas('roles.permissions', function ($query) use ($requiredPermissions) {
            $query->whereIn('name', $requiredPermissions);
        })->get();

        if (auth()->check() && (strtolower($id) == strtolower(auth()->user()->email)) && !$usersWithPermissions){
            $subscriber = Subscriber::where('u_id', auth()->id())
                                    ->where('email', auth()->user()->email)
                                    ->first();
            if ($subscriber){
                $subscriber->delete();
                return redirect('/')->with([
                    'type' => 'success',
                    'title' => 'Unsubscribed Successfully',
                    'message' => 'We hope you will give us the opportunity to collaborate again soon.',
                ]);
            } else {
                return redirect('/')->with([
                    'type' => 'error',
                    'title' => 'Subscriber Not Found',
                    'message' => 'We couldn\'t find your subscription record. Please log in with the email address you used for subscribing.',
                ]);
            }
        } else {
            return redirect('/')->with([
                'type' => 'error',
                'title' => 'Unauthorized Access',
                'message' => 'Please log in with the email address associated with your subscription to unsubscribe.',
            ]);
        }
    }
}
