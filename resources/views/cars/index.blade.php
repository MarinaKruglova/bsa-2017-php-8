@extends('cars.base')

@section('title', 'Cars list')

@section('content')
    @if (count($cars) === 0)
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">No cars</h4>
            <!-- <h4 class="alert-heading">Sorry, but all cars are in leased right now</h4> -->
        </div>
    @else
        <ul class="list-unstyled">
            @each('cars/list-item', $cars, 'car')
        </ul>
    @endif
@endsection