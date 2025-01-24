@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')

    <link rel="stylesheet" href="{{ asset('charity/subs.css') }}">
    <link rel="stylesheet" href="{{ asset('charity/subs_new.css') }}">

    <section class="Faqs-Banner">
        <div class="main-container">
            <div class="about-container">
                <div class="main-heading">
                    <h1>Subscriptions</h1>
                </div>
                <div class="text-line">
                    <p>Increasing access to funding with a flexible subscription model</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 md-12 sm-12">
                <div class="progress">
                    <div class="progress-bar" style="width: 33.33%; ">Step 1 - Select your Price plan</div>
                    <div class="progress-bar text-light" style="width: 33.33%">Step 2 - Organisation details</div>
                    <div class="progress-bar text-light" style="width: 33.34%">Step 3 - Payment</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="row justify-content-center" id="step1">
            <div class="col-lg-8 md-10 sm-10">
                <div class="charityHead">
                    Charities, CICs, Social Enterprises and Community Groups
                </div>
            </div>
            <div class="col-lg-10 md-12 sm-12">
                <table class="table table-bordered pricing-table">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">Your organisation income*</th>
                            <th scope="col" rowspan="2">User licenses</th>
                            <th scope="col" colspan="2">Subscription length</th>
                        </tr>
                        <tr>
                            <th scope="col">1 Year</th>
                            <th scope="col">2 Years</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>£0 - £100k</td>
                            <td>2</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="50"> £50
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="80"> £80
                            </td>
                        </tr>
                        <tr>
                            <td>£101k - £250k</td>
                            <td>2</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="150"> £150
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="240"> £240
                            </td>
                        </tr>
                        <tr>
                            <td>£251 - £500k</td>
                            <td>3</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="250"> £250
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="400"> £400
                            </td>
                        </tr>
                        <tr>
                            <td>£501k +</td>
                            <td>3</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="350"> £350
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="org"
                                    value="560"> £560
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8 md-10 sm-10">
                <div class="text-center">
                    <p style="font-size: 30px; margin: 15px 15px;">* income levels will be verified by our Customer Services
                        team</p>
                    <button class="btnNext" onclick="goToStep(2, true)">Next <i class="fas fa-arrow-up"></i></button>
                </div>
            </div>

            <div class="col-lg-8 md-10 sm-10">
                <div class="charityHead">
                    Individuals, private and public sector organisations
                </div>
            </div>

            <div class="col-lg-6 md-8 sm-8">
                <table class="table table-bordered pricing-table">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">User licenses</th>
                            <th scope="col" colspan="2">Subscription length</th>
                        </tr>
                        <tr>
                            <th scope="col">1 Year</th>
                            <th scope="col">2 Years</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="50"> £50
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="80"> £80
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="150"> £150
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="240"> £240
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="250"> £250
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="400">
                                £400
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="350">
                                £350
                            </td>
                            <td class="selectable"><input type="radio" name="org_ins_subscription" data-type="ind"
                                    value="560">
                                £560
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8 md-10 sm-10 mt-5">
                <div class="text-center">
                    <button class="btnNext" onclick="goToStep(2, true)">Next <i class="fas fa-arrow-up"></i></button>
                    <p style="font-size: 30px; margin: 15px 15px;">If you are a public sector organisation and would like
                        to
                        discuss multiple licenses for the voluntary and community sector, please contact us at <a
                            href="mailto: info@thedatashed.co.uk">info@thedatashed.co.uk</a></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center d-none" id="step2">
            <div class="col-lg-10 md-12 sm-12 icon-box mt-5 mb-5 p-5">
                <form id="subscriptionForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control customField" name="firstName"
                                placeholder="First Name">
                            <span class="error-message" id="firstNameError"></span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control customField" name="lastName"
                                placeholder="Last Name">
                            <span class="error-message" id="lastNameError"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input type="text" class="form-control customField" name="jobTitle"
                                placeholder="Job Title">
                            <span class="error-message" id="jobTitleError"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control customField" name="organisationName"
                                placeholder="Organisation name">
                            <span class="error-message" id="organisationNameError"></span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control customField" name="charityNo"
                                placeholder="Charity no. (if applicable)">
                            <span class="error-message" id="charityNoError"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control customField" name="address" placeholder="Address">
                            <span class="error-message" id="addressError"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control customField" name="townOrcity"
                                placeholder="Town or City">
                            <span class="error-message" id="townOrcityError"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control customField" name="postCode"
                                placeholder="Postcode">
                            <span class="error-message" id="postCodeError"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="email" class="form-control customField" name="emailAddress"
                                placeholder="Email address">
                            <span class="error-message" id="emailAddressError"></span>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control customField" name="confirmEmail"
                                placeholder="Confirm email address">
                            <span class="error-message" id="confirmEmailError"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control customField" name="telephoneNumber"
                                placeholder="Telephone number">
                            <span class="error-message" id="telephoneNumberError"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="password" class="form-control customField" name="password"
                                placeholder="Password">
                            <span class="error-message" id="passwordError"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="password" class="form-control customField" name="confirmPassword"
                                placeholder="Confirm password">
                            <span class="error-message" id="confirmPasswordError"></span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="newsletter" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tick the checkbox if you would like to receive news and updates from.
                                </label>
                                <span class="error-message" id="newsletterError"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    I accept the privacy policy and terms and conditions of my subscription.
                                </label>
                                <span class="error-message" id="termsError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btnPrevious" onclick="goToStep(1)">Previous <i
                                    class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btnNext" onclick="goToStep(3)">Next <i
                                    class="fas fa-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-12 ">
                            <p style="text-align: left;">If you already have an account, please Click here to login</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center d-none" id="step3">
            <div class="col-lg-10 md-12 sm-12 icon-box mt-5 mb-5 p-4">
                <div class="row justify-content-center">
                    <div class="col-md-5 paymentBox m-2">
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="card" class="payment-checkbox">
                            <div class="payment-content">
                                <h4>Pay via Credit / Debit Card</h4>
                                <p style="text-align: left">Lorem ipsum dolor sit amet and consectetur adipiscing elit
                                    nulla
                                    aliquet justo</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-5 paymentBox m-2">
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="invoice" class="payment-checkbox">
                            <div class="payment-content">
                                <h4>Pay via Invoice</h4>
                                <p style="text-align: left">Lorem ipsum dolor sit amet and consectetur adipiscing elit
                                    nulla
                                    aliquet justo</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10 text-center">
                        <button type="button" class="btnNext" onclick="submitForm()">Submit <i
                                class="fas fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const cells = document.querySelectorAll('td.selectable');

        cells.forEach(cell => {
            cell.addEventListener('click', () => {
                cells.forEach(c => c.classList.remove('selected'));
                cell.classList.add('selected');
                const radio = cell.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });

        function goToStep(step, isSubscription = false) {
            if (isSubscription) {
                const subscription = document.querySelector('input[name="org_ins_subscription"]:checked');
                const type = subscription?.getAttribute('data-type');

                if (!subscription || !type) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: "Please select a subscription plan.",
                    });
                    return;
                }
            }

            const steps = document.querySelectorAll('.row[id^="step"]');
            steps.forEach(s => s.classList.add('d-none'));

            const currentStep = document.getElementById(`step${step}`);
            if (currentStep) {
                currentStep.classList.remove('d-none');
                updateProgress(step);
            }
        }

        function updateProgress(step) {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach((bar, index) => {
                bar.classList.remove('active-bar');
                bar.style.width = '33.33%';
                if (index < step - 1) {
                    bar.classList.add('text-light');
                    bar.classList.add('active-bar');
                } else if (index === step - 1) {
                    bar.style.width = '33.33%';
                    bar.classList.add('active-bar');
                }
            });
        }

        function submitForm() {

            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (!paymentMethod) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "Please select a payment method.",
                });
                return;
            }

            const formData = new FormData(document.getElementById('subscriptionForm'));
            formData.append('paymentMethod', paymentMethod.value);

            formData.append('newsletter', document.querySelector('input[name="newsletter"]').checked ? 1 : 0);
            formData.append('terms', document.querySelector('input[name="terms"]').checked ? 1 : 0);

            const subscription = document.querySelector('input[name="org_ins_subscription"]:checked');
            const type = subscription.getAttribute('data-type');

            if (subscription && type) {
                formData.append('subscriptionType', type);
                formData.append('subscriptionAmount', subscription.value);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "Please select a subscription plan.",
                });
                return;
            }

            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));

            $.ajax({
                url: '{{ route('subscription.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        }).then(() => {
                            window.location.href = '/';
                            // window.location.href = '{{ route('home') }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    for (let error in errors) {
                        const errorField = document.getElementById(`${error}Error`);
                        const inputField = document.querySelector(`[name="${error}"]`);
                        if (errorField && inputField) {
                            errorField.textContent = errors[error][0];
                            inputField.classList.add('error');
                        }
                    }
                    goToStep(2);
                }
            });
        }

        goToStep(1);
    </script>

@endsection
