<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"  media="all" />
</head>
<body>
    <!-- Display any errors -->
    @if($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    {{-- <div class="login-wrap">
        <form class="form" method="POST" action="{{ url('login') }}">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div> --}}

    <div class="container">
        <section id="content">
            <form action="{{ url('login') }}">
                @csrf
                <h1>Login Form</h1>
                <div>
                    <input type="email" name="email" placeholder="Email" id="username" value="{{ old('email') }}" required/>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Password" id="password" required />
                </div>
                <div class="button-container">
                    <input type="submit" value="Log in" />
                    {{-- <a href="#">Lost your password?</a> --}}
                    {{-- <a href="#">Register</a> --}}
                </div>
            </form><!-- form -->
            {{-- <div class="button">
                <a href="#">Download source file</a>
            </div><!-- button --> --}}
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>
