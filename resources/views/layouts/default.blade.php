<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    <div id='app'>
        @include('includes.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>