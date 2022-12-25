<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Donations = Donation::all();
        $data = [
            'name' => 'Donation',
            'Donation' => $Donations
        ];
        return view('Donat.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        // dd($request->amount);
        return view('donate');
    }

    public function showWithGet()
    {
        return view('donate');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $user = Auth::user();
        // dd($user);
        $formfiled =  $request->validate(
            [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
                'amount' => ['required', 'numeric', 'min:1'],
                'card' => ['required', 'numeric', 'min:16']
            ]
        );

        //store data -> ask for visa if true create record else redirect back
        Donation::create([
            'name' => $request->name,
            "user_id" => $user->id,
            'email' => $request->email,
            'amount' => $request->amount,
            'card' => $request->card,
        ]);

        return redirect('/');
    }

    /**
    
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }

    public function view()
    {
        $allDonations = Donation::all();
        return view('dashboard.index', ['allDonations' => $allDonations]);
    }
}
