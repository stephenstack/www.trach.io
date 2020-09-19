<?php

namespace App\Http\Controllers;

use Artisan;
use DB;
use App\MailingList;
use App\RequestLog;
// use App\SupportComment;
// use App\SupportTicket;
use App\User;
// use App\Jobs\AdminCommentSupportNotificationJob;
// use App\Jobs\ClosedSupportNotificationJob;
// use App\Jobs\NewAnnouncementNotificationJob;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $cntHomePageRequests = RequestLog::count();

        $unverifiedUsersCnt = User::whereNull('email_verified_at')->count();
        $verifiedUsersCnt = User::whereNotNull('email_verified_at')->count();

        $unverifiedSubscribersCnt = MailingList::whereNull('email_verified_at')->count();
        $verifiedSubscribersCnt = MailingList::whereNotNull('email_verified_at')->count();

        $countCurrentSubs = DB::table('subscriptions')->where('ends_at', '>=', \DB::raw('NOW()'))->count();
        $countExpiredSubs = DB::table('subscriptions')->where('ends_at', '<=', \DB::raw('NOW()'))->count();

        $jobsCnt = DB::table('jobs')->count();
        $failedJobsCnt = DB::table('failed_jobs')->count();
        $shareddata = array(
            // 'openTicketsCount' => $openTicketsCount,
            'jobsCnt' => $jobsCnt,
            'failedJobsCnt' => $failedJobsCnt,
        );

        // $ticketCount = SupportTicket::count();

        return view('admin.dashboard', compact('cntHomePageRequests', 'countCurrentSubs', 'countExpiredSubs',
        'verifiedUsersCnt', 'unverifiedUsersCnt', 'verifiedSubscribersCnt', 'unverifiedSubscribersCnt', 'shareddata'));
    }

    public function getUsersWithIncompletePayments()
    {
        $usersWithStripeID = User::whereNotNull('stripe_id')->get();
        $usersWithoutSubscriptions = $usersWithStripeID->map(function ($user) {
            // dump($user->subscription('main') === null);
           if($user->subscription('main') === null){
               return $user;
           }
        });
        $filteredCollection = $usersWithoutSubscriptions->filter(function ($value) { return !is_null($value); });

        return $filteredCollection;
    }

    public function get_and_show_results($model)
    {
        $results  = DB::table($model)->latest()->paginate(10);
        return view('admin.'.$model, compact('results'));
    }


    public function get_and_show_failed_jobs_results()
    {
        $results  = DB::table('failed_jobs')->orderBy('failed_at', 'desc')->paginate(10);
        return view('admin.failed_jobs', compact('results'));
    }


    public function subscriptions_show()
    {
        $users = User::all();
        $results = $users->filter->subscription('main');
        return view('admin.subscriptions', compact('results'));
    }

    public function incomplete_payments_show()
    {
        $results = $this->getUsersWithIncompletePayments();
        return view('admin.incomplete_payments', compact('results'));
    }

    public function downloads_show()
    {
        $results = DB::table('request_logs')->latest()->paginate(10);
        return view('admin.downloads', compact('results'));
    }

    public function create_announcement()
    {
        return view('admin.new_announcement');
    }

    public function store_announcement(Request $request)
    {
        $user = auth()->user();
        $msg = $request->message;
        $title = $request->title;
        if($msg == "" || $title == ""){
            return back()->with(['alert' => 'Please make sure to fill out title and message.', 'alert_type' => 'error'])
                        ->withInput($request->all());
        }

        if(!is_null($request->ends_at)){
            $ends_at = $request->ends_at . ' 00:00:00';
        } else {
            $ends_at = '2030-02-15 00:00:00';
        }
        $announcement = new Announcement;
        $announcement->user_id = $user->id;
        $announcement->title = $title;
        $announcement->message = $msg;
        $announcement->priority = $request->priority;
        $announcement->ends_at = $ends_at;
        $announcement->status = 1;

        $announcement->save();

        NewAnnouncementNotificationJob::dispatch($announcement, 'New rConfig '.$announcement->priority.' announcement - ' . $announcement->title);

        return redirect('admin/announcements')->with(['alert' => 'Successfully created annoumcement.', 'alert_type' => 'success']);
    }

    public function destroy_announcement($id)
    {
        $announcement = Announcement::destroy($id);
        if ($announcement) {
            return back()->with(['alert' => 'Successfully deleted announcement.', 'alert_type' => 'success']);
        }
    }

    public function tickets_show()
    {
        $results = SupportTicket::latest()->paginate(10);
        return view('admin.tickets', compact('results'));
    }

    public function ticket_show($id)
    {
        $ticket = SupportTicket::find($id);
        return view('admin.ticket_show', compact('ticket'));
    }

    public function ticket_comment_create($id)
    {
        $user = auth()->user();
        $ticket = SupportTicket::find($id);

        return view('admin.ticket_comment_create', compact('ticket'));
    }

    public function ticket_comment_store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = SupportComment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => auth()->user()->id,
            'comment' => $request->input('comment')
        ]);

        $ticket = SupportTicket::with('user')->where('id', $request->ticket_id)->get(); // get ticket detail for use in the CommentSupportNotificationJob
        AdminCommentSupportNotificationJob::dispatch($ticket, 'Comment Added to rConfig Support Ticket by Admin');

        return redirect('admin/view-ticket/'.$request->ticket_id)->with("status", "Your comment has be submitted.");
    }


    public function closeTicket($id)
    {
        $user = auth()->user();
        $ticket = SupportTicket::find($id);

        $ticket->status = 0;
        $ticket->save();
        $ticket = SupportTicket::with('user')->where('id', $id)->get();
        AdminCommentSupportNotificationJob::dispatch($ticket, 'rConfig Support Ticket Closed by Admin');

        return redirect('admin/tickets')->with(['alert' => 'Successfully closed your ticket. We were delighted to be of assistance!', 'alert_type' => 'success']);
    }

    public function destroy_ticket($id)
    {

        $ticket = SupportTicket::find($id);
        $ticket->comments()->delete();
        $ticket->delete();

        return back()->with(['alert' => 'Successfully deleted ticket.', 'alert_type' => 'success']);
    }

    public function jobs_retry_current_all()
    {
        Artisan::call('queue:restart');

        return back()->with(['alert' => 'Successfully restarted queue.', 'alert_type' => 'success']);
    }

    public function delete_all_current_jobs()
    {

        DB::table('jobs')->delete();
        return back()->with(['alert' => 'Successfully deleted all jobs.', 'alert_type' => 'success']);
    }

    public function jobs_retry_failed_all()
    {
        Artisan::call('queue:retry all');

        return back()->with(['alert' => 'Successfully restarted failed jobs queue.', 'alert_type' => 'success']);
    }

    public function delete_all_failed_jobs()
    {

        DB::table('failed_jobs')->delete();
        return back()->with(['alert' => 'Successfully deleted all jobs.', 'alert_type' => 'success']);
    }


}
