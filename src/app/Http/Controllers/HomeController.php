<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Mail\NewsletterSubscription;
use App\Models\Location;
use App\Models\MenuItem;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $items = MenuItem::featured()->get();
        $locations = Location::all();
        return Inertia::render('Welcome', [
            'items' => $items,
            'locations' => $locations
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

    public function log()
    {
        Log::info('Welcome to food mania');
        try {
            throw new Exception('Something broken.');
        } catch (Exception $e) {
            Log::error($e);
        }
        return response()->json([
            'message' => 'Welcome to food mania'
        ]);
    }
}
