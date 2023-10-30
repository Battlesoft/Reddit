<?php

namespace App\Queries;
use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public static function getByChannel(Channel $channel)
    {
        return CommunityLink::where('approved', 1)->where('channel_id', $channel['id']);
    }

    public static function getAll()
    {
        return $links = CommunityLink::where('approved', 1);
    }

    public static function getMostPopular($links)
    {
        return $links->withCount('users')->orderBy('users_count', 'desc')->paginate(25);
    }
    public static function sortByLatest($links)
    {
        return $links->latest('updated_at')->paginate(25);
    }

    public static function getBySearch(String $busqueda)
    {
        return CommunityLink::where('title', 'like', '%' . $busqueda . '%')->latest('updated_at')->paginate(25);
    }
    
}
