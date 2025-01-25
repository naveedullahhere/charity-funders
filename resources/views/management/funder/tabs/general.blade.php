<div class="tab-pane fade show active" id="general" role="tabpanel">
    <div class="form-group">
        <label for="category_id">Category Name *</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">--Select a Category--</option>
            @foreach ($categories as $category)
                <option {{ $funder->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sub_category_id">Sub Category Name</label>
        <select name="sub_category_id" id="sub_category_id" class="form-control">
            <option value="">--- Select Sub Category ---</option>
            @foreach ($categories as $category)
                <option {{ $funder->sub_category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- @dd($funder) --}}
    <div class="form-group">
        <label for="type_id">Group *</label>
        <select name="type_id" id="type_id" class="form-control" required>
            <option value="">--Select a Group--</option>
            @foreach ($types as $type)
                <option {{ $funder->type_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">
                    {{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="company_name">Company Name *</label>
        <input type="text" value="{{ $funder->name }}" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="charity_no">Charity No *</label>
        <input type="text" name="charity_no" value="{{ $funder->charity_no }}" onkeypress="return DegitOnly(event);" id="charity_no" class="form-control"
            required>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number *</label>
        <input type="text" name="phone" value="{{ $funder->phone }}" id="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" value="{{ $funder->email }}" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="status">Status *</label>
        <select name="status" id="status" class="form-control" required>
            <option {{ $funder->status == 'Publish' ? 'selected' : '' }} value="Publish">
                Publish</option>
            <option {{ $funder->status == 'Draft' ? 'selected' : '' }} value="Draft">Draft
            </option>
        </select>
    </div>
    <button type="button" class="btn btn-primary" id="save-general">Save </button>
</div>
