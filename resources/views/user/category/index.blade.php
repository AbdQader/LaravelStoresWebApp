@extends('layouts.user_layout')

    @section('style')
        <style type="text/css">
            .image-style {
                width: 610px;
                height: 463px;
            }
            .empty-style {
                font-size: 30px;
                font-weight: bold;
            }
        </style>
    @stop

    @section('page_heading')
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                    <h2>Discover<br>Categories</h2>
                </div>
            </div>
        </div>
    @stop

    @section('page_content')
        <div class="popular-product pt-50">
            <div class="container-fluid">
                <div class="row">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="single-product mb-50">
                                    <div class="location-img">
                                        <img class="image-style" src="{{ $category->image }}" alt="">
                                    </div>
                                    <div class="location-details">
                                        <p>{{ $category->name }}</p>
                                        <a href="{{ URL('category/' . $category->id . '/stores') }}" class="btn">See Stores</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 50px">
                            <p class="empty-style">
                                Oops!! there are no categories yet.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @stop