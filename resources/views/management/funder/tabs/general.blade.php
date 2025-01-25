<form id="generalForm" action="{{ route('funder.store.general') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label class="col-md-3 label-control" for="category_id">Category</label>
        <div class="col-md-9">
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Add other fields for General Info Tab -->
    <div class="form-group row last mb-3">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Save & Next</button>
        </div>
    </div>
</form>
