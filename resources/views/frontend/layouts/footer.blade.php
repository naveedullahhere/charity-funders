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
                        <li><a href="about">About us</a></li>
                        <li><a href="">Subscriptions</a></li>
                        <li><a href="faqs">FAQs</a></li>
                        <li><a href="contact">Contact us</a></li>
                    </ul>
                    <button><a href="">Login</a><i class="fas fa-arrow-up"></i></button>
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


<script src="assets/lib/plugins/select2/select2.min.js"></script>

<script>
    jQuery(window).on('scroll', function() {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        } else {
            return false;
        }
    }
    jQuery('.scrollup').on('click', function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 41) {
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });

    (function($) {
        $.fn.menumaker = function(options) {
            var cssmenu = $(this),
                settings = $.extend({
                    format: "dropdown",
                    sticky: false
                }, options);
            return this.each(function() {
                $(this).find(".button").on('click', function() {
                    $(this).toggleClass('menu-opened');
                    var mainmenu = $(this).next('ul');
                    if (mainmenu.hasClass('open')) {
                        mainmenu.slideToggle().removeClass('open');
                    } else {
                        mainmenu.slideToggle().addClass('open');
                        if (settings.format === "dropdown") {
                            mainmenu.find('ul').show();
                        }
                    }
                });
                cssmenu.find('li ul').parent().addClass('has-sub');
                multiTg = function() {
                    cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                    cssmenu.find('.submenu-button').on('click', function() {
                        $(this).toggleClass('submenu-opened');
                        if ($(this).siblings('ul').hasClass('open')) {
                            $(this).siblings('ul').removeClass('open').slideToggle();
                        } else {
                            $(this).siblings('ul').addClass('open').slideToggle();
                        }
                    });
                };
                if (settings.format === 'multitoggle')
                    multiTg();
                else
                    cssmenu.addClass('dropdown');
                if (settings.sticky === true)
                    cssmenu.css('position', 'fixed');
                resizeFix = function() {
                    var mediasize = 1000;
                    if ($(window).width() > mediasize) {
                        cssmenu.find('ul').show();
                    }
                    if ($(window).width() <= mediasize) {
                        cssmenu.find('ul').hide().removeClass('open');
                    }
                };
                resizeFix();
                return $(window).on('resize', resizeFix);
            });
        };
    })(jQuery);

    (function($) {
        $(document).ready(function() {
            $("#cssmenu").menumaker({
                format: "multitoggle"
            });
        });
    })(jQuery);


    // $('.select2')?.select2();

    jQuery(".btn_subscribe").click(function(event) {
        event.preventDefault();
        var email = jQuery("#newsletter_email").val();
        var error = 0;

        if (validateEmail(email) == false || !email) {
            jQuery('#newsletter-msg').html('Invalid Email').show();
            error = 1;
        } else {
            jQuery('#newsletter-msg').hide();
        }

        if (error == 0) {
            jQuery.ajax({
                type: "POST",
                url: "newsletter_subscriber/Newsletter_subscriber_frontview/create_action_ajax",
                dataType: 'json',
                data: {
                    email: email
                },
                success: function(jsonData) {
                    jQuery('#msg').html(jsonData.Msg).slideDown('slow');
                    if (jsonData.Status === 'OK') {
                        jQuery('#msg').delay(2000).slideUp('slow');
                        jQuery("#newsletter_email").val('');
                    } else {
                        jQuery('#msg').delay(5000).slideUp('slow');
                    }
                    //console.log( jsonData );
                }
            });
        }
    });
</script>
