<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Http\Requests\CommunityLinkForm;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('community/index', compact('links', 'channels'));
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

        $data = $request->validate([
            'title' => 'required|max:255',
            'channel_id' => 'required|exists:channels,id',
            'link' => 'required|unique:community_links|url|max:255',
        ]);

        $data['user_id'] = Auth::id();


        $user = Auth::user();

        $isTrusted = $user->isTrusted();
        $approved = $isTrusted ? true : false;



        $data['user_id'] = Auth::id();
        $data['approved'] = $approved;

        CommunityLink::create($data);

        if ($isTrusted) {
            return redirect()->back()->with('success', 'El enlace se ha creado correctamente y se ha aprobado automáticamente.');
        } else {
            return redirect()->back()->with('info', 'El enlace se ha creado correctamente, pero está pendiente de aprobación.');
        }

        $data = $request->validated();

        return back();



        // dd($request->all());
        // dd($request->path());
        // dd($request->url());
        // dd($request);

        // return Response('Error', 404);
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