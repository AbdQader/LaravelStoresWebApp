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
						<div class="alert alert-success">Store Updated Successfully.</div>
					</div>
				@else
					<div class="col-12">
						<div class="alert alert-danger">Update Store Failed!, Please try again later.</div>
					</div>
				@endif
			@endif
		</div>

		<!-- For Edit Store Form -->
		<div class="wrapper">
			<form action="{{ URL('store/update/' . $store->id) }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div id="wizard">
					<section>
						<h1 style="font-weight: bold;">Edit Store</h1>
						<br>
						<div class="form-header">
							<div class="image-container-style">
								<img id="blah" class="image-style" src="{{ $store->image }}" alt="">
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
									<input type="text" name="name" placeholder="Name" class="form-control" value="{{ $store->name }}">
								</div>
								<div class="form-holder">
									<input type="text" name="address" placeholder="Address" class="form-control" value="{{ $store->address }}">
								</div>
								<div class="form-holder">
									<input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ $store->phone }}">
								</div>
								<div class="form-holder">
									<select name="category_id" class="form-control">
										@foreach ($categories as $category)
											<option value="{{ $category->id }}" @if ($category->id == $store->category_id) selected @endif>
												{{ $category->name }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

						<button class="btn" style="border-radius: 30px;">SAVE</button>
						<a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL('admin/stores') }}">BACK</a>
						{{-- <a class="btn" style="border-radius: 30px; font-family:'sans-serif'" href="{{ URL()->previous() }}">BACK</a> --}}
					</section>
				</div>
			</form>
		</div>
	@stop