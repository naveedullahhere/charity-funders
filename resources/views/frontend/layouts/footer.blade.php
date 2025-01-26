<style>
    .newsletter-section {
        background-color: #9bd7d542;
        padding: 30px 0;
        margin-top: 30px;
    }

    .newsletter-container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .newsletter-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
    }

    .newsletter-description {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }

    .newsletter-form {
        display: flex;
        justify-content: center;
    }

    .newsletter-input {
        width: 70%;
        padding: 12px 15px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px 0 0 4px;
    }

    .newsletter-button {
        padding: 12px 20px;
        font-size: 16px;
        background-color: #129793;
        color: white;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .newsletter-button:hover {
        background-color: #0f7a76;
    }

    .newsletter-message {
        margin-top: 15px;
        font-size: 14px;
    }

    .error-message {
        color: #d9534f;
    }

    .success-message {
        color: #5cb85c;
    }
</style>

<div class="newsletter-section">
    <div class="newsletter-container">
        <h2 class="newsletter-title">Stay Updated with Charity Funders</h2>
        <p class="newsletter-description">
            Subscribe to our newsletter and stay updated on the latest developments and special offers!
        </p>
        <form id="newsletterForm" class="newsletter-form">
            @csrf
            <input type="email" name="email" class="newsletter-input" placeholder="Enter your email address" required>
            <button type="submit" id="subscribeButton" class="newsletter-button">
                Subscribe
            </button>
        </form>
        <div id="emailError" class="newsletter-message error-message"></div>
        <div id="successMessage" class="newsletter-message success-message"></div>
    </div>
</div>
<div class="footer">
    <div class="container-fuild">
        <div class="ft-row">
            <div class="col-md-3 col-sm-12 foot-divid">
                <a href="/"><img src="{{ asset('charity/images/footer-logo.png') }}" class="img-fluid"
                        alt=""></a>
            </div>

            <div class="col-md-8 col-sm-12 nav-1">
                <div class="nav">
                    <ul class="m-0">
                        <li><a href="{{url('about')}}">About us</a></li>
                        <li><a href="">Subscriptions</a></li>
                        <li><a href="{{url('faqs')}}">FAQs</a></li>
                        <li><a href="{{url('contact-us')}}">Contact us</a></li>
                    </ul>
                    <button><a href="{{url('my-account')}}">Login</a><i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <div class="footer-row">
            <div class="col-md-12 icon-2">
                <div class="twitter-icon">
                    <i class="fa-brands fa-x-twitter"></i>
                    <p class="paragraph-text m-auto">@charity_funders</p>
                </div>
                <div class="youtube-icon">
                    <i class="fa-brands fa-youtube"></i>
                    <p class="paragraph-text m-auto">@charityfunders6632</p>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="main-cont">
    <div class="footer-sec-row d-flex align-items-center">
        <div class="col-lg-8 location-icon d-flex align-items-center gap-3 col-md-12 col-sm-12 align-items-start ">
            <i class="fa-solid fa-location-dot"></i>
            <p class="paragraph-text mb-0">Londoneast-UK Business & Technical Park, Yew Tree Avenue,</p>
        </div>
        <div class="col-lg-2 email location-icon d-flex align-items-center gap-3 col-md-12 col-sm-12">
            <i class="far fa-envelope"></i>
            <p class="paragraph-text mb-0">info@charityfunders.org.uk</p>
        </div>
        <div class="col-lg-2 phone location-icon d-flex align-items-center gap-3 col-md-12 col-sm-12">
            <i class="fa-solid fa-phone-flip"></i>
            <p class="paragraph-text mb-0">020 3740 2750</p>
        </div>
    </div>
</div>

<div class="footer-last-row">
    <div class="col-lg-6 Reserved">
        <p class="paragraph-text mb-0 ">© Copyright <span>Charity Funders</span> All Rights Reserved</p>
    </div>

    <div class="col-lg-6 Terms">
        <h5 class="mb-0">Terms & Condition</h5>
        <h5 class="mb-0">Privacy Policy</h5>

    </div>

</div>

    <script src="{{ asset('management/assets/js/scripts.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault();
            $('#emailError').text('');
            $('#successMessage').text('');
            $('#subscribeButton').prop('disabled', true).text('Subscribing...');

            $.ajax({
                url: '{{ route('newsletter.subscribe') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#successMessage').text(response.message);
                        $('#newsletterForm')[0].reset();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (let error in errors) {
                            $(`#${error}Error`).text(errors[error][0]);
                        }
                    } else {
                        $('#emailError').text('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('#subscribeButton').prop('disabled', false).text('Subscribe');
                }
            });
        });
    });
</script>
