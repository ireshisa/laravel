{{--
 * LaraClassified - Geo Classified Ads CMS
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
@extends('layouts.master')

@section('search')
	@parent
    @include('pages.inc.page-intro')
@endsection

@section('content')
	<style>
		.comment {
			overflow: hidden;
			padding: 0 0 1em;
			border-bottom: 1px solid #ddd;
			margin: 0 0 1em;
			*zoom: 1;
		}

		.comment-img {
			float: left;
			margin-right: 33px;
			border-radius: 5px;
			overflow: hidden;
		}

		.comment-img img {
			display: block;
		}

		.comment-body {
			overflow: hidden;
		}

		.comment .text {
			padding: 10px;
			border: 1px solid #e5e5e5;
			border-radius: 5px;
			background: #eceeef;
			color: black;
		}

		.comment .text p:last-child {
			margin: 0;
		}

		.comment .attribution {
			margin: 0.5em 0 0;
			font-size: 14px;
			color: #666;
		}

		/* Decoration */

		.comments,
		.comment {
			position: relative;
		}

		.comments:before,
		.comment:before,
		.comment .text:before {
			content: "";
			position: absolute;
			top: 0;
			left: 65px;
		}

		.comments:before {
			width: 3px;
			top: -20px;
			bottom: -20px;
			background: rgba(0,0,0,0.1);
		}

		.comment:before {
			width: 9px;
			height: 9px;
			border: 3px solid #fff;
			border-radius: 100px;
			margin: 16px 0 0 -6px;
			box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(0,0,0,0.1);
			background: #ccc;
		}

		.comment:hover:before {
			background: orange;
		}

		.comment .text:before {
			top: 18px;
			left: 78px;
			width: 9px;
			height: 9px;
			border-width: 0 0 1px 1px;
			border-style: solid;
			border-color: #e5e5e5;
			background: #fff;
			-webkit-transform: rotate(45deg);
			-moz-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			-o-transform: rotate(45deg);
		}
	</style>
	@include('common.spacer')
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">
                    
                    @if (empty($page->picture))
					<div class="col-md-12">
                        <h1 class="text-center title-1" style="color: {!! $page->name_color !!};"><strong>{{ $page->name }}</strong></h1>
						<h5 class="text-muted text-center title-3">By {{ $page->author }}</h5>
						<p class="text-center title-5"><small>{{ $page->date }}</small></p>
						<hr class="center-block small mt-0" style="background-color: {!! $page->name_color !!};">
					</div>
                    @endif
                    
					<div class="col-md-12 page-content">
						<div class="inner-box relative">
							<div class="row">
								<div class="col-sm-12 page-content">
                                    @if (empty($page->picture))
										<!--<h3 class="text-center" style="color: {!! $page->title_color !!};">{{ $page->title }}</h3>-->
                                    @endif
									<div class="text-content text-left from-wysiwyg">
										{!! $page->content !!}
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>

				<!--@include('layouts.inc.social.horizontal')-->

			</div>
		</div>
	</div>
	<div class="container">
		@if(auth()->check())
		<div class="row">
			<div class="col-sm-12 col-sm-offset-1" id="logout">
				<div class="page-header">
					<h3 class="reviews">Leave your comment</h3>
				</div>
				<form action="{{ url('page/comment/'.$page->id) }}" method="post" class="form-horizontal" id="commentForm" role="form">
					<div class="form-group">
						<label for="comment" class="col-sm-2 control-label">Comment</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="comment" id="comment" rows="5" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"> Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		@endif
		@if(!empty($comments->count()))
			<h3>Comments</h3>
			<section class="comments mt-4 ">
			@foreach ($comments as $comment)
			<article class="comment mb-5">
				<a class="comment-img" href="#non">
					@if (!empty($userPhoto))
						<img src="{{ asset('storage/' . $userPhoto) }}" alt="" width="50" height="50">
					@else
						<img src="{{ url('images/user.jpg') }}" alt="" width="50" height="50">
					@endif
				</a>
				<div class="comment-body">
					<div class="text">
						<p>{{ $comment->comment }}</p>
					</div>
					<p class="attribution">by <strong>{{ $comment->fromUser->name }}</strong> <small>{{ $comment->updated_at }}</small>
					@if(auth()->check() && auth()->user()->id == $comment->from_user_id)
					<a class="mr-2 ml-3" id="edit" data-toggle="modal" data-target="#editcomment-{{ $comment->id }}" ><i class="fa fa-pen fa-sm"></i> edit</a>
					@endif
					@if(auth()->check() && auth()->user()->id == $comment->from_user_id || auth()->check() && auth()->user()->id == 1)
					<a class="ml-2" id="delete" data-toggle="modal" data-target="#deletecomment-{{ $comment->id }}"><i class="fa fa-trash fa-sm"></i> delete</a>
					@endif
					</p>
				</div>
			</article>

				<div class="modal fade" tabindex="-1" role="dialog" id="editcomment-{{ $comment->id }}">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Comment</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="{{ url('page/comment/'.$comment->id.'/edit') }}" method="post" class="form-horizontal" id="commentForm" role="form">
							<div class="modal-body">
								@if(isset($comment->id))
									<textarea class="form-control" name="comment" id="comment" rows="4">{{ $comment->comment }}</textarea>
								@endif
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" tabindex="-1" role="dialog" id="deletecomment-{{ $comment->id }}">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Delete Comment</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{ url('page/comment/'.$comment->id.'/delete') }}" method="get" class="form-horizontal" id="commentForm" role="form">
									<div class="modal-body">
										<p>Are you sure you want to delete this Comment</p>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger">Delete</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>

				@endforeach
		@endif
		</section>
	</div>

@endsection

