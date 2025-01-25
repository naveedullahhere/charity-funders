<div class="tab-pane fade" id="financials" role="tabpanel">
    <div id="financials-container">
        @if ($funder->financialDetails->isEmpty())
            <div class="financial-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="financials[0][year]">Year</label>
                    <input type="text" onkeypress="return DegitOnly(event);" name="financials[0][year]"
                        class="form-control" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="financials[0][income]">Income (million)</label>
                    <input type="text" step="0.01" onkeypress="return DegitOnly(event);"
                        name="financials[0][income]" class="form-control" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="financials[0][spend]">Spend (million)</label>
                    <input type="text" step="0.01" onkeypress="return DegitOnly(event);"
                        name="financials[0][spend]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger remove-financial">Remove</button>
            </div>
        @else
            @foreach ($funder->financialDetails as $index => $financial)
                <div class="financial-row row w-100 mx-auto mb-3">
                    <div class="input-group col-md-3">
                        <label for="financials[{{ $index }}][year]">Year</label>
                        <input type="text" onkeypress="return DegitOnly(event);"
                            name="financials[{{ $index }}][year]" class="form-control"
                            value="{{ $financial->year }}" required>
                    </div>
                    <div class="input-group col-md-3">
                        <label for="financials[{{ $index }}][income]">Income (million)</label>
                        <input type="text" step="0.01" onkeypress="return DegitOnly(event);"
                            name="financials[{{ $index }}][income]" class="form-control"
                            value="{{ $financial->income }}" required>
                    </div>
                    <div class="input-group col-md-3">
                        <label for="financials[{{ $index }}][spend]">Spend (million)</label>
                        <input type="text" step="0.01" onkeypress="return DegitOnly(event);"
                            name="financials[{{ $index }}][spend]" class="form-control"
                            value="{{ $financial->spend }}" required>
                    </div>
                    <button type="button" class="btn btn-danger remove-financial">Remove</button>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-10 px-0 d-flex justify-content-end">
            <button type="button" class="btn btn-success" id="add-financial">+ Add New</button>
        </div>
        <div class="col-12 mt-3">
            <button type="button" class="btn btn-primary" id="save-financials">Save</button>
        </div>
    </div>
</div>
