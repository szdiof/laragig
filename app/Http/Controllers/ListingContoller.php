<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;


class ListingContoller extends Controller
{
    //Show single listing
    public function index(){
        return view('Listings.index',[
            'heading' => 'Everything is great',
    
            'listings' => Listing::latest()->filter(request(['tag','search']))->simplePaginate(6)
    
        ]);
    }

    //Show Single Listing
    public function show(Listing $listing){
        return view('Listings.show', [
            'list' => $listing,
        ]);
    }

    //Show create form
    public function create(){
        return view('Listings.create');
    }

    public function store(Request $request){
        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required', 'unique:listings,company'],
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')){
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        Listing::create($formField);

        return redirect('/')->with('message', 'List ceated Successfull');
    }

    public function edit(Listing $listing){
    
        return view('Listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing){
        // Make Sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorizes action');
        }

        $formField = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')){
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formField);

        return back()->with('message', 'List update Successfull');
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorizes action');
        }
        $listing->delete();

        return redirect('/')->with('message', 'List deleted Successfull');
    }

    //Manage Functions
    public function manage(){
        return view('Listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
