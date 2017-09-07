<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User as User;
use App\Campaign as Campaign;
use App\Comment as Comment;
use App\Donation as Donation;

class HomeController extends Controller {

    protected $percentage = 5;

    protected function getName($id) {
        $campaign = Campaign::find($id);
        $user = User::where("email", $campaign->usermail)->first();
        unset($campaign);
        return $user["fullname"];
    }

    protected function getNameByCampaign(Campaign $campaign) {
        $user = User::where("email", $campaign->usermail)->first();
        unset($campaign);
        return $user["fullname"];
    }

    protected function actualFund($ori) {
        return (100 + $this->percentage) / 100 * $ori;
    }

    protected function original($actual) {
        return 100 / (100 + $this->percentage) * $ori;
    }

    /*protected function getComments($id) {
        return Comment::join("users", "comments.usermail", "=", "users.email")
                        ->select("fullname")
                        ->addSelect("comments.updated_at")
                        ->addSelect("content")
                        ->where("campid", "=", $id)
                        ->get();
    }*/

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $campaigns = Campaign::paginate(20);
        return view('home', compact("campaigns"));
    }

    /**
     * Show the form for creating a new campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("create");
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $campaign = new Campaign;

        $campaign->usermail = Auth::user()->email;
        $campaign->title = $request->input("title");
        $campaign->story = $request->input("story");
        $campaign->actual_fund = $this->actualFund(intval($request->input("fund")));
        $campaign->collected = 0.0;
        $campaign->save();
        
        unset($campaign);

        $message = "Kampanye Anda telah disimpan!";

        return view("create", compact("message"));
    }

    public function viewSumbangan() {
        $user = User::findOrFail(intval(Auth::user()->id));

        return view("sumbangan")->with("donations", User::findOrFail(intval(Auth::user()->id))->donations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        return view("edit")->with("campaigns", Campaign::select("id", "title")->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $campaign = Campaign::findOrFail(intval($request->input("campaign")));

        if($campaign->actual_fund <= floatval($request->input("fund"))) {

            $campaign->actual_fund = $this->actualFund(floatval($request->input("fund")));
            $campaign->save();

            unset($campaign);

            $message = "Perubahan berhasil!";

            return view("edit")->with("campaigns", Campaign::select("id", "title")->get())
                               ->with("message", $message);
            
        } else {
            die("Nilai baru harus lebih besar!");
        }
    }

    /**
     * View specific campaign
     */
    public function viewCampaign($id) {

        $campaign = Campaign::find($id);

        return view("campaign")->with("campaign", $campaign)
                               ->with("username", $this->getNameByCampaign($campaign));
    }

    public function storeComment(Request $request, $id) {
        $comment = new Comment;

        $comment->usermail = Auth::user()->email;
        $comment->campid = $id;
        $comment->content = $request->input("content");

        $comment->save();

        unset($comment);

        $message = "Komentar berhasil!";

        return view("campaign")->with("campaign", Campaign::find($id))
                               ->with("username", $this->getName($id))
                               ->with("message", $message);

    }

    /**
     * Donate for a project
     */
    public function donate(Request $request, $id) {
        $donation_amount = floatval($request->input("amount"));

        $user = User::findOrFail(intval(Auth::user()->id));

        if($donation_amount <= $user->balance) {
            
            //donate!
            $user->balance = floatval($user->balance) - $donation_amount;

            $campaign = Campaign::findOrFail(intval($id));
            $campaign->collected += $donation_amount;

            $user->save();
            $campaign->save();

            //creating message...
            $message = "Donasi Anda sebesar Rp " . $donation_amount . " sukses!<br />";
            $message .= "Saldo Anda sekarang: Rp " . $user->balance;

            //set donation data for user
            $donation = new Donation;
            $donation->usermail = Auth::user()->email;
            $donation->campid = intval($id);
            $donation->amount = $donation_amount;
            $donation->save();

            //clear memory
            unset($user);
            unset($donation_amount);
            unset($donation);

            return view("campaign")->with("campaign", $campaign)
                                   ->with("username", $this->getName($id))
                                   ->with("message", $message);
        } else {
            die("Gak cukup!");
        }
    }

    public function refill() {
        return view("refill");
    }

    public function storeRefill(Request $request) {
        if(Hash::check($request->input("password"), Auth::user()->password)) {
            $refill = floatval($request->input("amount"));
            $user = User::findOrFail(intval(Auth::user()->id));

            $user->balance += $refill;
            $user->save();

            $message = "Anda telah mengisi ulang saldo sebanyak Rp " . $refill . "<br />Saldo Anda: Rp" . $user->balance;

            return view("refill")->with("message", $message)->with("new_balance", $user->balance);

        } else {
            die("Wrong password");
        }
    }
}
