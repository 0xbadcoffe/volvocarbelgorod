$('.car-righ .img-wrap').click(function() {
    $(this).closest('.car-img-clc').find('.car-left>.img-wrap>img').attr('src', $(this).find('img').attr('src'));
    $(this).closest('.car-img-clc').find('.img-wrap').removeClass('on-act');
    $(this).addClass('on-act');
});

[].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
    img.setAttribute('src', img.getAttribute('data-src'));
    img.onload = function() {
        img.removeAttribute('data-src');
    };
});

var flag = false;

size();

$(window).resize(function() {
    if (flag == false) {
        size();
    }
});

function size() {
    if ($(window).width() < '993') {
        $('header .top-menu').prepend('<div class="hamburger"><i></i></div>');

        $('.prime-menu .sub').each(function() {
            $(this).children('a').after('<i></i>');
        });

        $('.prime-menu .sub i').click(function() {
            $(this).closest('.sub').toggleClass('on-actb');
        });

        $('.hamburger').click(function() {
            $(this).toggleClass('on-act');
            if ($(this).hasClass('on-act')) {
                $('header ul.prime-menu').addClass('on-act');
                $('header .circul').addClass('on-act');
                $('body').addClass('noscroll');
            } else {
                $('header ul.prime-menu').removeClass('on-act');
                $('header .circul').removeClass('on-act');
                $('body').removeClass('noscroll');
            }
        });

        flag = true;
    }
}

$(window).scroll(function() {
    if ($(window).width() < '900') {
        if ($(window).scrollTop() > 0 && $(window).scrollTop() <= $('header .top-wrap').height()) {
            $('header .prime-menu').css('height', 'calc(100vh - (125px - ' + $(window).scrollTop() + 'px');
        } else {
            $('header .prime-menu').css('height', '');
        }
        if ($(window).scrollTop() > $('header .top-wrap').height()) {
            $('header .top-wrap').css('margin-bottom', $('header .top-menu').height());
            $('header').addClass('onscroll');
        } else {
            $('header .top-wrap').css('margin-bottom', '0');
            $('header').removeClass('onscroll');
        }
    }
});

$(document).ready(function() {
    if ($("div").is(".slider-autoplay-none")) {
        var apl = false;
    } else {
        var apl = true;
    }
    $('.slider-top').each(function() {
        if ($(this).find('.slider-top__item').length > 1 || $(this).find('.image-car-item').length > 1) {
            $(this).slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                autoplay: apl,
                autoplaySpeed: 5000,
                arrows: false
            });
        }
    });
    $('.slider-news').each(function() {
        $(this).slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            variableWidth: true,
            arrows: false
        });
    });

    if ($(window).width() < '875') {
        $('.slider-auto').each(function() {
            $(this).slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                variableWidth: true,
                arrows: true
            });
        });
    } else {
        $('.slider-auto').each(function() {
            $(this).slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                variableWidth: true,
                arrows: true
            });
        });
    }

    $('.news-mobile').each(function() {
        $(this).slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            variableWidth: true,
            arrows: false
        });
    });

    if ($(window).width() < '575') {
        $('.slider-top').each(function() {
            $(this).find('.slick-dots').css('top', ($(this).find('.img-wrap').innerHeight() - 5) + 'px');
        });
    } else {
        $('.slider-top').each(function() {
            $(this).find('.slick-dots').css('top', 'initial');
        });
    }
});

$(window).resize(function() {
    if ($(window).width() < '575') {
        $('.slider-top').each(function() {
            $(this).find('.slick-dots').css('top', ($(this).find('.img-wrap').innerHeight() - 5) + 'px');
        });
    } else {
        $('.slider-top').each(function() {
            $(this).find('.slick-dots').css('top', 'initial');
        });
    }
});

$(window).on('load resize', function() {
    var width = $(window).width();

    $('.equipments-tabs a').click(function() {
        $('.equipments-tabs').find('.active').removeClass('active');
        $(this).addClass('active');
        $('.modifications-box').find('.modifications-box__item').hide();
        $('.modifications-box__mobile').find('.modifications-box__item-mobile').hide();
        $('.' + $(this).data('switch')).each(function() {
            $(this).show()
        });
    });

    if (width <= '740') {
        $('.table-tabs a').click(function() {
            $(this).parents('.table-tabs').find('.active').removeClass('active');
            $(this).addClass('active');
            $(this).parents('.table-tabs').parents('.modifications-box__item-mobile').find('.modifications-table__mobile').hide();
            $('#' + $(this).data('switch')).show();
        });
    }
});




var clickFlag = false;
var ths;
$(".aj-form-send").submit(function() {
	var ids = $(this).attr('id');
    if (clickFlag) return false;
    clickFlag = true;
    ths = $(this);
    $(this).find('button').find('span').text('Подождите...');
    $.ajax({
        type: "POST",
        url: "/mail.php",
        data: $(this).serialize(),
        dataType: 'json'
    }).done(function(json) {
        if (json.status == 'success') {

			switch(ids) {
                case 'form-1221':
				//gtag('event', 'CALL-BACK');
				break;
				case 'form-1217':
				//gtag('event', 'TEST-DRIVE');
				break;
				case 'form-1218':
				//gtag('event', 'OFFER');
				break;
			}

            clickFlag = false;
            ths.find('.call-block__policy-form').html('Спасибо, Ваша заявка принята. В ближайшее время с Вами свяжется менеджер для уточнения деталей');
            ths.find("div, button").addClass('none');
            ths.find("input").val("");
            ths.trigger("reset");
        }
    });
    return false;
});

