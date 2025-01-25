<form id="donationForm" action="{{ route('funder.store.donation') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label class="col-md-3 label-control" for="year">Year</label>
        <div class="col-md-9">
            <input type="text" id="year" class="form-control" name="year" placeholder="Year" autocomplete="off" />
        </div>
    </div>
    <!-- Add other fields for Donation Applications Tab -->
    <div class="form-group row last mb-3">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-secondary" id="addDonationRow">Add New</button>
            <button type="submit" class="btn btn-primary">Save & Next</button>
        </div>
    </div>
</form>