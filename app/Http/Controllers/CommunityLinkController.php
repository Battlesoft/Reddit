<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::paginate(25);
        return view('community/index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    // dd($request->all());

    // dd($request->path());

    // dd($request->url());

    // return Response('Error', 404);


     // dd($request);

     $data = $request->validate([

        'title' => 'required|max:255',
       
       
       
        'link' => 'required|unique:community_links|url|max:255', 
       
       
       
        ]);
       
        $data['user_id'] = Auth::id();
       
        $data['channel_id'] = 1;
       
        CommunityLink::create($data);
       
        return back();

        // return redirect('/login')->with('success', 'Enlace enviado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
