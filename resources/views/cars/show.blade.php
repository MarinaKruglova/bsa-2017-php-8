@extends('cars.base')

@section('title', 'Car')

@section('content')
    <div class="row">
        <div class="col-md-12 main">
            <div class="card mb-3">
                <div class="card-block">
                    <h4 class="card-title">{{ $car['model'] }}</h4>
                    <p class="card-text">
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection