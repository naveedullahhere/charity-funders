<div class="tab-pane fade" id="areas" role="tabpanel">
    <h3 class="mb-3">Select your work area / who are the beneficiary ?</h3>
    <div class="form-group">
        @foreach ($workAreas as $area)
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="work_areas[]" value="{{ $area->id }}"
                    id="area{{ $area->id }}"
                    {{ in_array($area->id, $funder->areasOfWork->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="form-check-label" for="area{{ $area->id }}">
                    {{ $area->name }}
                </label>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary" id="save-areas">Save</button>
</div>
