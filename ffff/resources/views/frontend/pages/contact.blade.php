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
</style>
<!--Banner section Start -->
<!-- <div class="container-fluid inner-pages-banner contact-banner">
    <img class="img-responsive" src="assets/theme/images/contact-new.jpg"/>
</div> -->
<!--Banner section End -->
<!--Medil section Start -->
<!-- <div class="innerpage-main-content-section contactpage">
    <div class="container">
        <div class="row">
            <div class="col-md-6 contactleft">
                    <h2>
                       Contact us via e-mail here
                    </h2>
                    <p>Fields marked with * are required fields</p>
                    <div id="contact_page_ajax_respond"></div>

                <form id="C_sendMail" method="post" onsubmit="return SendContactMail(event);">
                    <label>Name <sup>*</sup><br>
                        <input id="C_SendMail_name" name="name" placeholder="" type="text"></input>
                    </label>
                    <br>
                    <label>Email <sup>*</sup><br>
                        <input id="C_SendMail_email" name="email" placeholder="" type="email"></input>
                        </label>
                        <br>
                        <label>Phone number <sup>*</sup><br>
                        <input id="C_SendMail_contact_no" name="contact" placeholder="" type="tel">
                        </input>
                        </label>
                        <br>
                        <label>Enquiry<br>
                        <textarea id="C_SendMail_message" name="message" placeholder="Message">
                        </textarea>
                        </label>
                        <br>
                        <input class="button" type="submit" value="send message"></input>
                </form>
            </div>
            <div class="col-md-6">
                <div class="contact-details">

                    <?php  //echo $cms['content']; ?>

                </div>


            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> -->

    <!-- ............................Contact-Bannner.............................. -->
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


    <!-- ....................................Form-section-1....................................... -->
    <section class="Form-section">
        <div class="row get-touch align-items-center">
            <div class="col-lg-6 col-sm-12 p-0">
                <div class="form d-flex flex-row flex-wrap gap-4">
                    <input type="text" id="name" name="Name" placeholder="First Name">
                    <input type="text" id="name" name="Name" placeholder="Last Name">
                    <input type="text" id="name" name="Name" placeholder="Email">
                    <input type="text" id="name" name="Name" placeholder="Phone">
                    <textarea id="subject" name="subject" placeholder="Message.." style="height:200px"></textarea>
                </div>
                <div class="row col-lg-12 d-flex align-items-center check-box pt-4">

                    <div class="col-lg-6 d-flex gap-2 col-md-6 col-sm-12">
                        <input class="form-check-input mt-0" type="checkbox" value=""
                            aria-label="Checkbox for following text input">
                        <p class="mb-0">I Accept Privacy Policy</p>
                    </div>
                    <div class="col-lg-6 col-md-6 justify-content-end d-flex col-sm-12">
                        <button class="btn-contact">
                            <a href="">Submit </a>
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 icon-box-container">
                <h2 class="mb-0">Get In Touch</h2>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex gap-3">
                        <img src="{{asset('charity/images/Phone call.svg')}}" alt="" class="img-fliud">
                        <div class="box">
                            <h4 class="mb-0">Telephone</h4>
                            <p class="mb-0">020 3740 2750</p>
                        </div>
                    </div>
                </div>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex  gap-3">
                        <img src="{{asset('charity/images/sms.svg')}}" alt="" class="img-fliud">
                        <div class="box">
                            <h4 class="mb-0">Email</h4>
                            <p class="mb-0">info@charityfunders.com</p>
                        </div>
                    </div>

                </div>
                <div class="main-icon-box mt-3">
                    <div class="col-md-12 d-flex align-items-start gap-3">
                        <img src="{{asset('charity/images/location.svg')}}" alt="" class="img-fliud">
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


    <!-- .......................Section-2.......................... -->
    <section class="Call-to-action">
        <div class="Action-container">
            <div class="Action">
                <div class="content">
                    <h2>We are a fully remote working <br> organisation so please call or <br> email our team.</h2>
                </div>
            </div>

        </div>
    </section>



<!--Medil section End -->
<script>
    function SendContactMail(e) {
        e.preventDefault();

        var formData = jQuery('#C_sendMail').serialize();

        var error = 0;

        var name = jQuery('#C_SendMail_name').val();
        if (!name) {
            jQuery('#C_SendMail_name').addClass('required');
            error = 1;
        } else {
            jQuery('#C_SendMail_name').removeClass('required');
        }

        var email = jQuery('#C_SendMail_email').val();
        if (!email) {
            jQuery('#C_SendMail_email').addClass('required');
            error = 1;
        } else {
            jQuery('#C_SendMail_email').removeClass('required');
        }

        var contact_no = jQuery('#C_SendMail_contact_no').val();
        if (!contact_no) {
            jQuery('#C_SendMail_contact_no').addClass('required');
            error = 1;
        } else {
            jQuery('#C_SendMail_contact_no').removeClass('required');
        }

        var message = jQuery('#C_SendMail_message').val();
        if (!message) {
            jQuery('#C_SendMail_message').addClass('required');
            error = 1;
        } else {
            jQuery('#C_SendMail_message').removeClass('required');
        }

        if (!error) {
            jQuery.ajax({
                type: "POST",
                url: "mail/send_a_message_contact_us",
                dataType: 'json',
                data: formData,

                beforeSend: function () {
                    jQuery('#contact_page_ajax_respond').html('<p class="ajax_processing">Sending...</p>');
                },
                success: function (jsonData) {
                    jQuery('#contact_page_ajax_respond').html(jsonData.Msg);
                    if (jsonData.Status === 'OK') {
                        document.getElementById("C_sendMail").reset();
                        setTimeout(function () {
                            $('#contact_page_ajax_respond').slideUp('slow') }, 2000);
                    }
                }
            });
        }
    }
</script>

    @include('frontend.pages.scripts')

    @include('frontend.pages.collections.index')
@endsection
