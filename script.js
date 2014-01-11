jQuery(document).ready(function (){
    if (needToCheckCookie()){
        show_cookie_bar();
        var cookie_bar = jQuery('#cg_cookie_bar');

        var cfTimeout = cookie_bar.data('timeout');
        var cfScrollout = cookie_bar.data('scrollout');
        cookie_bar.find('.close').click(function (){
            cookies_accepted();
            return false;
        });

        jQuery('a').not('.no-cookie-accept').click(cookies_accepted);

        var isException = cookie_bar.hasClass('exception');
        if (!isException){
            setTimeout(function (){
                cookies_accepted();
            },cfTimeout*1000);

            jQuery(window).scroll(function (){
                if (jQuery(window).scrollTop()>cfScrollout){
                    cookies_accepted();
                }
            });
        }
    
    }
});

function cookies_accepted(){
    if (typeof(accepted)=='undefined' || !accepted){
        accepted = true;
        accept_cookies();
        hide_cookie_bar();
        jQuery('a').unbind('click',cookies_accepted);
        insertTemplates();
    }
}

function show_cookie_bar(){
    jQuery('html').css({
        'margin-top': jQuery('#cg_cookie_bar').outerHeight()
    });
    jQuery('#cg_cookie_bar').show();
}

function hide_cookie_bar(){
    jQuery('html').animate({
        'margin-top': 0
    });
    //~ jQuery('#cg_cookie_bar').slideUp();
    jQuery('#cg_cookie_bar').fadeOut();
}

function accept_cookies(){
    setCookie('cg_cookie_accepted','1',365);
}

function setCookie(c_name,value,exdays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

function needToCheckCookie(){
    var userDate = new Date();
    timezone = -(userDate.getTimezoneOffset()/60);

    var result = timezone>=0 && timezone<=3;

    return result;
}

function insertTemplates(){
    var templates = [
        'cg_cf_head_template',
        'cg_cf_foot_template'
    ];
    for(var i=0; i < templates.length; i++){
        var code = jQuery('#'+templates[i]).html().replace('/*!*','').replace('*!*/','').replace('/!*','/*').replace('*!/','*/').replace('<!/script','</script');
        jQuery('body').append(code);
    }
}
