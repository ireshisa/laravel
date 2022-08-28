@extends('layouts.master')
<div class="container body-content grey-background pb-4">
{{--     Blog-content staring--}}
    <div class="row cards-container text-center ourblogsection">

        <div class="col-md-12 mt-5 mb-4 text-left"><h1>Our Blog</h1></div>

        @foreach ($blogs as $blog)
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3 card-wrapper view-blog"><a href="{{ url('page/'.$blog->slug) }}">
            <div>
                <div class="mx-1 custom-card">
                    <div class="image">
                    <img src="{{url('images/group931.png')}}" class="pt-4 mt-3 imagecard-blog">
                        <p class="image-text">{{ $blog->title }}</p>
                    </div>
                    <h4 class="pt-4 pb-2 px-3 card-title">{{ $blog->title }}</h4>
                    <h4 class="px-2 text-muted">{{ $blog->author }}</h4>
                    <p class="px-3 pb-4"><small>{{ $blog->date }}</small></p>
                    <p class="px-3 pb-4">
                       {{ Str::limit(strip_tags($blog->content), 100) }}
                    </p>
                </div>
            </div></a>
        </div>
        @endforeach

    </div>

    @if(!$blogs->isEmpty())
        {{ $blogs->links() }}
    @endif

{{--    blog content ending--}}
</div>

@section('before_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

