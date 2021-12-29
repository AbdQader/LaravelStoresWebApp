@extends('layouts.user_layout')

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
                width: 100%;
                height: 400px;
            }
            .image-style {
                width: 100%;
                height: 100%;
            }
        </style>
    @stop

    @section('page_heading')
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>Store Details</h2>
                </div>
            </div>
        </div>
    @stop

    @section('page_content')
        <!-- For Form Submission Status -->
        <div class="row">
            @foreach ($errors->all() as $msg)
                <div class="col-12">
                    <div class="alert alert-danger">{{ $msg }}</div>
                </div>
            @endforeach

            @if (session()->has('status'))
                @if (session('status'))
                    <div class="col-12">
                        <div class="alert alert-success">Your Rating Saved Successfully.</div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-danger">Something Went Wrong!, Please try again later.</div>
                    </div>
                @endif
            @endif
        </div>

        <section class="mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="image-container-style">
                        <img class="image-style" src="{{ $store->image }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="title-style">{{ $store->name }}</p>
                    <div class="row" style="margin-left: 0">
                       <div class="rating mb-10" style="color:#FBBA42">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $store->ratings_average)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        @if ($trending != null)
                            <div style="margin-top: 3px">
                                @if ($trending >= 3)
                                    <p style="color: #00AA00; font-weight: bold">
                                        <i class="fas fa-arrow-up"></i>
                                        Up &nbsp;&nbsp;
                                        <span style="color: #000;">1w Change</span>
                                    </p>
                                @else
                                    <p style="color: #AA0000; font-weight: bold">
                                        <i class="fas fa-arrow-down"></i>
                                        Down &nbsp;&nbsp;
                                        <span style="color: #000">1w Change</span>
                                    </p>
                                @endif
                            </div>
                        @endif
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
                    <br>
                    <p class="rating-style">Rate This Store</p>
                    <div class="stars">
                        <form action="{{ URL('store/rating/' . $store->id) }}" method="POST">
                            @csrf

                            <input type="radio" class="star star-5" id="star-5" name="rating" value="5" @if ($user_rating == 5) checked @endif />
                            <label class="star star-5" for="star-5"></label>
                            <input type="radio" class="star star-4" id="star-4" name="rating" value="4" @if ($user_rating == 4) checked @endif />
                            <label class="star star-4" for="star-4"></label>
                            <input type="radio" class="star star-3" id="star-3" name="rating" value="3" @if ($user_rating == 3) checked @endif />
                            <label class="star star-3" for="star-3"></label>
                            <input type="radio" class="star star-2" id="star-2" name="rating" value="2" @if ($user_rating == 2) checked @endif />
                            <label class="star star-2" for="star-2"></label>
                            <input type="radio" class="star star-1" id="star-1" name="rating" value="1" required @if ($user_rating == 1) checked @endif />
                            <label class="star star-1" for="star-1"></label>
                            
                            <div style="margin-left: 15px">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </section>
    @stop

    @section('script')
        <!-- For Star Rating -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @stop