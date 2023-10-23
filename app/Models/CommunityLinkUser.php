<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkUser extends Model
{
    protected $fillable = ['user_id', 'community_link_id'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
        
    }
}
