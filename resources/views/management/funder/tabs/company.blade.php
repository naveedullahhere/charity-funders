<form id="companyForm" action="{{ route('funder.store.company') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label class="col-md-3 label-control" for="company_name">Company Name</label>
        <div class="col-md-9">
            <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company Name" autocomplete="off" />
        </div>
    </div>
    <!-- Add other fields for Company Info Tab -->
    <div class="form-group row last mb-3">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Save & Next</button>
        </div>
    </div>
</form>