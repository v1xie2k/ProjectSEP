<div class="nav">
    <img class="logo" src="{{asset("css/gallery/logo.png")}}" alt="">
    <a class="ar" href="{{url('home')}}">Home</a>
    @if (isLogin())
        <a class="ar" href="{{url('home/menu')}}">Menu</a>
        @else
        <a class="ar" href="{{url('home/menu')}}">Menu</a>
        @endif


    @if(isLogin())
        <a class="ar" href="{{url('home/cart')}}">Cart</a>
        <a class="ar" href="{{url('home/user/profile')}}">Profile</a>
    @endif
    <div style="display: flex; justify-content: flex-end; flex-grow: 1;"></div>
        @if (isLogin())
            {{-- <form action="{{url('dologout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success">Logout</button> --}}
                <a class="ar" href="{{url('dologout')}}">Logout</a>
            {{-- </form> --}}
        @else
            <a class="ar" href="{{url('login')}}">Login/Register</a>

        @endif
    </div>
 </div>
