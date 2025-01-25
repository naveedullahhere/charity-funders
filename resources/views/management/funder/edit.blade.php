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
                            @include('management.funder.tabs.general')
                            @include('management.funder.tabs.company')
                            @include('management.funder.tabs.financials')
                            @include('management.funder.tabs.donation')
                            @include('management.funder.tabs.people')
                            @include('management.funder.tabs.works')
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

            $('#save-general').click(function() {
                if (!funderId) {
                    Swal.fire('Error!', 'Please save general information first.', 'error');
                    return;
                }
                handleAjaxRequest(
                    '{{ route('funders.store.general', ':id') }}'.replace(':id', funderId),
                    'POST',
                    $('#formSteps').serialize(),
                    'General information saved successfully',
                    '#company-tab'
                );
            });

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
