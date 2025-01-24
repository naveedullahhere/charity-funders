@extends('management.layouts.master')
@section('title')
Funder
@endsection
@section('content')
<div class="content-wrapper">
    <section id="extended">
        <div class="row w-100 mx-auto">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2 class="page-title"> Create Funder</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body table-responsive">
                            <form class="form-bordered" action="{{ route('funder.store') }}" method="POST"
                                id="ajaxSubmit" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="listRefresh" value="{{ route('get.funder') }}" />
                                <!-- Category and Sub Category -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="category_id">Category</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <!-- Populate with categories from the database -->
                                            </select>
                                            <div class="form-control-position">
                                                <i class="ft-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="sub_category_id">Sub Category</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Select Sub Category</option>
                                                <!-- Populate with sub-categories from the database -->
                                            </select>
                                            <div class="form-control-position">
                                                <i class="ft-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Name and Charity Number -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Name</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="name" class="form-control" name="name"
                                                placeholder="Name" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="charity_no">Charity Number</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="charity_no" class="form-control" name="charity_no"
                                                placeholder="Charity Number" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-hash"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Person Name and Website -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="p_name">Person Name</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="p_name" class="form-control" name="p_name"
                                                placeholder="Person Name" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="web">Website</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="url" id="web" class="form-control" name="web"
                                                placeholder="Website URL" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-globe"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone and Email -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="phone">Phone</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="phone" class="form-control" name="phone"
                                                placeholder="Phone" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="email" id="email" class="form-control" name="email"
                                                placeholder="Email" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Line 1 and Address Line 2 -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="address_line1">Address Line 1</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="address_line1" class="form-control"
                                                name="address_line1" placeholder="Address Line 1" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="address_line2">Address Line 2</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="address_line2" class="form-control"
                                                name="address_line2" placeholder="Address Line 2" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Region, City, and Postcode -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="region">Region</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="region" class="form-control" name="region"
                                                placeholder="Region" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-map"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="city">City</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="city" class="form-control" name="city"
                                                placeholder="City" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-map"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="postcode">Postcode</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="postcode" class="form-control" name="postcode"
                                                placeholder="Postcode" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-hash"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country and Location -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="country_id">Country</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Select Country</option>
                                                <!-- Populate with countries from the database -->
                                            </select>
                                            <div class="form-control-position">
                                                <i class="ft-flag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="location">Location</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="location" class="form-control" name="location"
                                                placeholder="Location" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Latitude and Longitude -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="lat">Latitude</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="lat" class="form-control" name="lat"
                                                placeholder="Latitude" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-navigation"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="lng">Longitude</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="lng" class="form-control" name="lng"
                                                placeholder="Longitude" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-navigation"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Company Description -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="company_description">Company
                                        Description</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <textarea id="company_description" rows="4" class="form-control"
                                                name="company_description" placeholder="Company Description"></textarea>
                                            <div class="form-control-position">
                                                <i class="ft-file-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Person Details -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="contact_person_name">Contact Person
                                        Name</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="contact_person_name" class="form-control"
                                                name="contact_person_name" placeholder="Contact Person Name"
                                                autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="contact_person_designation">Contact
                                        Person Designation</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="contact_person_designation" class="form-control"
                                                name="contact_person_designation"
                                                placeholder="Contact Person Designation" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-briefcase"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="contact_person_phone">Contact Person
                                        Phone</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="contact_person_phone" class="form-control"
                                                name="contact_person_phone" placeholder="Contact Person Phone"
                                                autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="contact_person_email">Contact Person
                                        Email</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="email" id="contact_person_email" class="form-control"
                                                name="contact_person_email" placeholder="Contact Person Email"
                                                autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Previous Grant Beneficiaries and Trustee Board Manpower -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="previous_grant_beneficiaries">Previous
                                        Grant Beneficiaries</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="number" id="previous_grant_beneficiaries" class="form-control"
                                                name="previous_grant_beneficiaries"
                                                placeholder="Previous Grant Beneficiaries" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="trustee_board_man_power">Trustee Board
                                        Manpower</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="trustee_board_man_power" class="form-control"
                                                name="trustee_board_man_power" placeholder="Trustee Board Manpower"
                                                autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Operation and Social Media Links -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="operation">Operation</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="operation" class="form-control" name="operation"
                                                placeholder="Operation" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-settings"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="facebook">Facebook</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="url" id="facebook" class="form-control" name="facebook"
                                                placeholder="Facebook URL" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-facebook"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="twitter">Twitter</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="url" id="twitter" class="form-control" name="twitter"
                                                placeholder="Twitter URL" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-twitter"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="google_plus">Google Plus</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="url" id="google_plus" class="form-control" name="google_plus"
                                                placeholder="Google Plus URL" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-google"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="charity_url">Charity URL</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="url" id="charity_url" class="form-control" name="charity_url"
                                                placeholder="Charity URL" autocomplete="off" />
                                            <div class="form-control-position">
                                                <i class="ft-link"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status and Logo -->
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="status">Status</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <select name="status" id="status" class="form-control">
                                                <option value="Publish">Publish</option>
                                                <option value="Draft">Draft</option>
                                            </select>
                                            <div class="form-control-position">
                                                <i class="ft-flag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="logo">Logo</label>
                                    <div class="col-md-9">
                                        <div class="position-relative has-icon-left">
                                            <input type="file" id="logo" class="form-control" name="logo" />
                                            <div class="form-control-position">
                                                <i class="ft-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit and Close Buttons -->
                                <div class="form-group row last mb-3">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary mr-2"><i
                                                class="ft-x mr-1"></i>Cancel</button>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="ft-check-square mr-1"></i>Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection
@section('script')

@endsection