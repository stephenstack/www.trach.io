<?php

namespace App\Http\Controllers;

use App\MailingList;
use App\Jobs\NewMailingListSubscriberRegistrationJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class HomeController extends Controller
{

    public function wwwindex()
    {
        return view('www');
    }

    public function termsindex()
    {
        return view('terms');
    }

    public function privacyindex()
    {
        return view('privacy');
    }

    public function mailingListSubscribe(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|unique:mailing_lists|email',
        ]);

        if($validator->fails()){
            if($validator->errors()->first() === "The email has already been taken."){
                return back()->with(['mailsuccess' =>'We\'ve already got your email address. Don\'t worry, we\'ll keep you up to date on all things trach.io!']);
            }
            return back()->with(['error' =>'Validation Error: ' . $validator->errors()->first()]);
        }

        $subscriber = New MailingList;
        $subscriber->email = $request->email;
        $saved = $subscriber->save();

        if($saved){
            NewMailingListSubscriberRegistrationJob::dispatch($subscriber);
            return back()->with(['mailsuccess' => 'Thanks! Please check your email for a verification link...!']);
        } else {
            return back()->with(['mailerrormsg' => 'Something went wrong, contact admin!']);
        }
    }

    public function mailingListSubscribeVerification($id)
    {
        $subscriber = MailingList::findOrFail($id);
        $subscriber->email_verified_at = Carbon::now();
        $subscriber->subscribed = 1;
        $subscriber->touch();
        $message = "Your email has been verified. Thanks for signing up, we will be in touch soon.";
        return view('subscriber_message', compact('message'));
    }

}
