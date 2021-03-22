@include('inc.head')
<body>
    <div id="app">
        @include('inc.header.admin')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
