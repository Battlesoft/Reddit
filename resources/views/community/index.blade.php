@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash-message')
        
        <div class="row">
            {{-- Left column to show all the links in the DB --}}
            <div class="col-md-8">
                
                <h1>Community {{ $channel ? $channel->title : '' }}</h1>
                @if (count($links) === 0)
                
                    <p>No approved contributions yet</p>
                @else
                    <ul>
                        @foreach ($links as $link)
                            <li>
                                <a class="text-decoration-none label label-default p-1 border-rounded text-black rounded" href="/community/{{ $link->channel->slug }}" style="background-color:{{$link->channel->color}}">{{ $link->channel->title }}</a>
                                <a href="{{ $link->link }}" target="_blank">
                                    {{ $link->title }}  
                                    
                                </a>
                                <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
                                {{$link->users()->count()}} 
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            {{-- Right column to include the add-link partial --}}
            <div class="col-md-4">
                @include('partials.add-link')
            </div>
        </div>
        {{ $links->links() }}
        
    </div>
@endsection