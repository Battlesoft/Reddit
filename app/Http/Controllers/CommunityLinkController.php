<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinksQuery;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Channel $channel = null)
    {
        $channels = Channel::orderBy('title', 'asc')->get();
        
        if ($channel != null) {

            $links = $channel->communitylinks()
            ->where('approved', true)
            ->latest('updated_at')
            ->paginate(25);
        } else {
            $links = CommunityLink::where('approved', true)
            ->latest('updated_at')
            ->paginate(25);
        }

        if (request()->exists('popular')) {
            // otra consulta
            $links = CommunityLink::where('approved', 1)->withCount('users')->orderBy('users_count', 'desc')->paginate(25);
            
        } else {
            if ($channel != null) {
                $links = $channel->communitylinks()->where('approved', true)->where('channel_id', $channel->id)->latest('updated_at')->paginate(25);
            } else {
                $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
                
            }
        }

        if (request()->exists('busqueda')) {
            $links = CommunityLinksQuery::getBySearch(trim(request()->get('busqueda')));
        }

        return view('community/index', compact('links', 'channels', 'channel'));
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
    public function store(CommunityLinkForm $request)
    {
        //

        $link = new CommunityLink();
        $link->user_id = Auth::id();

        $data = $request->validated();

        $user = Auth::user();

        $isTrusted = $user->isTrusted();

        $approved = $isTrusted ? true : false;

        $data['user_id'] = Auth::id();

        $data['approved'] = $approved;

        if ($link->hasAlreadyBeenSubmitted($data['link'])) {
            if ($approved == 1) {
                return back()->with('success', 'el enlace se ha actualizado correctamente');
            } else if ($approved == 0) {
                return back()->with('info', 'el enlace ya esta publicado y no estas aprobado');
            } else {
                return back()->with('info', 'error al cambiar el link');
            }
            ;
        } else {
            if ($approved == 1) {
                CommunityLink::create($data);
                return back()->with('success', 'el enlace se ha creado correctamente');
            } else {
                return back()->with('info', 'el enlace se ha pasado a revisar correctamente');
            }
            ;
        }

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