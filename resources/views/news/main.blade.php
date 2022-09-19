<!DOCTYPE html>
<html lang="en">
<head>
    @include('news.elements.head')
</head>
<body>

<div class="super_container">
	@include('news.elements.header')
	@yield('content')
	@include('news.elements.footer')
</div>

@include('news.elements.script')
</body>
</html>