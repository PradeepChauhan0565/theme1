<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use App\Models\ShopByCategory;
use App\Models\WeddingIdentity;
use App\Models\GetInspired;
use App\Models\FeaturedCollections;
use App\Models\HeadingSingleBanner;
use App\Models\Subscribe;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExportSubscribe;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dashboard()
    {
        return view('dashboard');
    }
    public function profile()
    {
        return view('user-profile');
    }
    public function downloadExcle()
    {
        return Excel::download(new ExportSubscribe, 'subscribers.xlsx');
    }

    public function popup()
    {
        return view('popup');
    }

    public function Accept(Request $request)
    {
        $request->session()->put('popup', 'accepted');
        return redirect("/");
    }

    public function newsletter(Request $request)
    {
        $exist =  Subscribe::where('email', $request->email)->first();

        if ($exist) {
            if ($exist->status == 'unsubscribe') {
                Subscribe::where('email', $request->email)->update([
                    'status' => 'subscribe',
                ]);
                return 'You have successfully subscribed to our newsletter';
            }
            return 'You have already subscribed to our newsletter';
        } else {
            $this->validate($request, [
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            ]);
            $details = [
                'title' => 'Subscribe',
                'body' => 'Thank you for Subscribing',
                'email' => $request->email,
            ];
            Mail::to($request->email)->send(new SendMail($details));
            Subscribe::Create([
                'email' => $request->email,
                'status' => 'subscribe',
            ]);
            return 'You have successfully subscribed to our newsletter';
        }
    }

    public function unsubscribe(Request $request)
    {
        Subscribe::where('email', $request->email)->update([
            'status' => 'unsubscribe',
        ]);
        return redirect()->back()->with('msg', 'We hope to see you again...');
    }

    public function nonewsletter($email)
    {
        return view('unsubscribe', compact('email'));
    }
    public function index1()
    {
        return view('lazy');
    }

    public function index(Request $request)
    {

        // $request->session()->flash('message ', 'For testing');
        // Session::flash('message', 'This is a message!');
        // session(['alert-succes' => 'For testing']);
        $herobanners = HeroBanner::orderBy('order_by', 'asc')->where('status', 1)->get();
        $shopbycats = ShopByCategory::orderBy('order_by', 'asc')->where('status', 1)->get();
        $weddings = WeddingIdentity::orderBy('order_by', 'asc')->where('status', 1)->get();
        $getins = GetInspired::orderBy('order_by', 'asc')->where('status', 1)->get();
        $collections = FeaturedCollections::orderBy('order_by', 'asc')->where('status', 1)->get();
        $headings = HeadingSingleBanner::first();
        return view('index', compact('herobanners', 'shopbycats', 'weddings', 'getins', 'collections', 'headings'));
    }
}
