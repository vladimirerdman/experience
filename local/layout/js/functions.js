/**
 * Getting $_SESSION lang
 */
//console.log(sessionUserLang);
//localStorage.removeItem("ChosenLanguage");

/**
 * Hidden text
 */
var hiddentext = document.getElementById("hiddenfromeye");

/**
 * localStorage
 */
//null by default
$('#langConfY').click(function(){
    localStorage.setItem('langConfirmation', 'Yes');
    document.getElementById("langConf").style.display = "none";
    hiddentext.style.fontSize = '1.72em';
    hiddentext.innerHTML = "String";
});
$('#langConfN').click(function(){
    //localStorage.setItem('langConfirmation', 'No');
    //location.href = "https://xorax.ru/smartnote/roadmap/";
    document.getElementById("generalLangConf").style.display = "none";
    document.getElementById("optionsLangConf").style.display = "block";
});

$(document).ready( function() {
    if ($(window).width() < 768) {
	$('#menuLogo').removeClass('col-md-2');
	$('#menuLogo').addClass('col-md-4');
	$('#menuLogo').removeClass('col-sm-3');
	$('#menuLogo').addClass('col-sm-8');
	$('#btnLogout').removeClass('col-md-10');
	$('#btnLogout').addClass('col-md-4');
	$('#btnLogout').removeClass('col-sm-9');
        $('#btnLogout').addClass('col-sm-2');
        $('#btnLogout').removeClass('col-6');
        $('#btnLogout').addClass('col-3');

    }else{
        $('#menuLogo').removeClass('col-md-4');
        $('#menuLogo').addClass('col-md-2');
        $('#menuLogo').removeClass('col-sm-8');
        $('#menuLogo').addClass('col-sm-3');
        $('#btnLogout').removeClass('col-md-4');
        $('#btnLogout').addClass('col-md-10');
        $('#btnLogout').removeClass('col-sm-2');
        $('#btnLogout').addClass('col-sm-9');
        $('#btnLogout').removeClass('col-3');
        $('#btnLogout').addClass('col-6');
    }
//});

/**
* Navigation overlay
*/
//$(document).ready( function() {
    $('.toggleTopNavOverlay').click(function(){
        $('.toggleTopNavOverlay').toggleClass('active');
        $('.toggleMenuIcon').toggleClass('active');
        $('.topNavOverlay').toggleClass('active');
        $("body").toggleClass("hide_scroll");
    });

});

$(window).resize(function() {
    if ($(window).width() < 768) {
        $('#menuLogo').removeClass('col-md-2');
        $('#menuLogo').addClass('col-md-4');
        $('#menuLogo').removeClass('col-sm-3');
        $('#menuLogo').addClass('col-sm-8');
        $('#btnLogout').removeClass('col-md-10');
        $('#btnLogout').addClass('col-md-4');
        $('#btnLogout').removeClass('col-sm-9');
        $('#btnLogout').addClass('col-sm-2');
        $('#btnLogout').removeClass('col-6');
        $('#btnLogout').addClass('col-3');
    }else{
        $('#menuLogo').removeClass('col-md-4');
        $('#menuLogo').addClass('col-md-2');
        $('#menuLogo').removeClass('col-sm-8');
        $('#menuLogo').addClass('col-sm-3');
        $('#btnLogout').removeClass('col-md-4');
        $('#btnLogout').addClass('col-md-10');
        $('#btnLogout').removeClass('col-sm-2');
        $('#btnLogout').addClass('col-sm-9');
        $('#btnLogout').removeClass('col-3');
        $('#btnLogout').addClass('col-6');
    }
});

//console.log(langConfirmation);
//to remove from localStorage
//localStorage.removeItem("Ключ");

//to clear localStorage
//localStorage.clear();

/**
 * Cookies
 */
/*
//remove after days
var date = new Date;
date.setDate(date.getDate() - 1);
date = date.toUTCString();

//remove after hours
var expire = new Date();
expire.setHours(expire.getHours() - 4);

//add cookie
document.cookie= 'langConf=langConfY; path=/; expires='+expire+'; secure=true; domain=xorax.ru';

//show cookie
var cookies = document.cookie.split(";");
for(var i=0; i<cookies.length; i++){
    var parts = cookies[i].split("="),
        name = parts[0],
        value = parts[1];
    document.write("Имя: " + name + "Значение" + value + "<br/>");
}
*/
//console.log(document.cookie);
