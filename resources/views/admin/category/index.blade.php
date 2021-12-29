@extends('layouts.admin_layout')

    @section('style')
        <style type="text/css">
            .image-style {
                width: 610px;
                height: 463px;
            }
        </style>
    @stop

    @section('page_heading')
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>All Categories</h2>
                </div>
            </div>
        </div>
    @stop

    @section('page_content')
        <!-- To Show Status of Delete Category -->
        @if (session()->has('status'))
            @if (session('status'))
                <div class="col-12">
                    <div class="alert alert-success">Category Deleted Successfully.</div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-danger">Delete Category Failed!, Please try again later.</div>
                </div>
            @endif
        @endif

        <!-- To Show The Categories -->
        <div class="popular-product pt-50">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product mb-50">
                                <div class="location-img">
                                    <img class="image-style" src="{{ $category->image }}" alt="">
                                </div>
                                <div class="location-details">
                                    <p>{{ $category->name }}</p>
                                    <div class="row">
                                        <a href="{{ URL('category/' . $category->id . '/edit') }}" class="btn" style="background-color: #007BFF;">Edit</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <form action="{{ URL('category/delete/' . $category->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" style="background-color: #DC3545;">Delete</button>
                                        </form>
                                    </div>                                    
                                    {{-- <a href="#" class="btn" style="background-color: #DC3545;">Delete</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @stop