@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{ route('bookings.update',$order->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" id="url" value="{{ route('bookings.index') }}" />
    <div class="row form-mar">

        <h5 class="col-12 d-block">Booking Detail</h5>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Arrival Date <span class="text-danger"> *</span></label>
                <input type="datetime-local" name="arrival_date" value="{{$basket->arrival_date}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Return Date <span class="text-danger"> *</span></label>
                <input type="datetime-local" name="return_date" value="{{$basket->return_date}}" class="form-control" placeholder="Discount code">
            </div>
        </div>



        <h5 class="col-12 d-block">Customer Detail</h5>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Lead Title <span class="text-danger"> *</span></label>
                <input type="text" name="lead_title" value="{{$order->lead_title}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>First Name <span class="text-danger"> *</span></label>
                <input type="text" name="lead_first_name" value="{{$order->lead_first_name}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Last Name <span class="text-danger"> *</span></label>
                <input type="text" name="lead_last_name" value="{{$order->lead_last_name}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Phone No.<span class="text-danger"> *</span></label>
                <input type="text" name="lead_phone" value="{{$order->lead_phone}}" class="form-control" placeholder="Discount code">
            </div>
        </div>



        <h5 class="col-12 d-block mb-3">Vehicle Details</h5>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Vehicle Registration <span class="text-danger"> *</span></label>
                <input type="text" name="vehicle_registration" value="{{$order->vehicle_registration}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Vehicle Model <span class="text-danger"> *</span></label>
                <input type="text" name="vehicle_model" value="{{$order->vehicle_model}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Vehicle Color <span class="text-danger"> *</span></label>
                <input type="text" name="vehicle_color" value="{{$order->vehicle_color}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>No of Passenger <span class="text-danger"> *</span></label>
                <input type="text" name="passenger" value="{{$order->passenger}}" class="form-control" placeholder="Discount code">
            </div>
        </div>


        <h5 class="col-12 d-block">Flight Details</h5>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Terminal Out <span class="text-danger"> *</span></label>
                <input type="text" name="terminal_out" value="{{$order->terminal_out}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Flight Out <span class="text-danger"> *</span></label>
                <input type="text" name="flight_out" value="{{$order->flight_out}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Terminal In <span class="text-danger"> *</span></label>
                <input type="text" name="terminal_in" value="{{$order->terminal_in}}" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label>Flight In <span class="text-danger"> *</span></label>
                <input type="text" name="flight_in" value="{{$order->flight_in}}" class="form-control" placeholder="Discount code">
            </div>
        </div>

{{--        <div class="col-12 col-sm-12">--}}
{{--            <div class="form-group">--}}
{{--                <label>Status</label>--}}
{{--                <select class="form-control" name="status">--}}
{{--                    <option selected value="1">Active</option>--}}
{{--                    <option value="0">Draft</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="row text-center center">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
        </div>
    </div>
</form>
