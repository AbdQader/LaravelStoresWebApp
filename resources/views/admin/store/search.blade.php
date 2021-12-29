@extends('layouts.admin_layout')

    @section('style')
        <style type="text/css">
            .title-style {
                font-weight: bold;
                font-size: 30px;
                text-transform: uppercase;
            }
            .reviews-style {
                font-weight: bold;
                font-size: 15px;
            }
            .rating-style {
                font-weight: bold;
                font-size: 20px;
            }
            .details-style {
                font-size: 20px;
                color: #000000;
            }
            .image-container-style {
                width: 30%;
                height: 300px;
            }
            .image-style {
                width: 100%;
                height: 100%;
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
        <!-- To Show Status of Delete Store -->
        @if (session()->has('status'))
            @if (session('status'))
                <div class="col-12">
                    <div class="alert alert-success">Store Deleted Successfully.</div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-danger">Delete Store Failed!, Please try again later.</div>
                </div>
            @endif
        @endif
        
        @if (count($stores) > 0)
            <!-- To Show The Stores -->
            <main style="padding-left: 18px;">
                @foreach ($stores as $store)
                    <section class="mb-5">
                        <div class="row">
                            <div class="image-container-style">
                                <img class="image-style" src="{{ $store->image }}">
                            </div>
                            <div class="col-md-6">
                            <p class="title-style">{{ $store->name }}</p>
                            <div class="rating mb-10" style="color:#FBBA42">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $store->ratings_average)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="reviews-style">{{ $store->ratings_count }} Reviews</p>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Address:</strong></th>
                                    <td>{{ $store->address }}</td>
                                    </tr>
                                    <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Phone:</strong></th>
                                    <td>{{ $store->phone }}</td>
                                    </tr>
                                    <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Category:</strong></th>
                                    <td>{{ $store->category->name }}</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            <div style="padding-top: 30px;"></div>
                            <div class="row" style="padding-left: 15px">
                                <a href="{{ URL('store/' . $store->id . '/edit') }}" class="btn" style="background-color: #007BFF;">Edit</a>
                                &nbsp;&nbsp;&nbsp;
                                <form action="{{ URL('store/delete/' . $store->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" style="background-color: #DC3545;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </section>
                @endforeach
            </main>
        @else
            <div style="text-align: center; padding: 50px">
                <p class="search-result">No Results Found!, Please Try Again Later.</p>
            </div>
        @endif
    @stop