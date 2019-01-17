@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Amazon Rekognition</div>

                    <div class="card-body">
                        <img src="{{ $image }}" class="img-thumbnail">
                        <ul>
                            @if($result)
                                <h2>Labels</h2>
                                @foreach($result->get('Labels') as $label)
                                    <li>{{ $label['Name'] }}<span class="badge badge-secondary">{{ number_format($label['Confidence'], 2) }}%</span></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
