@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')

    <link rel="stylesheet" href="{{ asset('charity/contacts.css') }}">

    <style>
        .required {
            border: 1px solid red !important;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        input.error,
        textarea.error {
            border-color: red;
        }

        .btn-contact.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-contact .spinner {
            display: none;
            margin-left: 10px;
        }

        .btn-contact.loading .spinner {
            display: inline-block;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
    <section class="Contact-Banner">
        <div class="main-container">
            <div class="contact-container">
                <div class="main-heading">
                    <h1>Contact us</h1>
                </div>
                <div class="text-line">
                    <p>We're here to help</p>
                </div>
            </div>
        </div>
    </section>

    <section class="Form-section">
        <div class="row get-touch align-items-center">
            <div class="col-lg-6 col-sm-12 p-0">
                <form id="contactForm">
                    @csrf
                    <div class="form d-flex flex-row flex-wrap gap-4">
                        <div class="row mx-auto w-100 pe-lg-4">
                            <div class="my-2 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="first_name" name="first_name" class="w-100"
                                        placeholder="First Name">
                                    <span class="error-message" id="first_nameError"></span>
                                </div>
                            </div>
                            <div class="my-2 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="last_name" name="last_name" class="w-100"
                                        placeholder="Last Name">
                                    <span class="error-message" id="last_nameError"></span>
                                </div>
                            </div>
                            <div class="my-2 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="email" name="email" class="w-100" placeholder="Email">
                                    <span class="error-message" id="emailError"></span>
                                </div>
                            </div>
                            <div class="my-2 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="phone" name="phone" class="w-100" placeholder="Phone">
                                    <span class="error-message" id="phoneError"></span>
                                </div>
                            </div>
                            <div class="my-2 col-12">
                                <div class="form-group">
                                    <textarea id="message" name="message" class="w-100" placeholder="Message.." style="height:200px"></textarea>
                                    <span class="error-message" id="messageError"></span>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex gap-3">
                                    <input class="form-check-input mt-0" type="checkbox" name="privacy_policy"
                                        id="privacy_policy">
                                    <p class="mb-0">I Accept Privacy Policy</p>
                                    <span class="error-message" id="privacy_policyError"></span>
                                </div>
                                <div class="check-box">
                                    <button type="submit" class="btn-contact">
                                        Submit <i class="fas fa-arrow-up"></i>
                                        <span class="spinner"><i class="fas fa-spinner fa-spin"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="successMessage" class="alert alert-success mt-3" style="display: none;"></div>
                </form>
            </div>
            <div class="col-lg-6 icon-box-container">
                <h2 class="mb-0">Get In Touch</h2>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex gap-3">
                        <img src="{{ asset('charity/images/Phone call.svg') }}" alt="" class="img-fliud">
                        <div class="box">
                            <h4 class="mb-0">Telephone</h4>
                            <p class="mb-0">020 3740 2750</p>
                        </div>
                    </div>
                </div>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex  gap-3">
                        <img src="{{ asset('charity/images/sms.svg') }}" alt="" class="img-fliud">
                        <div class="box">
                            <h4 class="mb-0">Email</h4>
                            <p class="mb-0">info@charityfunders.com</p>
                        </div>
                    </div>
                </div>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex align-items-start gap-3">
                        <img src="{{ asset('charity/images/location.svg') }}" alt="" class="img-fliud">
                        <div class="box">
                            <h4 class="mb-0">Registered address</h4>
                            <p class="mb-0">Londoneast-UK Business & Technical <br>
                                Park, Yew Tree Avenue,</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex gap-2 mt-3 icon-2">
                    <div class="youtube-icon">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <div class="twitter-icon">
                        <i class="fa-brands fa-x-twitter"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="Call-to-action">
        <div class="Action-container">
            <div class="Action">
                <div class="content">
                    <h2>We are a fully remote working <br> organisation so please call or <br> email our team.</h2>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $('.error-message').text('');
                $('input, textarea').removeClass('error');
                $('#successMessage').hide();

                const submitButton = $('.btn-contact');
                submitButton.addClass('loading');

                $.ajax({
                    url: '{{ route('contact-us.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        submitButton.removeClass('loading');
                        $('#successMessage').text(response.success).show();
                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr) {
                        submitButton.removeClass('loading');
                        const errors = xhr.responseJSON.errors;
                        for (let error in errors) {
                            $(`#${error}Error`).text(errors[error][0]);
                            $(`[name="${error}"]`).addClass('error');
                        }
                    }
                });
            });
        });
    </script>

@endsection
