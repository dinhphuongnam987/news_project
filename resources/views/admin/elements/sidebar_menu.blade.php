<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('admin/img/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>luutruonghailan</h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('user') }}"><i class="fa fa-user"></i> User</a></li>
            <li><a href="{{ route('category') }}"><i class="fa fa fa-building-o"></i> Category</a></li>
            <li><a href="{{ route('article') }}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li><a href="{{ route('menu') }}"><i class="fa fa-book"></i> Menu</a></li>
            <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{ route('rss') }}"><i class="fa fa-newspaper-o"></i> Rss</a></li>
            <li><a href="{{ route('password') }}"><i class="fa fa-unlock-alt"></i> Change Password</a></li>
            <li><a href="{{ route('gallery') }}"><i class="fa fa-picture-o"></i> Gallery</a></li>
            <li><a href="{{ route('setting') }}"><i class="fa fa-cogs"></i> Setting</a></li>
            <li><a href="{{ route('contact') }}"><i class="fa fa-envelope"></i> Contact</a></li>
            <li><a href="{{ url('log-viewer') }}"><i class="fa fa-exclamation-circle"></i> Log Error</a></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
