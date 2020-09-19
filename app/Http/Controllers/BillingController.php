<?php

namespace App\Http\Controllers;

use App\Plan;
use App\User;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billing(Request $request)
    {
        $plans = Plan::get();
        return view('profile.billing', compact('plans'));
    }

    public function billing_save(Request $request)
    {
        $user = auth()->user();

        try {
            if ($user->subscribed('main')) {
                // update their credit card
                $user->updateDefaultPaymentMethod($request->payment_method);

            } else {
                $plan = Plan::where('name', '=', $request->plan)->first();
                $user->plan_id = $plan->id;
                $user->trial_ends_at = null;
                $user->save();

                $user->newSubscription('main', $request->plan)->create($request->payment_method);
            }
        } catch (Exception $e) {
            return back()->with(['alert' => 'Something went wrong submitting your billing info', 'alert_type' => 'error']);
        }

        return back()->with(['alert' => 'Successfully updated your billing info. Thank you!', 'alert_type' => 'success']);
    }

    public function switch_plan(Request $request)
    {
        $plan = Plan::where('name', '=', $request->plan)->first();
        $user = auth()->user();

        try {
            $user->subscription('main')->swap($request->plan);
            $user->plan_id = $plan->id;
            $user->save();
            $this->updateAllUsersPlanId($user, $user->plan_id);
        } catch (Exception $e) {
            return back()->with(['alert' => 'Sorry, there was an error switching plans.', 'alert_type' => 'error']);
        }

        return back()->with(['alert' => 'Successfully switched your plan', 'alert_type' => 'success']);
    }

    private function updateAllUsersPlanId($user, $plan_id)
    {
        User::where('tenant_id', $user->tenant_id)->update(['plan_id' => $plan_id]);
    }

    public function cancel(Request $request)
    {

        auth()->user()->subscription('main')->cancel();
        return back()->with(['alert' => 'Successfully cancelled your subscription', 'alert_type' => 'success']);
    }

    public function resume(Request $request)
    {

        auth()->user()->subscription('main')->resume();
        return back()->with(['alert' => 'Successfully resumed your subscription', 'alert_type' => 'success']);
    }

    public function invoices(Request $request)
    {

        try {
            $invoices = auth()->user()->invoices();
        } catch (\Exception $e) {
            return back()->with(['alert' => 'Error viewing Invoices: '.$e->getMessage(), 'alert_type' => 'error']);
        }

        return view('profile.invoices', compact('invoices'));
    }

    public function invoices_download(Request $request, $invoiceId)
    {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'trach.io',
            'product' => 'trach.io Subscription',
        ]);
    }

}
