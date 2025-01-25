{{-- @extends('layouts.app')

@section('content') --}}
@extends('management.layouts.master')
@section('title')
    Funder
@endsection
@section('content')
    <div class="content-wrapper">
        <section id="extended">
            <div class="row w-100 mx-auto">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h2 class="page-title"> Edit Funder</h2>
                </div>
            </div>
            <div class="row w-100 mx-auto">
                <div class="col-md-8 ">
                    <form id="formSteps">
                        @csrf
                        <ul class="nav nav-tabs my-3" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general"
                                    role="tab">General
                                    Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="company-tab" data-toggle="tab" href="#company"
                                    role="tab">Company
                                    Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="financials-tab" data-toggle="tab" href="#financials"
                                    role="tab">Financials</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="donations-tab" data-toggle="tab" href="#donations"
                                    role="tab">Donation
                                    Applications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="people-tab" data-toggle="tab" href="#people"
                                    role="tab">People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="areas-tab" data-toggle="tab" href="#areas" role="tab">Area of
                                    Works</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <div class="form-group">
                                    <label for="category_id">Category Name *</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">--Select a Category--</option>
                                        @foreach ($categories as $category)
                                            <option {{$funder->category_id == $category->id ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Sub Category Name</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">--- Select Sub Category ---</option>
                                        @foreach ($categories as $category)
                                            <option {{$funder->sub_category_id == $category->id ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             
                                <div class="form-group">
                                    <label for="type_id">Group *</label>
                                    <select name="type_id" id="type_id" class="form-control" required>
                                        <option value="">--Select a Group--</option>
                                        @foreach ($types as $type)
                                            <option {{$funder->type_id == $type->id ? 'selected' : ''}} value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- @dd($funder) --}}
                                <div class="form-group">
                                    <label for="company_name">Company Name *</label>
                                    <input type="text" value="{{$funder->name}}" name="name" id="name" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="charity_no">Charity No *</label>
                                    <input type="text" name="charity_no" value="{{$funder->charity_no}}" id="charity_no" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="text" name="phone" value="{{$funder->phone}}"  id="phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" value="{{$funder->email}}"  id="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option {{$funder->status == 'Publish' ? 'selected' : ''}} value="Publish">Publish</option>
                                        <option {{$funder->status == 'Draft' ? 'selected' : ''}}  value="Draft">Draft</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-primary" id="save-general">Save General
                                    Info</button>
                            </div>
                            <div class="tab-pane fade" id="company" role="tabpanel">
                                <h3>Public Address</h3>
                                <div class="form-group">
                                    <label for="address_line1">Address Line 1</label>
                                    <input type="text" name="address_line1" id="address_line1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address_line2">Address Line 2</label>
                                    <input type="text" name="address_line2" id="address_line2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="region">County/Region</label>
                                    <input type="text" name="region" id="region" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" name="postcode" id="postcode" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="website">Company Website</label>
                                    <input type="url" name="website" id="website" class="form-control"
                                        placeholder="https://www.example.com/">
                                </div>
                                <div class="form-group">
                                    <label for="location">Google Map Location *</label>
                                    <input type="text" name="location" id="location" class="form-control" required>
                                </div>
                                <h3>Contact Person Details</h3>
                                <div class="form-group">
                                    <label for="contact_person_name">Full Name</label>
                                    <input type="text" name="contact_person_name" id="contact_person_name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contact_person_designation">Designation</label>
                                    <input type="text" name="contact_person_designation"
                                        id="contact_person_designation" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contact_person_phone">Phone Number</label>
                                    <input type="text" name="contact_person_phone" id="contact_person_phone"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contact_person_email">Email</label>
                                    <input type="email" name="contact_person_email" id="contact_person_email"
                                        class="form-control">
                                </div>
                                <h3>Company Social Info</h3>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="url" name="facebook" id="facebook" class="form-control"
                                        placeholder="https://www.facebook.com/example/">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="url" name="twitter" id="twitter" class="form-control"
                                        placeholder="https://www.twitter.com/example/">
                                </div>
                                <div class="form-group">
                                    <label for="google_plus">Google Plus</label>
                                    <input type="url" name="google_plus" id="google_plus" class="form-control"
                                        placeholder="https://plus.google.com/example/">
                                </div>
                                <div class="form-group">
                                    <label for="company_description">Company Description</label>
                                    <textarea name="company_description" id="company_description" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="application_procedure">Application Procedure</label>
                                    <textarea name="application_procedure" id="application_procedure" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="charity_url">Charity URL (charitycommission.gov.uk)</label>
                                    <input type="url" name="charity_url" id="charity_url" class="form-control"
                                        placeholder="https://www.example.com/">
                                </div>
                                <button type="button" class="btn btn-primary" id="save-company">Save Company
                                    Info</button>
                            </div>
                            <div class="tab-pane fade" id="financials" role="tabpanel">
                                <div id="financials-container">
                                    <div class="financial-row  row w-100 mx-auto mb-3">
                                        <div class="input-group col-md-3">
                                            <label for="financials[0][year]">Year</label>
                                            <input type="text" onkeypress="return DegitOnly(event);"  name="financials[0][year]" class="form-control"
                                                required>
                                        </div>
                                        <div class="input-group col-md-3">
                                            <label for="financials[0][income]">Income (million)</label>
                                            <input type="text" step="0.01" onkeypress="return DegitOnly(event);"  name="financials[0][income]"
                                                class="form-control" required>
                                        </div>
                                        <div class="input-group col-md-3">
                                            <label for="financials[0][spend]">Spend (million)</label>
                                            <input type="text" step="0.01" onkeypress="return DegitOnly(event);"  name="financials[0][spend]"
                                                class="form-control" required>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-financial ">Remove</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="add-financial">Add New
                                    Financial</button>
                                <button type="button" class="btn btn-primary" id="save-financials">Save
                                    Financials</button>
                            </div>
                            <div class="tab-pane fade" id="donations" role="tabpanel">
                                <div id="donations-container">
                                    <div class="donation-row row w-100 mx-auto mb-3">
                                    <div class="col-11">
                                        <div class="row">
                                        <div class="input-group col-md-3">
                                            <label for="donation_applications[0][year]">Year</label>
                                            <input type="text" onkeypress="return DegitOnly(event);" name="donation_applications[0][year]"
                                                class="form-control" required>
                                        </div>
                                        <div class="input-group col-md-3">
                                            <label for="donation_applications[0][received]">Received</label>
                                            <input type="text" onkeypress="return DegitOnly(event);" name="donation_applications[0][received]"
                                                class="form-control received" required>
                                        </div>
                                        <div class="input-group col-md-3">
                                            <label for="donation_applications[0][successful]">Successful</label>
                                            <input type="text" onkeypress="return DegitOnly(event);" name="donation_applications[0][successful]"
                                                class="form-control successful" required>
                                        </div>
                                        <div class="input-group col-md-3">
                                            <label for="donation_applications[0][rate]">Rate (%)</label>
                                            <input type="number" name="donation_applications[0][rate]"
                                                class="form-control rate" readonly>
                                        </div>
                                        </div>
                                    </div>
                                        <div class="col-1">
                                        <button type="button" class="btn btn-danger remove-donation">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="add-donation">Add New Donation
                                    Application</button>
                                <button type="button" class="btn btn-primary" id="save-donations">Save Donation
                                    Applications</button>
                            </div>
                            <div class="tab-pane fade" id="people" role="tabpanel">
                                <div id="trustees-container">
                                    <div class="trustee-row">
                                        <div class="form-group">
                                            <label for="trustee_boards[0][name]">Trustee Name</label>
                                            <input type="text" name="trustee_boards[0][name]" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="trustee_boards[0][position]">Position</label>
                                            <input type="text" name="trustee_boards[0][position]" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="trustee_boards[0][status]">Status</label>
                                            <select name="trustee_boards[0][status]" class="form-control" required>
                                                <option value="up-to-date">Up-to-date</option>
                                                <option value="recently">Recently</option>
                                                <option value="registered">Registered</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-trustee">Remove</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="add-trustee">Add New Trustee</button>
                                <button type="button" class="btn btn-primary" id="save-people">Save People Info</button>
                            </div>
                            <div class="tab-pane fade" id="areas" role="tabpanel">
                                <h3 class="mb-3">Select your work area/ who are the beneficiary ?</h3>
                                <div class="form-group">
                                    @foreach ($workAreas as $area)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="work_areas[]"
                                                value="{{ $area->id }}" id="area{{ $area->id }}">
                                            <label class="form-check-label" for="area{{ $area->id }}">
                                                {{ $area->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" id="save-areas">Save Area of
                                    Works</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let funderId = {{ $funder->id }};

            // Function to display errors under each field
            function displayErrors(errors) {
                // Clear previous errors
                $('.error-message').remove();

                // Loop through errors and display them
                for (let field in errors) {
                    let inputField = $(`[name="${field}"]`);
                    if (inputField.length) {
                        inputField.after(`<div class="error-message text-danger">${errors[field][0]}</div>`);
                    }
                }
            }

            // Function to handle AJAX requests
            function handleAjaxRequest(url, method, data, successMessage, nextTab) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        Swal.fire('Success!', successMessage, 'success');
                        if (nextTab) {
                            $(nextTab).tab('show');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            displayErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire('Error!', 'An unexpected error occurred. Please try again.',
                                'error');
                        }
                    }
                });
            }

            // General Info submission
            $('#save-general').click(function() {
                handleAjaxRequest(
                    '{{ route('funders.store.general') }}',
                    'POST',
                    $('#formSteps').serialize(),
                    'General information saved successfully',
                    '#company-tab'
                );
            });

            // Company Info submission
            $('#save-company').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.company', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'Company information saved successfully',
                    '#financials-tab'
                );
            });

            // Financials submission
            $('#save-financials').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.financials', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'Financial information saved successfully',
                    '#donations-tab'
                );
            });

            // Donation Applications submission
            $('#save-donations').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.donations', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'Donation applications saved successfully',
                    '#people-tab'
                );
            });

            // People submission
            $('#save-people').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.people', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'Trustee board information saved successfully',
                    '#areas-tab'
                );
            });

            // Area of Works submission
            $('#save-areas').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.areas', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'Work areas saved successfully'
                );
            });

            // Delete button
            $('#delete-btn').click(function() {
                if (funderId && confirm('Are you sure you want to delete this funder?')) {
                    $.ajax({
                        url: '{{ route('funders.destroy', ':id') }}'.replace(':id', funderId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Success!', response.message, 'success');
                            // Redirect to funders list or update UI as needed
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', xhr.responseJSON.message ||
                                'An error occurred while deleting the funder.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Error!',
                        'Please save general information first before attempting to delete.', 'error');
                }
            });

            // Preview button
            $('#preview-btn').click(function() {
                Swal.fire('Info', 'Preview functionality to be implemented.', 'info');
            });

            // Add new financial row
            $('#add-financial').click(function() {
                let index = $('.financial-row').length;
                let newRow = `
                <div class="financial-row">
                    <div class="form-group">
                        <label for="financials[${index}][year]">Year</label>
                        <input type="number" name="financials[${index}][year]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="financials[${index}][income]">Income (million)</label>
                        <input type="number" step="0.01" name="financials[${index}][income]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="financials[${index}][spend]">Spend (million)</label>
                        <input type="number" step="0.01" name="financials[${index}][spend]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger remove-financial">Remove</button>
                </div>
            `;
                $('#financials-container').append(newRow);
            });

            // Remove financial row
            $(document).on('click', '.remove-financial', function() {
                $(this).closest('.financial-row').remove();
            });

            // Add new donation application row
            $('#add-donation').click(function() {
                let index = $('.donation-row').length;
                let newRow = `
                <div class="donation-row">
                    <div class="form-group">
                        <label for="donation_applications[${index}][year]">Year</label>
                        <input type="number" name="donation_applications[${index}][year]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="donation_applications[${index}][received]">Received</label>
                        <input type="number" name="donation_applications[${index}][received]" class="form-control received" required>
                    </div>
                    <div class="form-group">
                        <label for="donation_applications[${index}][successful]">Successful</label>
                        <input type="number" name="donation_applications[${index}][successful]" class="form-control successful" required>
                    </div>
                    <div class="form-group">
                        <label for="donation_applications[${index}][rate]">Rate (%)</label>
                        <input type="number" name="donation_applications[${index}][rate]" class="form-control rate" readonly>
                    </div>
                    <button type="button" class="btn btn-danger remove-donation">Remove</button>
                </div>
            `;
                $('#donations-container').append(newRow);
            });

            // Remove donation application row
            $(document).on('click', '.remove-donation', function() {
                $(this).closest('.donation-row').remove();
            });

            // Calculate rate
            $(document).on('input', '.received, .successful', function() {
                let row = $(this).closest('.donation-row');
                let received = parseFloat(row.find('.received').val()) || 0;
                let successful = parseFloat(row.find('.successful').val()) || 0;
                let rate = (successful / received * 100).toFixed(2);
                row.find('.rate').val(rate);
            });

            // Add new trustee row
            $('#add-trustee').click(function() {
                let index = $('.trustee-row').length;
                let newRow = `
                <div class="trustee-row">
                    <div class="form-group">
                        <label for="trustee_boards[${index}][name]">Trustee Name</label>
                        <input type="text" name="trustee_boards[${index}][name]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="trustee_boards[${index}][position]">Position</label>
                        <input type="text" name="trustee_boards[${index}][position]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="trustee_boards[${index}][status]">Status</label>
                        <select name="trustee_boards[${index}][status]" class="form-control" required>
                            <option value="up-to-date">Up-to-date</option>
                            <option value="recently">Recently</option>
                            <option value="registered">Registered</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger remove-trustee">Remove</button>
                </div>
            `;
                $('#trustees-container').append(newRow);
            });

            // Remove trustee row
            $(document).on('click', '.remove-trustee', function() {
                $(this).closest('.trustee-row').remove();
            });
        });
    </script>
@endsection
