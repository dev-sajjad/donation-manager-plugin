<?php

namespace FluentForm\DonationManager\Controllers;

use FluentForm\DonationManager\Models\Donation;
use FluentForm\Framework\Request\Request;
use FluentForm\App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \FluentForm\Framework\Response\Response
     */
    public function index()
    {
        $donations = wpFluent()->table('fluentform_donations')->get();

        return $this->sendSuccess([
            'donations' => $donations,
            200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \FluentForm\Framework\Request\Request $request
     * 
     * @return \FluentForm\Framework\Response\Response
     */

    public function store()
    {
        wpFluent()->table('fluentform_donations')->insert([
            'name' => Request::post('name'),
            'email' => Request::post('email'),
            'address' => Request::post('address'),
            'donation_category' => Request::post('donation_category'),
            'donation_amount' => Request::post('donation_amount'),
            'notes' => Request::post('notes'),
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        ]);

        return $this->sendSuccess([
            'message' => 'Donation added successfully',
            200
        ]);
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * 
     * @return \FluentForm\Framework\Response\Response
     */

    public function show($id)
    {
        $donation = wpFluent()->table('fluentform_donations')->where('id', $id)->first();

        return $this->sendSuccess([
            'donation' => $donation,
            200
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \FluentForm\Framework\Request\Request $request
     * @param int $id
     * 
     * @return \FluentForm\Framework\Response\Response
     */
    public function update($id)
    {
        wpFluent()->table('fluentform_donations')->where('id', $id)->update([
            'name' => Request::post('name'),
            'email' => Request::post('email'),
            'address' => Request::post('address'),
            'donation_category' => Request::post('donation_category'),
            'donation_amount' => Request::post('donation_amount'),
            'notes' => Request::post('notes'),
            'updated_at' => current_time('mysql')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * 
     * @return \FluentForm\Framework\Response\Response
     */
    public function destroy($id)
    {
        wpFluent()->table('fluentform_donations')->where('id', $id)->delete();

        return $this->sendSuccess([
            'message' => 'Donation deleted successfully',
            200
        ]);
    }
}
