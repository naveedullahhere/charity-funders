<div class="tab-pane fade" id="donations" role="tabpanel">
    <div id="donations-container">
        @if ($funder->donationApplications->isEmpty())
            <div class="donation-row row w-100 mx-auto mb-3">
                <div class="col-11">
                    <div class="row">
                        <div class="input-group col-md-3">
                            <label for="donation_applications[0][year]">Year</label>
                            <input type="text" onkeypress="return DegitOnly(event);"
                                name="donation_applications[0][year]" class="form-control" value="" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[0][received]">Received</label>
                            <input type="number" onkeypress="return DegitOnly(event);"
                                name="donation_applications[0][received]" class="form-control received" value=""
                                required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[0][successful]">Successful</label>
                            <input type="number" onkeypress="return DegitOnly(event);"
                                name="donation_applications[0][successful]" class="form-control successful"
                                value="" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[0][rate]">Rate (%)</label>
                            <input type="number" name="donation_applications[0][rate]" class="form-control rate"
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger remove-donation">Remove</button>
                </div>
            </div>
        @else
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
                                <input type="number" onkeypress="return DegitOnly(event);"
                                    name="donation_applications[{{ $index }}][received]]"
                                    class="form-control received" value="{{ $donation->received }}" required>
                            </div>
                            <div class="input-group col-md-3">
                                <label for="donation_applications[{{ $index }}][successful]">Successful</label>
                                <input type="number" onkeypress="return DegitOnly(event);"
                                    name="donation_applications[{{ $index }}][successful]]"
                                    class="form-control successful" value="{{ $donation->successful }}" required>
                            </div>
                            <div class="input-group col-md-3">
                                <label for="donation_applications[{{ $index }}][rate]">Rate (%)</label>
                                <input type="number" name="donation_applications[{{ $index }}][rate]]"
                                    class="form-control rate" value="{{ $donation->rate }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-danger remove-donation">Remove</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-12 px-0 d-flex justify-content-end">
            <button type="button" class="btn btn-success" id="add-donation">+ Add New</button>
        </div>
        <div class="col-12 mt-3">
            <button type="button" class="btn btn-primary" id="save-donations">Save</button>
        </div>
    </div>
</div>
