@extends('layouts.user_layout')

    @section('style')
        <style type="text/css">
            .image-style {
                width: 400px;
                height: 450px;
            }
            .search-result {
                font-size: 30px;
                font-weight: bold;
            }
        </style>
    @stop

    @section('page_heading')
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>Search Results</h2>
                    <p style="font-size: 20px">Search Results For "{{ $search }}"</p>
                </div>
            </div>
        </div>
    @stop

    @section('page_content')
        @if (count($stores) > 0)
            <!-- To Show The Stores -->
            <div class="popular-items pt-50">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($stores as $store)
                            <div class="col-lg-4 col-md-7 col-sm-7">
                                <div class="single-popular-items mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                                    <div class="popular-img">
                                        <img class="image-style" src="{{ $store->image }}" alt="">
                                        <div class="img-cap">
                                            <span>{{ $store->name }}</span>
                                        </div>
                                        <div class="favorit-items">
                                            <a href="{{ URL('store/' . $store->id . '/details') }}" class="btn">See Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 50px">
                <p class="search-result">No Results Found!, Please Try Again Later.</p>
            </div>  
        @endif
    @stop