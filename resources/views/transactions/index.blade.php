<table>

    @foreach ($transactions as $t )   
        <tr>
            <td>{{ $t->date }}</td>
            <td>{{ $t->description }}</td>
            <td>{{ $t->amount }}</td>
            <td>{{ $t->category->name }}</td>
        </tr>
    @endforeach
</table>