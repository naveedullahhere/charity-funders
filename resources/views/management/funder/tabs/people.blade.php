<div class="tab-pane fade" id="people" role="tabpanel">
    <div id="trustees-container">
        <div class="trustee-row row w-100 mx-auto mb-3">
            <div class="input-group col-md-4">
                <label for="trustee_board_man_power">Trustee Man Power</label>
                <input type="text" name="trustee_board_man_power" value="{{ $funder->trusteeBoards->count() ?? 1 }}"
                    class="form-control" value="" required>
            </div>
        </div>
        @if ($funder->trusteeBoards->isEmpty())
            <div class="trustee-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="trustee_boards[0][trustee]">Trustee Name</label>
                    <input type="text" name="trustee_boards[0][trustee]" class="form-control" value=""
                        required>
                </div>
                <div class="input-group col-md-3">
                    <label for="trustee_boards[0][position]">Position</label>
                    <input type="text" name="trustee_boards[0][position]" class="form-control" value=""
                        required>
                </div>
                <div class="input-group col-md-3">
                    <label for="trustee_boards[0][status]">Status</label>
                    <select name="trustee_boards[0][status]" class="form-control" required>
                        <option value="up-to-date">Up-to-date</option>
                        <option value="recently">Recently</option>
                        <option value="registered">Registered</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-trustee">Remove</button>
            </div>
        @else
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
                            <option value="up-to-date" {{ $trustee->status === 'up-to-date' ? 'selected' : '' }}>
                                Up-to-date
                            </option>
                            <option value="recently" {{ $trustee->status === 'recently' ? 'selected' : '' }}>Recently
                            </option>
                            <option value="registered" {{ $trustee->status === 'registered' ? 'selected' : '' }}>
                                Registered
                            </option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger remove-trustee">Remove</button>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-10 px-0 d-flex justify-content-end">
            <button type="button" class="btn btn-success" id="add-trustee">+ Add New</button>
        </div>
        <div class="col-12 mt-3">
            <button type="button" class="btn btn-primary" id="save-people">Save</button>
        </div>
    </div>
</div>
