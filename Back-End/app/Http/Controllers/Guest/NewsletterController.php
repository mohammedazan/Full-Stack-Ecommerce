<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

use function PHPUnit\Framework\returnSelf;

class NewsletterController extends Controller
{
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