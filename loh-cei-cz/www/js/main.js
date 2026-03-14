/**
 @author: Ján Priškin
 @copyright www.priskin.sk
 **/

/* ------ */

// COUNTER ANIMATION
function startCounter() {
    $('.count').each(function () {
        var size = $(this).text().split(".")[1] ? $(this).text().split(".")[1].length : 0;

        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(parseFloat(now).toFixed(size));
            }
        });
    });
}

// MOBILE DETECT
function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
};

/* ------ */

$(function() {

/* ------ */

// TOGGLE MOBILE MENU
$("#menu-toggle").click(function (e) {
    $("#navbar").toggleClass('open');
    $("#navbar li.active").removeClass("active");

    $(this).toggleClass("open");
    $("#main-menu").stop(true).animate({
        height: "toggle",
        opacity: "toggle"
    }, "normal");
    e.preventDefault();
});

/* ------ */

// TOGGLE "about"
$(".show-more").click(function(e){
    var current = $(this).parents(".item"),
        anchor = $(this).data('toggle');

    $(".item.open").not(current).removeClass('open');
    current.addClass('open');

    $(".about-perex").fadeIn();
    $(".about-perex > div").hide();
    $("#"+anchor).fadeIn();

    /*if(screen.availHeight > screen.availWidth){
        $('html, body').stop().animate({
            scrollTop: $("#" + anchor).offset().top - 50
        }, 1000);
        e.preventDefault();
    }*/
});

/* ------ */

// COUNTER ANIMATION init
startCounter();

/* ------ */

// SVG replacer
$('img.svg').each(function () {
    var $img = $(this),
        imgID = $img.attr('id'),
        imgClass = $img.attr('class'),
        imgURL = $img.attr('src');

    $.get(imgURL, function (data) {
        var $svg = $(data).find('svg');

        if (typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        if (typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass + ' replaced-svg');
        }
        $svg = $svg.removeAttr('xmlns:a');
        $img.replaceWith($svg);
    }, 'xml');
});

/* ------ */


var tabEl = $('.btn[data-bs-toggle="tab"]');
tabEl.click(function(e){
    var tabHash = $(this).attr('href');

    $('.btn[data-bs-toggle="tab"]').removeClass('active');
    $("#fields").addClass('collapsed');

    setTimeout(function(){
        $('html, body').stop().animate({
            scrollTop: $(tabHash).offset().top
        }, 100);
    }, 1000);

    e.preventDefault();
});

/* ------ */

// disable #anchor jump on page load
if (location.hash) {
    var anchor = location.hash;

    $('html, body').stop().animate({
        scrollTop: $(anchor).offset().top
    }, 1000);
}

/* ------ */

// active image menu on pageload
/*if( location.hash ){
    var tabHash = location.hash;

    if( $(tabHash).length > 0 ) {
        $(tabHash).addClass('active show');
        $("#fields").addClass("collapsed");

        setTimeout(function(){
            $('html, body').stop().animate({
                scrollTop: $(tabHash).offset().top
            }, 100);
        }, 1000);
    }
}*/

/* ------ */

$('.request-a-service').click(function () {
    $('[name=message]').val('Mám zájem o službu - gutr' + $(this).parent().find('h2').text());
});

$('.show-cookie-settings').click(function () {
    cc.showSettings();
});

});

