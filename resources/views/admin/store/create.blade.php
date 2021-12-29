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
					<div class="alert alert-success">Store Added Successfully.</div>
				</div>
			@else
				<div class="col-12">
					<div class="alert alert-danger">Add Store Failed!, Please try again later.</div>
				</div>
			@endif
		@endif
	</div>

	<!-- For Create Store Form -->
	<div class="wrapper">
		<form action="{{ URL('store/store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			
			<div id="wizard" style="height: 520px">
				<section>
					<h1 style="font-weight: bold;">Create New Store</h1>
					<br>
					<div class="form-header">
						<div class="image-container-style">
							<img id="blah" class="image-style" alt="">
							<div class="avartar-picker">
								<input type="file" name="image" id="file-1" class="inputfile" onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
								<label for="file-1">
									<i class="zmdi zmdi-camera"></i>
									<span>Choose Picture</span>
								</label>
							</div>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="form-group">
							<div class="form-holder">
								<input type="text" name="name" placeholder="Name" class="form-control">
							</div>
							<div class="form-holder">
								<input type="text" name="address" placeholder="Address" class="form-control">
							</div>
							<div class="form-holder">
								<input type="text" name="phone" placeholder="Phone" class="form-control">
							</div>
							<div class="form-holder">
								<select name="category_id" class="form-control">
									<option value="" disabled selected>CATEGORY</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<br>
					<button class="btn" style="border-radius: 30px;">SAVE</button>
					<a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL('admin/stores') }}">BACK</a>
					{{-- <a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL()->previous() }}">BACK</a> --}}
				</section>
			</div>
		</form>
	</div>
	@stop