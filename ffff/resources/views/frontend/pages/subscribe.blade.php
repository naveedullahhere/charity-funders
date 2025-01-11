@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')

    <link rel="stylesheet" href="{{ asset('charity/subs.css') }}">




































   



    <style>
        /* Existing styles remain unchanged */

        /* ... existing CSS ... */

        .progress {
            height: 50px;
            background-color: #fff;
            display: flex;
            position: relative;
            overflow: hidden;
        }

        .progress-bar {
            font-size: 18px;
            line-height: 50px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            position: relative;
        }

        .active-bar {
            background-color: #ff6666 !important;
        }

        .progress-bar:first-child {
            background-color: #ff6666;
            border-radius: 5px 0 0 5px;
            clip-path: polygon(0 0, calc(100% - 15px) 0, 100% 50%, calc(100% - 15px) 100%, 0 100%);
        }

        .progress-bar:nth-child(2) {
            background-color: #FFB0A6;
            color: #000;
            clip-path: polygon(0 0,
                    /* Top-left corner */
                    15px 50%,
                    /* Inward arrow tip on the left */
                    0 100%,
                    /* Bottom-left corner */
                    calc(100% - 15px) 100%,
                    /* Right side of the bar, arrow starts */
                    100% 50%,
                    /* Arrow tip on the right */
                    calc(100% - 15px) 0
                    /* Top-right corner */
                );
        }

        .progress-bar:last-child {
            background-color: #FFB0A6;
            color: #000;
            clip-path: polygon(0 0,
                    /* Top-left corner */
                    15px 50%,
                    /* Inward arrow tip on the left */
                    0 100%,
                    /* Bottom-left corner */
                    100% 100%,
                    /* Flat right side bottom */
                    100% 0
                    /* Flat right side top */
                );
        }

        .progress-bar:last-child {
            border-radius: 0 5px 5px 0;
        }

        .charityHead {
            border-radius: 10px;
            border: 1px solid #000000;
            margin-top: 90px;
            margin-bottom: 90px;
            font-size: 40px;
            padding: 25px;
            text-align: center;
            background-color: #F3F3F3;
        }

        .pricing-table {
            background-color: #f8f9fa;
            border-radius: 10px;
            border-spacing: 5px;
        }

        .pricing-table th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
            text-align: center;
            font-size: 30px;
        }

        .pricing-table td {
            text-align: center;
            vertical-align: middle;
            font-size: 20px;
            padding: 25px 10px;
        }

        .pricing-table .highlighted {
            background-color: #129793;
            color: #fff;
        }

        .btnNext,
        .btnPrevious {
            background-color: #129793;
            color: #fff;
            padding: 10px 25px;
            margin-top: 20px;
            margin-bottom: 20px;
            border: none;
            cursor: pointer;
        }

        .btnNext i,
        .btnPrevious i {
            transform: rotate(50deg);
            margin-left: 5px;
        }

        .customField {
            border-radius: 0px;
            height: 50px;
        }

        .paymentBox {
            background-color: #fff;
            padding: 40px;
        }
    </style>

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
                    <div class="progress-bar" style="width: 33.33%; ">Step 1 - select your price plan</div>
                    <div class="progress-bar text-light" style="width: 33.33%">Step 2 - organisation details</div>
                    <div class="progress-bar text-light" style="width: 33.34%">Step 3 - payment</div>
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
                            <td>£50</td>
                            <td class="highlighted">£80</td>
                        </tr>
                        <tr>
                            <td>£101k - £250k</td>
                            <td>2</td>
                            <td>£150</td>
                            <td>£240</td>
                        </tr>
                        <tr>
                            <td>£251 - £500k</td>
                            <td>3</td>
                            <td>£250</td>
                            <td>£400</td>
                        </tr>
                        <tr>
                            <td>£501k +</td>
                            <td>3</td>
                            <td>£350</td>
                            <td>£560</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8 md-10 sm-10">
                <div class="text-center">
                    <p style="font-size: 30px; margin: 15px 15px;">* income levels will be verified by our Customer Services
                        team</p>
                    <button class="btnNext" onclick="goToStep(2)">Next <i class="fas fa-arrow-up"></i></button>
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
                            <td>£50</td>
                            <td class="highlighted">£80</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>£150</td>
                            <td>£240</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>£250</td>
                            <td>£400</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>£350</td>
                            <td>£560</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8 md-10 sm-10 mt-5">
                <div class="text-center">
                    <button class="btnNext" onclick="goToStep(2)">Next <i class="fas fa-arrow-up"></i></button>
                    <p style="font-size: 30px; margin: 15px 15px;">If you are a public sector organisation and would like to
                        discuss multiple licenses for the voluntary and community sector, please contact us at <a
                            href="mailto: info@thedatashed.co.uk">info@thedatashed.co.uk</a></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center d-none" id="step2">
            <div class="col-lg-10 md-12 sm-12 icon-box mt-5 mb-5 p-5">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control customField" name="firstName" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control customField" name="lastName" placeholder="Last Name">
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <input type="text" class="form-control customField" name="jobTitle" placeholder="Job Title">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control customField" name="organisationName"
                            placeholder="Organisation name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control customField" name="charityNo"
                            placeholder="Charity no. (if applicable)">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control customField" name="address" placeholder="Address">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control customField" name="townOrcity" placeholder="Town or City">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control customField" name="postCode" placeholder="Postcode">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="email" class="form-control customField" name="emailAddress"
                            placeholder="Email address">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control customField" name="confirmEmail"
                            placeholder="Confirm email address">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control customField" name="telephoneNumber"
                            placeholder="Telephone number">
                    </div>
                    <div class="col-md-4">
                        <input type="password" class="form-control customField" name="password" placeholder="Password">
                    </div>
                    <div class="col-md-4">
                        <input type="password" class="form-control customField" name="confirmPassword"
                            placeholder="Confirm password">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Tick the checkbox if you would like to receive news and updates from.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I accept the privacy policy and terms and conditions of my subscription.
                            </label>
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
            </div>
        </div>

    </div>

    <div class="row justify-content-center d-none" id="step3">
        <div class="col-lg-10 md-12 sm-12 icon-box mt-5 mb-5 p-4">
            <div class="row justify-content-center">
                <div class="col-md-5 paymentBox m-2">
                    <h4>pay via credit / debit card</h4>
                    <p style="text-align: left">Lorem ipsum dolor sit amet and consectetur adipiscing elit nulla aliquet
                        justo</p>
                    <button class="btnNext">Next <i class="fas fa-arrow-up"></i></button>
                </div>
                <div class="col-md-5 paymentBox m-2">
                    <h4>pay via invoice</h4>
                    <p style="text-align: left">Lorem ipsum dolor sit amet and consectetur adipiscing elit nulla aliquet
                        justo</p>
                    <button class="btnNext">Next <i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToStep(step) {
            // Hide all steps
            const steps = document.querySelectorAll('.row[id^="step"]');
            steps.forEach(s => s.classList.add('d-none'));

            // Show the requested step
            const currentStep = document.getElementById(`step${step}`);
            if (currentStep) {
                currentStep.classList.remove('d-none');
                updateProgress(step);
            }
        }

        function updateProgress(step) {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach((bar, index) => {
                //bar.classList.remove('text-light');
                bar.classList.remove('active-bar');
                bar.style.width = '33.33%'; // Reset widths
                if (index < step - 1) {
                    bar.classList.add('text-light');
                    bar.classList.add('active-bar');
                } else if (index === step - 1) {
                    bar.style.width = '33.33%'; // Active step
                    bar.classList.add('active-bar');
                }
            });
        }

        function submitForm() {
            // Perform form submission logic here
            alert('Form submitted!');
        }

        // Start with the first step
        goToStep(1);
    </script>



    @include('frontend.pages.scripts')

    @include('frontend.pages.collections.index')
@endsection
