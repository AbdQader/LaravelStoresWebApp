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
            .image-style {
                width: 100px;
                height: 100px;
            }
            td, th {
                text-align: center;
                vertical-align: middle;
            }
        </style>
    @stop

    @section('page_heading')
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>Dashboard</h2>
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

        <!-- To Show The Stores -->
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Reviews</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td class="col-4">
                                    <img class="image-style" src="{{ $store->image }}">
                                </td>
                                <td>{{ $store->name }}</td>
                                <td>
                                    <div class="rating mb-10" style="color:#FBBA42">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $store->ratings_average)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ $store->ratings_count }} Reviews</td>
                                <td>
                                    <div class="row" style="padding-left: 15px">
                                        <a href="{{ URL('store/' . $store->id . '/edit') }}" class="btn" style="background-color: #007BFF;">Edit</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <form action="{{ URL('store/delete/' . $store->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" style="background-color: #DC3545;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="width: 0; margin: auto; padding: 30px">
                    {{ $stores->links() }}
                </div>
            </div>
        </div>
    @stop