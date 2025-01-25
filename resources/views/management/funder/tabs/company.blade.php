<div class="tab-pane fade" id="company" role="tabpanel">
    <h3>Public Address</h3>
    <div class="form-group">
        <label for="address_line1">Address Line 1</label>
        <input type="text" name="address_line1" id="address_line1" value="{{ $funder->address_line1 }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="address_line2">Address Line 2</label>
        <input type="text" name="address_line2" id="address_line2" value="{{ $funder->address_line2 }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="region">County/Region</label>
        <input type="text" name="region" id="region" value="{{ $funder->region }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" id="city" value="{{ $funder->city }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" id="postcode" value="{{ $funder->postcode }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="website">Company Website</label>
        <input type="url" name="website" id="website" value="{{ $funder->web }}" class="form-control" placeholder="https://www.example.com/">
    </div>
    <div class="form-group">
        <label for="location">Google Map Location *</label>
        <input type="text" name="location" id="location" value="{{ $funder->location }}" class="form-control" required>
    </div>
    <h3>Contact Person Details</h3>
    <div class="form-group">
        <label for="contact_person_name">Full Name</label>
        <input type="text" name="contact_person_name" id="contact_person_name" value="{{ $funder->contact_person_name }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="contact_person_designation">Designation</label>
        <input type="text" name="contact_person_designation" id="contact_person_designation" value="{{ $funder->contact_person_designation }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="contact_person_phone">Phone Number</label>
        <input type="text" name="contact_person_phone" id="contact_person_phone" value="{{ $funder->contact_person_phone }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="contact_person_email">Email</label>
        <input type="email" name="contact_person_email" id="contact_person_email" value="{{ $funder->contact_person_email }}" class="form-control">
    </div>
    <h3>Company Social Info</h3>
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="url" name="facebook" id="facebook" value="{{ $funder->facebook }}" class="form-control" placeholder="https://www.facebook.com/example/">
    </div>
    <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="url" name="twitter" id="twitter" value="{{ $funder->twitter }}" class="form-control" placeholder="https://www.twitter.com/example/">
    </div>
    <div class="form-group">
        <label for="google_plus">Google Plus</label>
        <input type="url" name="google_plus" id="google_plus" value="{{ $funder->google_plus }}" class="form-control" placeholder="https://plus.google.com/example/">
    </div>
    <div class="form-group">
        <label for="company_description">Company Description</label>
        <textarea name="company_description" id="company_description" class="form-control" rows="5">{{ $funder->company_description }}</textarea>
    </div>
    <div class="form-group">
        <label for="application_procedure">Application Procedure</label>
        <textarea name="application_procedure" id="application_procedure" class="form-control" rows="5">{{ $funder->application_procedure }}</textarea>
    </div>
    <div class="form-group">
        <label for="charity_url">Charity URL (charitycommission.gov.uk)</label>
        <input type="url" name="charity_url" id="charity_url" value="{{ $funder->charity_url }}" class="form-control" placeholder="https://www.example.com/">
    </div>
    <button type="button" class="btn btn-primary" id="save-company">Save</button>
</div>