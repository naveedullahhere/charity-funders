@extends('management.layouts.master')
@section('title')
    Funder - Edit
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
        document.addEventListener('DOMContentLoaded', function() {
            const funderId = {{ $funder->id }};
            const form = document.getElementById('formSteps');

            function getQueryParam(param) {
                return new URLSearchParams(window.location.search).get(param);
            }

            function setQueryParam(param, value) {
                const url = new URL(window.location.href);
                url.searchParams.set(param, value);
                window.history.replaceState({}, '', url);
            }

            let activeTab = getQueryParam('tab') || '#general';
            $(`#myTab a[href="${activeTab}"]`).tab('show');

            function displayErrors(errors) {
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                Object.keys(errors).forEach(field => {
                    const inputField = document.querySelector(`[name="${field}"]`);
                    if (inputField) {
                        inputField.insertAdjacentHTML('afterend',
                            `<div class="error-message text-danger">${errors[field][0]}</div>`);
                    }
                });
            }

            function handleAjaxRequest(url, method, data, successMessage, nextTab) {
                console.log("asdasdasd");

                fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: new URLSearchParams(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            if (response.status === 422) {
                                return response.json().then(errorData => {
                                    console.error('Validation error:', errorData);
                                    displayErrors(errorData.errors ||
                                        errorData);
                                });
                            } else {
                                throw new Error(`Request failed with status ${response.status}`);
                            }
                        }

                        return response.json();
                    })
                    .then(response => {
                        if (response) {
                            Swal.fire('Success!', successMessage, 'success');
                        }
                        // if (nextTab) document.querySelector(nextTab).click();
                    })
                    .catch(error => {
                        if (error.status === 422) {
                            displayErrors(error.responseJSON.errors);
                        } else {
                            Swal.fire('Error!', 'An unexpected error occurred. Please try again.', 'error');
                        }
                    });
            }

            document.querySelectorAll('#myTab a').forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    setQueryParam('tab', this.getAttribute('href'));
                    this.click();
                });
            });

            document.querySelector('#save-general').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.general', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'General information saved successfully',
                    '#company-tab'
                );
            });

            document.querySelector('#save-company').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.company', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'Company information saved successfully',
                    '#financials-tab'
                );
            });

            document.querySelector('#save-financials').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.financials', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'Financial information saved successfully',
                    '#donations-tab'
                );
            });

            document.querySelector('#save-donations').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.donations', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'Donation applications saved successfully',
                    '#people-tab'
                );
            });

            document.querySelector('#save-people').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.people', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'Trustee board information saved successfully',
                    '#areas-tab'
                );
            });

            document.querySelector('#save-areas').addEventListener('click', () => {
                if (!funderId) return Swal.fire('Error!', 'Please save general information first.',
                    'error');
                handleAjaxRequest(
                    '{{ route('funders.store.areas', ':id') }}'.replace(':id', funderId),
                    'POST',
                    new FormData(form),
                    'Work areas saved successfully'
                );
            });

            document.querySelector('#add-financial').addEventListener('click', () => {
                const index = document.querySelectorAll('.financial-row').length;
                const newRow = `
            <div class="financial-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="financials[${index}][year]">Year</label>
                    <input type="text" onkeypress="return DegitOnly(event);" name="financials[${index}][year]" class="form-control" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="financials[${index}][income]">Income (million)</label>
                    <input type="text" step="0.01" onkeypress="return DegitOnly(event);" name="financials[${index}][income]" class="form-control" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="financials[${index}][spend]">Spend (million)</label>
                    <input type="text" step="0.01" onkeypress="return DegitOnly(event);" name="financials[${index}][spend]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger remove-financial">Remove</button>
            </div>
        `;
                document.querySelector('#financials-container').insertAdjacentHTML('beforeend', newRow);
            });

            document.querySelector('#add-donation').addEventListener('click', () => {
                const index = document.querySelectorAll('.donation-row').length;
                const newRow = `
            <div class="donation-row row w-100 mx-auto mb-3">
                <div class="col-11">
                    <div class="row">
                        <div class="input-group col-md-3">
                            <label for="donation_applications[${index}][year]">Year</label>
                            <input type="text" onkeypress="return DegitOnly(event);" name="donation_applications[${index}][year]" class="form-control" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[${index}][received]">Received</label>
                            <input type="number" onkeypress="return DegitOnly(event);" name="donation_applications[${index}][received]" class="form-control received" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[${index}][successful]">Successful</label>
                            <input type="number" onkeypress="return DegitOnly(event);" name="donation_applications[${index}][successful]" class="form-control successful" required>
                        </div>
                        <div class="input-group col-md-3">
                            <label for="donation_applications[${index}][rate]">Rate (%)</label>
                            <input type="number" name="donation_applications[${index}][rate]" class="form-control rate" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger remove-donation">Remove</button>
                </div>
            </div>
        `;
                document.querySelector('#donations-container').insertAdjacentHTML('beforeend', newRow);
            });

            document.querySelector('#add-trustee').addEventListener('click', () => {
                const index = document.querySelectorAll('.trustee-row').length;
                const newRow = `
            <div class="trustee-row row w-100 mx-auto mb-3">
                <div class="input-group col-md-3">
                    <label for="trustee_boards[${index}][trustee]">Trustee Name</label>
                    <input type="text" name="trustee_boards[${index}][trustee]" class="form-control" required>
                </div>
                <div class="input-group col-md-3">
                    <label for="trustee_boards[${index}][position]">Position</label>
                    <input type="text" name="trustee_boards[${index}][position]" class="form-control" required>
                </div>
                <div class="input-group col-md-3">
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

                document.querySelector('[name="trustee_board_man_power"]').value = index;
                document.querySelector('#trustees-container').insertAdjacentHTML('beforeend', newRow);
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-financial')) {
                    if (document.querySelectorAll('.financial-row').length > 1) {
                        e.target.closest('.financial-row').remove();
                    }
                }
                if (e.target.classList.contains('remove-donation')) {
                    if (document.querySelectorAll('.donation-row').length > 1) {
                        e.target.closest('.donation-row').remove();
                    }
                }
                if (e.target.classList.contains('remove-trustee')) {
                    if (document.querySelectorAll('.trustee-row').length > 1) {
                        e.target.closest('.trustee-row').remove();
                        document.querySelector('[name="trustee_board_man_power"]').value = document
                            .querySelectorAll('.trustee-row').length - 1;
                    }
                }
                // if (e.target.classList.contains('received') || e.target.classList.contains('successful')) {
                //     const row = e.target.closest('.donation-row');
                //     const received = parseFloat(row.querySelector('.received').value) || 0;
                //     const successful = parseFloat(row.querySelector('.successful').value) || 0;
                //     const rate = (successful / received * 100).toFixed(2);
                //     row.querySelector('.rate').value = isNaN(rate) ? 0 : rate;
                // }
            });

            const updateTrusteeLength = () => {
                document.querySelector('[name="trustee_board_man_power"]').value = document.querySelectorAll(
                    '.trustee-row').length;
            }

            $(document).on('input', '.received, .successful', function() {
                let row = $(this).closest('.donation-row');
                let received = parseFloat(row.find('.received').val()) || 0;
                let successful = parseFloat(row.find('.successful').val()) || 0;
                let rate = (successful / received * 100).toFixed(2);
                row.find('.rate').val(rate);
            });

        });
    </script>
@endsection
