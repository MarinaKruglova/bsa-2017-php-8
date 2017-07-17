<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
    <div class="collapse navbar-collapse">
        <a class="navbar-brand" href="{{ route('cars-list') }}">Car Rental</a>

        {{ $slot }}
    </div>
</nav>