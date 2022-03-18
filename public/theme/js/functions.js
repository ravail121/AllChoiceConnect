$(function() {

    // marquee
    if($('.marquee').length) {
        console.log($('.marquee').width());
        $('.marquee').marquee({
            // duration: 15000,
            duration: $('.marquee').width()*13,
            startVisible: true,
            duplicated: true
        });
    }

    $('body').on('click', '.close-marquee', function() {
        $('.marquee-wrapper').slideUp(300, function() {
            $('.marquee-wrapper').remove();
        });
        
        return false;
    });


    // slider

    function setupSlider() {
        var i = 1;
        $('.slider .sliderWrapper li').each(function() {
            var $this = $(this);
            $this.attr('data-slide', i);
            if(i === 2) {$this.addClass('active');}
            $('.slider nav').append('<a href="#" data-slide="'+i+'" '+(i === 2 ? 'class="active"' : '')+'>'+i+'</a>');
            i++;
        });

    }

    setupSlider();


    // clicking on a slide 

    function goTo(slide) {
        var left = 0;
        slide = parseInt(slide, 10);
        switch (slide) {
            case 1:
                left = 50;
                break;

            case 2:
                left = 0;
                break;

            default:
                left = -(50*(slide-2));
                break;
        }
        
        $('.slider .sliderWrapper li, .slider nav a').removeClass('active');
        $('.slider .sliderWrapper li[data-slide="'+slide+'"], .slider nav a[data-slide="'+slide+'"]').addClass('active');
        $('.slider .sliderWrapper ul').css('left', left+'%');
    }

    $('body').on('click', '.slider .sliderWrapper a', function() {
        var $this = $(this);
        if(!$this.parent().hasClass('active')) {
            goTo($this.parent().attr('data-slide'));
            return false;
        }
    });

    $('body').on('click', '.slider nav a', function() {
        goTo($(this).attr('data-slide'));
        return false;
    });




    // forgot Password 
    $('body').on('click', '.loginPreForgot', function() {
        $('.loginPre').removeClass('showing');
        $('.forgotPre').addClass('showing');
        
        return false;
    });


     $('body').on('click', '.loginNavForgot', function() {
        $('.loginNav').removeClass('showing');
        $('.forgotNav').addClass('showing');
        
        return false;
    });







    // open the nav
    $('body').on('click', '.openNav', function() {
    	if($('header nav ul').hasClass('open')) {
    		$('header nav ul').slideUp(300, function() {
    			$('header nav ul').removeClass('open');
    		});
    	} else {
    		$('header nav ul').slideDown(300, function() {
    			$('header nav ul').addClass('open');
    		});
    	}
        
        return false;
    });

    // support
    $('body').on('click', '.questions h2', function() {
        if($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).parent().find('.answer').slideUp(300);
        } else {
            $(this).parent().siblings('.active').removeClass('active').find('.answer').slideUp(300);
            $(this).parent().addClass('active');

            $('.questions .active .answer').slideDown(300);
        }
        
        return false;
    });


    // when clicking on a questions category
    $('body').on('click', '.faqs nav a', function() {
        var $this = $(this);
        $('.faqs nav a').removeClass('active');
        $this.addClass('active');
        var category = $this.attr('data-category');

        $('.questions li[data-category="'+category+'"]').slideDown(300);
        $('.questions li[data-category!="'+category+'"]').slideUp(300);
        
        return false;
    });

    // modals
    function closeModal() {
        $('.overlay').fadeOut(300);
        $('.modal').removeClass('visible');
        $('.cart').removeClass('showing');
        $('body').removeClass('noScroll');
    }

    $('body').click(function(e){
        if($(e.target).attr('class') === 'overlay') {
            closeModal();
        }
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // Esc
            closeModal();
        }
    });

    $('body').on('click', '.close', function() {
        closeModal();
        return false;
    });

    // showCart animation
    $('body').on('click', '.openCart', function() {
        $('.cart').toggleClass('showing');
        $('body').toggleClass('noScroll');
        if($('.cart').hasClass('showing')) {
            $('.overlay').fadeIn(300);
        } else {
            $('.overlay').fadeOut(300);
        }
        return false;
    });

    // show features
    $('body').on('click', '.features .seeAll', function() {
        $('.features .wrap').slideDown(300);
        
        return false;
    });

    // open the file chooser
    $('body').on('click', '.chooseTrigger', function() {
        // $('.b-fileInput input').trigger('click');
        $('input#proof').trigger('click');
        return false;
    });

    // open coverage checker
    $('body').on('click', '.openCoverage', function() {
        // $('.coverageChecker').toggleClass('showing');
        $('.map').addClass('visible');
        $('body').addClass('noScroll');
        return false;
    });

    $('body').on('click', '.close-map', function() {
        $('.map').removeClass('visible');
        $('body').removeClass('noScroll');
        return false;
    });

    // Open login
    $('body').on('click', '.openLoginNav', function() {
        $('.loginNav').toggleClass('showing');
        $('.forgotNav').removeClass('showing');
        return false;
    });

    $('body').on('click', '.openLoginPre', function() {
        $('.loginPre').toggleClass('showing');
        $('.forgotPre').removeClass('showing');
        return false;
    });
   
    // open the plans
    $('body').on('click', '.plans li', function() {
        $('.overlay').fadeIn(300);
        console.log('clicked');
        $('.modal.planOptions').addClass('visible');
        $('html, body').animate({
            scrollTop: 0
        }, 300);

        if($(window).width() < 960) {
            $('body').addClass('noScroll');
        }
        
        return false;
    });


    // fix the shopping cart
    if($('.cart').length && $(window).width() > 960) {
        var cartTop = $('.cart').offset().top - 30;
        var cartWidth = $('.cart').width();

        $(window).scroll(function() {
            var cartHeight = $('.cart').height();
            var cartBottom = cartHeight + cartTop;
            var clipPoint = cartBottom+60+$('.cart h5').outerHeight();
            var cartMaxHeight = $('.cartMaxHeight').height() + $('.cartMaxHeight').offset().top;
            clipPoint = $('.cart').height() + cartTop + $('.cart h5').outerHeight() + 60;


            if(cartHeight > $(window).height()) {
                if(cartTop <= $(window).scrollTop()) {
                    $('.cart h5').css({
                        'position': 'fixed',
                        'top': '30px',
                        'width' : cartWidth,
                        'z-index': 10,
                        'border-radius': '0'
                    });
                    
                    if($(window).scrollTop()+$(window).height() >= clipPoint) {
                        // var padding = clipPoint-cartBottom;
                        var differance = ($(window).scrollTop()+$(window).height()-clipPoint);
                        var maxPadding = cartMaxHeight-clipPoint+60;
                        var padding = $('.cart h5').outerHeight()+differance;
                       $('.cart').css({
                            'padding-top': (padding <= maxPadding) ? padding : maxPadding
                        });
                    } else {
                        $('.cart').css({
                            'padding-top': $('.cart h5').outerHeight()
                        });
                    }
                } else {
                    $('.cart h5').css({
                        'top' : 0,
                        'position': 'relative',
                        'border-radius': '5px'
                    });

                    $('.cart').css({
                        'padding-top': 0,
                        'position': 'static'
                    });
                }
            } else {
                if(cartTop <= $(window).scrollTop()) {
                    $('.cartWrapper').css({
                        'position': 'fixed',
                        'top': '30px',
                        'width' : cartWidth,
                        'z-index': 10
                    });

                    // move up when reaching the bottom
                    cartMaxHeight = $('.cartMaxHeight').height() + $('.cartMaxHeight').offset().top;
                    // console.log(cartMaxHeight);
                    // console.log($(window).scrollTop()+$(window).height() - 90);
                    if($(window).scrollTop()+$(window).height() - 90 >= cartMaxHeight) {
                        var moveUp = $(window).scrollTop()+$(window).height() - 90 - cartMaxHeight;
                        $('.cartWrapper').css({
                            'top': -moveUp+30
                        });
                    }
                } else {
                    $('.cartWrapper').css({
                        'position': 'static',
                        'width' : 'auto'
                    });
                }
            }

        });
        
    }


    // CONTROL PANAL

    // open the menu 
    $('body').on('click', '.menu .trigger', function() {
        $(this).siblings('ul').toggleClass('isOpen');
        return false;
    });


    // when clickin on change the sim
    $('body').on('click', '.updateSim', function() {
        var plan = $(this).parents('.billPlans-line');
        $('.menu ul').removeClass('isOpen');

        plan.find('.sim input').prop('disabled', false).select();
        plan.find('.sim p').show();
        
        return false;
    });

    // when clicking on update imei
    $('body').on('click', '.updateIMEI', function() {
        var plan = $(this).parents('.billPlans-line');
        $('.menu ul').removeClass('isOpen');

        plan.find('.imei input').prop('disabled', false).select();
        plan.find('.imei p').show();
        
        return false;
    });


    // when canceling a plan option
    $('body').on('click', '.cancelPlanOption', function() {
        var $this = $(this);

        $this.parent().hide();
        $this.parent().siblings('input').prop('disabled', true);
        
        return false;
    });





    // open the data usage
    $('body').on('click', '.openUsage', function() {
        $('.overlay, .modal.usageHistory').fadeIn(300);
        $('html, body').animate({
            scrollTop: 0
        }, 300);

        if($(window).width() < 960) {
            $('body').addClass('noScroll');
        }
        
        return false;
    });


    // changing a tag on the usage

    $('body').on('click', '.usageHistory nav a', function() {
        var $this = $(this).parent();
        $this.addClass('active').siblings().removeClass('active');

        var activeTav = $this.attr('data-tab');

        $('.usageHistory .usage li[data-tab="'+activeTav+'"]').addClass('active').siblings().removeClass('active');
        
        return false;
    });


    // opening a card
     $('body').on('click', '.openCard', function() {
        var $this = $(this);
        if($this.parent().hasClass('active')) {
            $this.parent().removeClass('active');
            $this.parent().find('.additinal').slideUp(300);
            $this.parent().find('.editCardControls').slideUp(300);
            $this.parent().find('.inputs').slideUp(300);
            $this.parent().find('.text').slideDown(300);

            $this.parent().find('.editCard').show();
            $this.parent().find('.saveCard').hide();
            $this.parent().find('.cancelCard').hide();
        } else {
            $this.parent().siblings('.active').removeClass('active').find('.additinal').slideUp(300).find('.editCardControls').slideUp(300);
            $this.parent().addClass('active');

            $('.cp-paymentOptions .active .additinal').slideDown(300);
            $('.cp-paymentOptions .active .editCardControls').slideDown(300);

            $this.parent().find('.inputs').hide();
            $this.parent().find('.text').show();
        }
        
        return false;
    });

    // when editing a card
    $('body').on('click', '.editCard', function() {
        var card = $(this).parents('li');
        card.find('.inputs').slideDown(300);
        card.find('.text').slideUp(300);

        card.find('.editCard').hide();
        card.find('.saveCard').show();
        card.find('.cancelCard').show();

        return false;
    });

    // when clicking on the cancel card
    $('body').on('click', '.cancelCard', function() {
        var card = $(this).parents('li');
        card.find('.inputs').slideUp(300);
        card.find('.text').slideDown(300);

        card.find('.editCard').show();
        card.find('.saveCard').hide();
        card.find('.cancelCard').hide();
        
        return false;
    });


    // editing an account option
    $('body').on('click', '.editMe', function() {
        var $this = $(this);
        $this.hide();
        $this.siblings('.saveMe').show();
        $this.siblings('.cancelMe').show();

        $this.parents('li').find('input').prop('disabled', false).focus();

        return false;
    });

    // when clicking on the cancel button
    $('body').on('click', '.cancelMe', function() {
        var $this = $(this);
        $this.hide();
        $this.siblings('.saveMe').hide();
        $this.siblings('.editMe').show();

        $this.parents('li').find('input').prop('disabled', true);
        
        return false;
    });



    // when clicking to add a line
    $('body').on('click', '.addLine', function() {
        $('.addCardForm').slideDown(300);
        $('html, body').animate({
            scrollTop: $('.addCardForm').offset().top - 100
        }, 300);
        
        return false;
    });

    // when clicking on the cancal button
    $('body').on('click', '.addCardForm input[type="reset"]', function() {        
        $('.addCardForm').slideUp(300);
    });




    // feature details
    // mouseenter, mouseleave
    $('body').on('mouseenter', '.feature-details nav li', function() {
        var $this = $(this);
        var feature = $this.attr('data-features');

        $('.feature-details nav .arrow').attr('data-features', feature);
        
        return false;
    });

    $('body').on('mouseleave', '.feature-details nav li', function() {
        var feature = $('.feature-details nav li.active').attr('data-features');
        $('.feature-details nav .arrow').attr('data-features', feature);
        
        return false;
    });

    $('body').on('click', '.feature-details nav li', function() {
        var $this = $(this);

        $this.addClass('active').siblings().removeClass('active');
        $('.feature-group-details .group').removeClass('active');
        $('.feature-group-details .group[data-features="'+$this.attr('data-features')+'"]').addClass('active');

        
        return false;
    });
});