switch (window.location.hash) {
    case '#services':
        CallForm(1220);
        break;
    case '#offer':
        CallForm(1218);
        break;
    case '#testdrive':
        CallForm(1217);
        break;
}

function CallForm(ids) {
    $('#af-' + ids).addClass('popup_active');
    $('#af-' + ids).find('.popup').addClass('popup_active');
}

$('.btn-popup').click(function() {
    $('#' + $(this).data('id')).addClass('popup_active');
    $('#' + $(this).data('id')).find('.popup').addClass('popup_active');
});

$('.close-popup').click(function() {
    $(this).closest('.popup-wrap').removeClass('popup_active');
    $(this).closest('.popup-wrap').find('.popup').removeClass('popup_active');
});


$(document).mouseup(function(e) {
    var container = $('.popup');
    if (container.hasClass('popup_active')) {
        if (container.has(e.target).length === 0) {
            $('.popup-wrap').removeClass('popup_active');
            $('.popup-wrap').find('.popup').removeClass('popup_active');
        }
    }
});

$.mask.definitions['9']='';
$.mask.definitions['d']='[0-9]';
$("input[type=tel]").mask("+7 (ddd) ddd-dd-dd");

var input = document.querySelectorAll("input[type=tel]");
$.each(input, function (index, value) {

    window.intlTelInput(value, {
        autoHideDialCode:false,
        autoPlaceholder:"aggressive",
        placeholderNumberType:"MOBILE",
        initialCountry: "ru",
        onlyCountries: ["al", "ad", "at", "by", "be", "ba", "bg", "hr", "cz", "dk",
            "ee", "fo", "fi", "fr", "de", "gi", "gr", "va", "hu", "is", "ie", "it", "lv",
            "li", "lt", "lu", "mk", "mt", "md", "mc", "me", "nl", "no", "pl", "pt", "ro",
            "ru", "sm", "rs", "sk", "si", "es", "se", "ch", "ua", "gb"],
        separateDialCode:true,
        utilsScript: "/local/templates/motorlandgroup/assets/plugins/intltel/js/utils.js",
        customPlaceholder:function(selectedCountryPlaceholder,selectedCountryData){
            return '+'+selectedCountryData.dialCode+' '+selectedCountryPlaceholder.replace(/[0-9]/g,'_');
        },
    });
});

$("input[type=tel]").on("close:countrydropdown",function(e,countryData){
    $(this).val('');
    //var mask=$(this).closest('.intl-tel-input').find('.selected-dial-code').html()+' '+$(this).attr('placeholder').replace(/[0-9]/g,'d');
    $(this).mask($(this).attr('placeholder').replace(/[_]/g,'d'));
});


$(document).ready(function() {

    $(".auto-run-card__item--img").brazzersCarousel();


    $('.to-row a').click(function() {
        $('[data-elems = ' + $(this).data('elem') + ']').addClass('active');
        $("body").addClass('noscroll');
    });

    $('.po-close').click(function() {
        $('.poup').removeClass('active');
        $("body").removeClass('noscroll');
    });


    $('.tabulation').prepend('<div class="tab-nav"></div>');
    var numflag = true;
    $('.tabulation').find('.tab').each(function(i) {
        $(this).attr('data-num', i);
        $('.tab-nav').prepend('<div class="tab-btn" data-num="' + i + '">' + $(this).data('name') + '<div>');
        if (numflag) {
            $(this).addClass('active');
            $('.tab-nav').find('[data-num = ' + i + ']').addClass('active');
            numflag = false;
        }
        $('.preloader').addClass('hidden');
    });

    $('.tab-btn').click(function() {
        $('.tabulation').find('.tab, .tab-btn').removeClass('active');
        $('.tabulation').find('[data-num = ' + $(this).data('num') + ']').addClass('active');
    });


    var cont = 0

    $('.car-360 img').each(function(i) {
        $(this).attr('data-pos', i);
        cont++;
    });
    var widt = $('.target').width();
    var strik = widt / (cont - 1);

    var nowpos = 0;

    var tbpos;

    $('.target').on('touchstart mousedown', (event) => {
        if (event.pageX) {
            var nowstart = event.pageX;
        } else {
            var nowstart = event.originalEvent.changedTouches[0].clientX;
        }
        $(document).on('touchmove mousemove', (event) => {
            if (event.pageX) {
                var evavi = event.pageX;
            } else {
                var evavi = event.originalEvent.changedTouches[0].clientX;
            }
            var X = nowpos + (evavi - nowstart);
            if (X < 0 || X > widt) {
                if (X < 0) {
                    X = X + widt;
                } else {
                    X = X - widt;
                }
            }
            var posk = Math.floor(X / strik);
            $('.car-360 img').removeClass('egz-1');
            $('[data-pos = ' + posk + ']').addClass('egz-1');
            tbpos = X;
        })
        $(document).on('touchend mouseup', (event) => {
            $(document).off('touchmove mousemove');
            nowpos = tbpos;
        });
    });
});

$('.input-out input').change(function() {
    var inp = $(this);
    if (inp.data('max') < inp.val()) {
        inp.val(inp.data('max'));
    }
});

$(document).on('submit', '.filter', function() {
    $('select, input').each(function() {
        if (!$(this).val()) {
            $(this).prop('disabled', true);
        }
    });
});
