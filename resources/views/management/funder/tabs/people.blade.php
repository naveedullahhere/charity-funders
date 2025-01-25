<form id="peopleForm" action="{{ route('funder.store.people') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label class="col-md-3 label-control" for="trustee_name">Trustee Name</label>
        <div class="col-md-9">
            <input type="text" id="trustee_name" class="form-control" name="trustee_name" placeholder="Trustee Name" autocomplete="off" />
        </div>
    </div>
    <!-- Add other fields for People Tab -->
    <div class="form-group row last mb-3">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-secondary" id="addPeopleRow">Add New</button>
            <button type="submit" class="btn btn-primary">Save & Next</button>
        </div>
    </div>
</form>