var cc = initCookieConsent();
cc.run({
    auto_language: 'document',
    autoclear_cookies: true,
    cookie_same_site: 'None',
    theme_css: '',
    page_scripts: true,
    languages: {
        'cs': {
            consent_modal: {
                title: 'Cookies',
                description: 'Tento web vyžaduje souhlas k použití cookies.',
                primary_btn: {
                    text: 'OK',
                    role: 'accept_all'
                },
                secondary_btn: {
                    text: 'Nastavení',
                    role: 'settings'
                }
            },
            settings_modal: {
                title: 'Nastavení cookies',
                save_settings_btn: 'Uložit nastavení',
                accept_all_btn: 'Povolit vše',
                close_btn_label: 'Zavřít',
                blocks: [
                    {
                        title: 'Technické',
                        description: 'Cookies nezbytné pro fungování a bezproblémové zobrazení webu.<br>Návštěvou souhlasíte s využitím těchto cookies, bez nich nejsme schopni zajistit správné fungování webu.',
                        toggle: {
                            value: 'necessary',
                            enabled: true,
                            readonly: true
                        }
                    }, {
                        title: 'Analytické',
                        description: 'Cookies evidující Vaši návštěvu našeho webu pro statistické účely. Na základě těchto dat optimalizujeme web pro uživatele notebooků, tabletů a mobilních telefonů.',
                        toggle: {
                            value: 'analytics',
                            enabled: false,
                            readonly: false
                        }
                    }, {
                        title: 'Personalizované',
                        description: 'Cookies ukládající Vámi preferované nastavení webu a zobrazování informací, o které jste projevili zájem. Na základě tohoto nastavení Vám budeme zobrazovat aktuální akce, podobné nemovitosti dle Vašich preferencí.',
                        toggle: {
                            value: 'personalized',
                            enabled: false,
                            readonly: false
                        }
                    }, {
                        title: 'Marketingové',
                        description: 'Cookies, které nám umožňují zobrazovat Vám slevy, speciální nabídky a další akce prostřednictvím reklamy na webech 3. stran. Zůstaňte s námi v kontaktu a nepřicházejte o informace o nejzajímavějších nabídkách a exkluzivních slevách.',
                        toggle: {
                            value: 'marketing',
                            enabled: false,
                            readonly: false
                        }
                    }
                ]
            }
        },
        'en': {
            consent_modal: {
                title: 'Cookies',
                description: 'This website requires consent to the use of cookies.',
                primary_btn: {
                    text: 'OK',
                    role: 'accept_all'
                },
                secondary_btn: {
                    text: 'Settings',
                    role: 'settings'
                }
            },
            settings_modal: {
                title: 'Cookie settings',
                save_settings_btn: 'Save settings',
                accept_all_btn: 'Allow everything',
                close_btn_label: 'Close',
                blocks: [
                    {
                        title: 'Technical',
                        description: 'Cookies necessary for the functioning and smooth display of the website.<br>By visiting you agree to the use of these cookies, without them we are not able to ensure the proper functioning of the website.',
                        toggle: {
                            value: 'necessary',
                            enabled: true,
                            readonly: true
                        }
                    }, {
                        title: 'Analytical',
                        description: 'Cookies recording your visit to our website for statistical purposes. Based on this data, we optimize the website for users of laptops, tablets and mobile phones.',
                        toggle: {
                            value: 'analytics',
                            enabled: false,
                            readonly: false
                        }
                    }, {
                        title: 'Personalized',
                        description: 'Cookies that store your preferred website settings and display the information you are interested in. Based on this setting, we will display current events, similar properties according to your preferences.',
                        toggle: {
                            value: 'personalized',
                            enabled: false,
                            readonly: false
                        }
                    }, {
                        title: 'Marketing',
                        description: 'Cookies that allow us to display discounts, special offers and other promotions through advertising on 3rd party websites. Stay in touch with us and do not lose information about the most interesting offers and exclusive discounts.',
                        toggle: {
                            value: 'marketing',
                            enabled: false,
                            readonly: false
                        }
                    }
                ]
            }
        }
    }
});

window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments);
}
gtag('consent', !cc.allowedCategory('marketing') && !cc.allowedCategory('personalized') && !cc.allowedCategory('analytics') ? 'default' : 'update', {
    'ad_storage': cc.allowedCategory('marketing') ? 'granted' : 'denied',
    'ad_user_data': cc.allowedCategory('marketing') ? 'granted' : 'denied',
    'ad_personalization': cc.allowedCategory('personalized') ? 'granted' : 'denied',
    'analytics_storage': cc.allowedCategory('analytics') ? 'granted' : 'denied'
});