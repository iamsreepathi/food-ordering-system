<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Mail\NewsletterSubscription;
use App\Models\Location;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $items = MenuItem::featured()->get();
        return Inertia::render('Welcome', [
            'items' => $items
        ]);
    }

    public function newsletter(SubscriptionRequest $request)
    {
        $subscriber = $request->get('email');
        Mail::to($subscriber)->queue((new NewsletterSubscription())->onQueue('account'));
        session()->flash('message', 'Newsletter subscription request received.');
        return back();
    }

    public function about()
    {
        $location = Location::firstOrFail();

        return Inertia::render('About', [
            'location' => $location,
        ]);
    }
}
