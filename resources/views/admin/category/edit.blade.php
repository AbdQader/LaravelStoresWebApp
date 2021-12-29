@extends('layouts.create_edit')

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
						<div class="alert alert-success">Category Updated Successfully.</div>
					</div>
				@else
					<div class="col-12">
						<div class="alert alert-danger">Update Category Failed!, Please try again later.</div>
					</div>
				@endif
			@endif
		</div>

		<!-- For Edit Category Form -->
		<div class="wrapper">
			<form action="{{ URL('category/update/' . $category->id) }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div id="wizard" style="height: 400px">
					<section>
						<h1 style="font-weight: bold;">Edit Category</h1>
						<br>
						<div class="form-header">
							<div class="image-container-style">
								<img id="blah" class="image-style" src="{{ $category->image }}" alt="">
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="form-group">
								<div class="form-holder">
									<input type="text" name="name" placeholder="Name" class="form-control" value="{{ $category->name }}">
								</div>
								<div class="form-holder">
									<input type="file" name="image" placeholder="Image" class="form-control" onchange="readURL(this);">
								</div>
								<div>
									<button class="btn" style="border-radius: 30px;">SAVE</button>
									<a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL('admin/categories') }}">BACK</a>
									{{-- <a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL()->previous() }}">BACK</a> --}}
								</div>
							</div>
						</div>
					</section>
				</div>
			</form>
		</div>
	@stop