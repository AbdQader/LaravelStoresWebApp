<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Store Website</title>

	<!-- CSS here -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="{{ asset('assets/fonts/add_store/material-design-iconic-font/css/material-design-iconic-font.css') }}">
	<!-- STYLE CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/add-store-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

	<style type="text/css">
		.image-container-style {
			width: 300px;
			height: 260px;
			background-color: #F7F7F7;
			border-radius: 10px;
		}
		.image-style {
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
    <!-- For Page Content -->
	@yield('page_content')
</body>
<script src="{{ asset('assets/js/add_store/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/add_store/jquery.steps.js') }}"></script>
<script src="{{ asset('assets/js/add_store/main.js') }}"></script>
<script>
	function readURL(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function (e)
			{
				$('#blah').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
</html>