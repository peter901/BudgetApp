@csrf
<div class="mb-3">
    <label class="form-label">Description</label>
    <input class="form-control" name="description" value="{{ old('description') ?: $transaction->description }}"
        type="text" />
</div>
<div class="mb-3">
    <label class="form-label">Date</label>
    <input class="form-control " name="date" value="{{ old('date') ?: $transaction->date }}" type="date" />
</div>
<div class="mb-3">
    <label class="form-label">Amount</label>
    <input class="form-control" name="amount" value="{{ old('amount') ?: $transaction->amount }}" type="number" />
</div>
<div class="mb-3">
    <label class="form-label">Category</label>
    <select class="form-control" name="category_id">
        <option value=''> Select </option>
        @foreach ($categories as $c)
            <option value='{{ $c->id }}'
                {{ ($c->id == old('category_id') ?: $transaction->category_id) ? 'selected' : '' }}> {{ $c->name }}
            </option>
        @endforeach
    </select>
</div>
