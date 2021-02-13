<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        @foreach($items as $menu_item)
            <li>
                <a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
            </li>
        @endforeach
    </ul>
</div>

{{-- <div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="/" class="active">Home</a></li>
        <li class="dropdown"><a href="{{ route('shop.index') }}">Shop</i></a></li>
        <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="blog.html">Blog List</a></li>
                <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
        </li>
        <li><a href="404.html">404</a></li>
        <li><a href="contact-us.html">Contact</a></li>
    </ul>
</div> --}}