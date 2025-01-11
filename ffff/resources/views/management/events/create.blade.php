@include('management.theme.includes.error_success')
<form class="example" novalidate id="subm" method="post" action="{{ route('event.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="listRefresh" value="{{ route('get.event') }}" />
    <div class="row form-mar">
        <!-- Event Name -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Event Name <span class="text-danger"> *</span></label>
                <input type="text" name="name" class="form-control" placeholder="Event Name" required>
            </div>
        </div>
        <!-- Location Dropdown -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Location <span class="text-danger"> *</span></label>
                <select class="form-control" name="event_location_id" required>
                    <option value="" selected disabled>Select Location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Role Dropdown -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Role <span class="text-danger"> *</span></label>
                <select class="form-control" name="event_role_id" required>
                    <option value="" selected disabled>Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <!-- Event Date -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Event Date <span class="text-danger"> *</span></label>
                <input type="date" name="event_date" class="form-control" required>
            </div>
        </div>



        <div class="col-md-12">
            <h6>
                Standard Quality Prices
            </h6>
        </div>
        <!-- Whole Event Price -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Whole Event Price <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Whole Event Price" name="whole_event_price" class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Image -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Image <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Image" name="price_per_image" class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Video -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Video <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Video" name="price_per_video" class="form-control" step="0.01" min="0" required>
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
                <input type="number" placeholder="Whole Event Price" name="whole_high_event_price" class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Image -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Image <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Image" name="price_per_high_image" class="form-control" step="0.01" min="0" required>
            </div>
        </div>

        <!-- Price Per Video -->
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Price Per Video <span class="text-danger"> *</span></label>
                <input type="number" placeholder="Price Per Video" name="price_per_high_video" class="form-control" step="0.01" min="0" required>
            </div>
        </div>





        <!-- Image Upload -->
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Event Thumbnail</label>
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
