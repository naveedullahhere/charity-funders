<div class="tab-pane fade" id="donations" role="tabpanel">
    <div id="donations-container">
        @foreach ($funder->donationApplications as $index => $donation)
            <div class="donation-row row w-100 mx-auto mb-3">
                <div class="col-11">
                    <div class="row">
                        <div class="input-group col-md-3">
                            <label for="donation_applications[{{ $index }}][year]">Year</label>
                            <input type="text" onkeypress="return DegitOnly(event);"
                                name="donation_applications[{{ $index }}][year]" class="form-control"
                                value="{{ $donation->year }}" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[{{ $index }}][received]">Received</label>
                            <input type="text" onkeypress="return DegitOnly(event);"
                                name="donation_applications[{{ $index }}][received]"
                                class="form-control received" value="{{ $donation->received }}" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[{{ $index }}][successful]">Successful</label>
                            <input type="text" onkeypress="return DegitOnly(event);"
                                name="donation_applications[{{ $index }}][successful]"
                                class="form-control successful" value="{{ $donation->successful }}" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[{{ $index }}][rate]">Rate (%)</label>
                            <input type="number" name="donation_applications[{{ $index }}][rate]"
                                class="form-control rate" value="{{ $donation->rate }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger remove-donation">Remove</button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary" id="add-donation">Add New Donation Application</button>
    <button type="button" class="btn btn-primary" id="save-donations">Save Donation Applications</button>
</div>
