<div class="tab-pane fade" id="people" role="tabpanel">
    <div id="trustees-container">
        @foreach ($funder->trusteeBoards as $index => $trustee)
            <div class="trustee-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="trustee_boards[{{ $index }}][trustee]">Trustee Name</label>
                    <input type="text" name="trustee_boards[{{ $index }}][trustee]" class="form-control"
                        value="{{ $trustee->trustee }}" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="trustee_boards[{{ $index }}][position]">Position</label>
                    <input type="text" name="trustee_boards[{{ $index }}][position]" class="form-control"
                        value="{{ $trustee->position }}" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="trustee_boards[{{ $index }}][status]">Status</label>
                    <select name="trustee_boards[{{ $index }}][status]" class="form-control" required>
                        <option value="up-to-date" {{ $trustee->status === 'up-to-date' ? 'selected' : '' }}>Up-to-date
                        </option>
                        <option value="recently" {{ $trustee->status === 'recently' ? 'selected' : '' }}>Recently
                        </option>
                        <option value="registered" {{ $trustee->status === 'registered' ? 'selected' : '' }}>Registered
                        </option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-trustee">Remove</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary" id="add-trustee">Add New Trustee</button>
    <button type="button" class="btn btn-primary" id="save-people">Save People Info</button>
</div>
