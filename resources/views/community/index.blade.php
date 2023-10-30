@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash-message')

        <div class="row">

            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->exists('popular') ? '' : 'disabled' }}" href="{{ request()->url() }}">Most
                        recent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most popular</a>
                </li>
            </ul>  
            
            {{-- Left column to show all the links in the DB --}}
            <div class="col-md-8">

                <h1>Community {{ $channel ? $channel->title : '' }}</h1>
                @if (count($links) === 0)
                    <p>No approved contributions yet</p>
                @else
                    <ul>
                        @foreach ($links as $link)
                            <li>
                                <a class="text-decoration-none label label-default p-1 border-rounded text-black rounded"
                                    href="/community/{{ $link->channel->slug }}"
                                    style="background-color:{{ $link->channel->color }}">{{ $link->channel->title }}</a>
                                <a href="{{ $link->link }}" target="_blank">
                                    {{ $link->title }}

                                </a>
                                <small>Contributed by: {{ $link->creator->name }}
                                    {{ $link->updated_at->diffForHumans() }}</small>
                                {{ $link->users()->count() }}
                                <form method="POST" action="/votes/{{ $link->id }}">
                                    {{ csrf_field() }}
                                    <button type="submit"
                                        class="btn btn-secondary {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}"
                                        {{ Auth::guest() ? 'disabled' : '' }}>
                                        {{ $link->users()->count() }}
                                        <i class="bi bi-hand-thumbs-up-fill"></i>
                                    </button>
                                </form>
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
        {{ $links->appends($_GET)->links() }}

    </div>
@endsection
