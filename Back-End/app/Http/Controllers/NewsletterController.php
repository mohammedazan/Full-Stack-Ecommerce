<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

use function PHPUnit\Framework\returnSelf;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters',
        ]);

        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save(); // Corrected line

        return back()->with('success', 'Thank you for subscribing!');
    }

    public function list_subscribe(){
        $list_subscribe = Newsletter::get();
        return view('adminPanel.Newsletter.list-subscribe')->with(compact('list_subscribe'));

    }
    public function deleted_subscribe(Request $request)
    {
        
        $newsletter = Newsletter::find($request->id);

        if ($newsletter) {
            $newsletter->delete();
            return redirect()->back()->with('success', 'Your subscriber has been deleted');
        }

        return redirect()->back()->with('error', 'Subscriber not found');
    }
}