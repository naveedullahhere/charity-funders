@include('management.theme.includes.error_success')
<form class="example" novalidate id="subm" method="post" action="{{ route('event.update', $event->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" id="listRefresh" value="{{ route('get.event') }}" />
    <div class="row form-mar">
        <!-- Event Name -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Event Name <span class="text-danger"> *</span></label>
                <input type="text" name="name" class="form-control" value="{{ $event->name }}" placeholder="Event Name" required>
            </div>
        </div>

        <!-- Role Dropdown -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Role <span class="text-danger"> *</span></label>
                <select class="form-control" name="event_role_id" required>
                    <option value="" disabled>Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $event->event_role_id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Event Date -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Event Date <span class="text-danger"> *</span></label>
                <input type="date" name="event_date" class="form-control" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}" required>
            </div>
        </div>

        <!-- Location Dropdown -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Location <span class="text-danger"> *</span></label>
                <select class="form-control" name="event_location_id" required>
                    <option value="" disabled>Select Location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == $event->event_location_id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Whole Event Price -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Whole Event Price <span class="text-danger"> *</span></label>
                <input type="number" name="whole_event_price" class="form-control" placeholder="Whole Event Price" step="0.01" min="0" value="{{ $event->whole_event_price }}" required>
            </div>
        </div>

        <!-- Price Per Image -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Image <span class="text-danger"> *</span></label>
                <input type="number" name="price_per_image" class="form-control" placeholder="Price Per Image" step="0.01" min="0" value="{{ $event->price_per_image }}" required>
            </div>
        </div>

        <!-- Price Per Video -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Video <span class="text-danger"> *</span></label>
                <input type="number" name="price_per_video" class="form-control" placeholder="Price Per Video" step="0.01" min="0" value="{{ $event->price_per_video }}" required>
            </div>
        </div>


        <hr>
        <div class="col-md-12">
            <h6>
                High Quality Prices
            </h6>
        </div>
        <!-- Whole Event Price -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Whole Event Price <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Whole Event Price" name="whole_high_event_price" value="{{ $event->whole_high_event_price }}" class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Image -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Image <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Image" name="price_per_high_image" value="{{ $event->price_per_high_image }}"  class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Video -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Video <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Video" name="price_per_high_video" value="{{ $event->price_per_high_video }}"  class="form-control" step="0.01" min="0" required>
            </div>
        </div>


        <!-- Image Upload -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label class="d-block">Event Thumbnail</label>
                @if($event->thumbnail)
                    <img width="150px" src="{{ url($event->thumbnail) }}" alt="Event Thumbnail">
                @endif
                <input type="file" name="thumbnail" class="form-control" accept="image/*">
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="row text-center center">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Event</button>
            <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
        </div>
    </div>
</form>
