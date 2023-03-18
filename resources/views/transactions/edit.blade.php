@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Edit Transaction') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <form method="post" action={{ route('transactions.update',[$transaction->id]) }}>
                @method('PUT')
                @include('transactions._form')
                <button class='btn btn-primary' type='submit'>Edit</button>
            </form>
        </div>
    </div>
@endsection
