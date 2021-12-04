@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2 id="event" class="text-success"></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        Echo.channel('laravel_database_test')
            .listen('.TestEvent',function (e) {
                /*$("#event").text(e.message);*/
                console.log(e);
            });

        console.log('testing event');
    </script>
@endsection
