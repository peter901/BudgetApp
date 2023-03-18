@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Transactions') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>Date</th>
                    <th>description</th>
                    <th>amount</th>
                    <th>category</th>
                    <th></th>
                </tr>
                @foreach ($transactions as $t)
                    <tr>
                        <td>{{ $t->date }}</td>
                        <td>{{ $t->description }}</td>
                        <td>{{ $t->amount }}</td>
                        <td>{{ $t->category->name }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('transactions.edit', [$t->id]) }}">Edit</a>
                            <form method="POST" style="display:inline;" action="{{ route('transactions.delete', $t->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @if ($transactions instanceof Illuminate\Contracts\Pagination\Paginator)
                {{ $transactions->links() }}
            @endif
        </div>
    </div>
@endsection
