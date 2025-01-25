<div class="tab-pane fade" id="financials" role="tabpanel">
    <div id="financials-container">
        @foreach ($funder->financialDetails as $index => $financial)
            <div class="financial-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="financials[{{ $index }}][year]">Year</label>
                    <input type="text" onkeypress="return DegitOnly(event);"
                        name="financials[{{ $index }}][year]" class="form-control" value="{{ $financial->year }}"
                        required>
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
    </div>
    <button type="button" class="btn btn-primary" id="add-financial">Add New Financial</button>
    <button type="button" class="btn btn-primary" id="save-financials">Save Financials</button>
</div>
