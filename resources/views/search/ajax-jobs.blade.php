<div class="d-block w-100">
<div class="sortfiltrs-contner with-rssfeed-enable">
    <div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
        <h2 class="jobsearch-fltcount-title">
            {{ $results->total() }} Jobs Found
        </h2>
    </div>
</div>

@foreach($results as $key => $post)
    <div class="row border person-info"
         style="margin-bottom: 45px">
        <div class="col-md-12 py-3 d-flex ">



            <div class="d-flex logo-container p-4  flex-shrink-1 align-items-center justify-content-center">

                <a href="post/{{$post->id}}">
                    <img src="{{ $post->logo ? asset('storage/' . $post->logo) : url('images/user.jpg')  }}"
                         alt="">
                </a>

            </div>
            <div class="d-flex align-items-center flex-grow-1 job-details ">
                <div class="w-100 px-3 d-block">

                    {{--										<div class="col-md-12">--}}
                    <h2 class="font-weight-bold"><a href="{{url('/post/'.$post->id)}}">{{$post->title}}</a></h2>
                    {{--										</div>--}}
                    {{--										<div class="col-md-12">--}}

                    <div class="w-100 d-flex flex-row-reverse">

                        <div class="d-inline-flex flex-shrink-0 px-2 align-items-center">
                            <h5 class="city"><i class="fa fa-map-marker"></i> {{$post->city->name}}</h5>

                        </div>
                        <div class="d-inline-flex flex-grow-1">
                            <div class="w-100 d-block">
                                <h5 class="company">{{$post->company->name}}</h5>
                                <h5>{{$post->category->name}}</h5>
                                <h6><i class="fa fa-clock"></i> {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="float-left p-2 px-3 color-white bg-blue text-capitalize">
                                <i class="fa fa-briefcase color-white mr-1"></i> {{$post->salaryType->name}}
                            </div>

                            @if(auth()->check() && auth()->user()->user_type_id == 2)
                                @if(!in_array($post->id,$saved))
                                    <a class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Save Job</a>
                                @else
                                    <a class="btn btn-primary btn-transparent save-job color-blue float-right" data-id="{{$post->id}}"><i class="fa fa-heart  mr-1"></i> Remove Job from Wishlist</a>

                                @endif
                            @endif

                        </div>
                    </div>
                </div>

                {{--									</div>--}}
            </div>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="col-md-12 mb-3">
        <nav class="search-talent">{{$results->links()}}</nav>

    </div>
</div>
</div>