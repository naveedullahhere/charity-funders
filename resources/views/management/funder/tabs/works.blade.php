<form id="worksForm" action="{{ route('funder.store.works') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label class="col-md-3 label-control" for="work_area">Work Area</label>
        <div class="col-md-9">
            @foreach ($workAreas as $workArea)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="work_area[]" value="{{ $workArea->id }}" id="work_area_{{ $workArea->id }}">
                    <label class="form-check-label" for="work_area_{{ $workArea->id }}">
                        {{ $workArea->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group row last mb-3">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Save & Finish</button>
        </div>
    </div>
</form>