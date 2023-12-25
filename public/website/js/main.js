// custom header select box
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "header-select":*/
x = document.getElementsByClassName("header-select");
l = x.length;
for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function (e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
//end selec option


// $('.home-hero-carousel').flickity({
//     // options
//     cellAlign: 'left',
//     contain: true,
//     imagesLoaded: true,
//     arrowShape: { 
//         x0: 5,
//         x1: 55, y1: 50,
//         x2: 75, y2: 45,
//         x3: 50
//     },
//     pageDots: false,
//     autoPlay: 1500
// });

//replace svg
$(function () {  
    jQuery("img.svg").each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr("id");
        var imgClass = $img.attr("class");
        var imgURL = $img.attr("src");

        jQuery.get(
            imgURL,
            function (data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find("svg");

                // Add replaced image's ID to the new SVG
                if (typeof imgID !== "undefined") {
                    $svg = $svg.attr("id", imgID);
                }
                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== "undefined") {
                    $svg = $svg.attr("class", imgClass + " replaced-svg");
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr("xmlns:a");

                // Replace image with new SVG
                $img.replaceWith($svg);
            },
            "xml"
        );
    });
})

//hero carousel
$('.hero-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: false,
    imagesLoaded: true,
    autoPlay: 4000,
    wrapAround: true
});

//story carousel
$('.story-carousel').flickity({
    // options
    cellAlign: 'center',
    contain: true,
    pageDots: false,
    imagesLoaded: true,
    prevNextButtons: false,
    wrapAround: true
});

//hero product carousel
$('.hero-product-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: true,
    imagesLoaded: true
});

//testimonial carousel
$('.testimonial-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: false,
    imagesLoaded: true,
    wrapAround: true
});

//client carousel
$('.client-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: false,
    imagesLoaded: true,
    wrapAround: true
});

//register banner carousel
$('.register-banner-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    pageDots: true,
    imagesLoaded: true,
    wrapAround: true,
    prevNextButtons: false,
    autoPlay: 3000
});

// news trend entry carousel
$(function () {  
    $('.trend-entry-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        wrapAround: true,
        prevNextButtons: false,
        fade: true
    });
    // previous
    $('.entry-arrow-btn .prev-btn').on('click', function () {
        $('.trend-entry-carousel').flickity('previous');
    });
    // next
    $('.entry-arrow-btn .next-btn').on('click', function () {
        $('.trend-entry-carousel').flickity('next');
    });
})


//featured-news-carousel
$(function () {  
    $('.featured-news-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        imagesLoaded: true,
        wrapAround: true,
        prevNextButtons: false
    });
    // previous
    $('.featured-news .entry-arrow-btn .prev-btn').on('click', function () {
        $(this).parents('.title').siblings('.featured-news-carousel').flickity('previous');
    });
    // next
    $('.featured-news .entry-arrow-btn .next-btn').on('click', function () {
        $(this).parents('.title').siblings('.featured-news-carousel').flickity('next');
    });
})

//featured-news-carousel fluid
$(function () {  
    $('.featured-news-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        imagesLoaded: true,
        wrapAround: true,
        prevNextButtons: false
    });
    // previous
    $('.featured-news-fluid .entry-arrow-btn .prev-btn').on('click', function () {
        $(this).parents('.title').siblings('.featured-news-carousel').flickity('previous');
    });
    // next
    $('.featured-news-fluid .entry-arrow-btn .next-btn').on('click', function () {
        $(this).parents('.title').siblings('.featured-news-carousel').flickity('next');
    });
})

//mobile menu
$(function () {  
    $('header .hamburger-icon').on('click', function () {  
        $('.overlay').addClass('show');
        $('.mobile-nav').addClass('active');
    })
    $('.overlay, .close-btn').on('click', function () {  
        $('.overlay').removeClass('show');
        $('.mobile-nav').removeClass('active');
    })

    //news
    $('.header-news .news-hamburger-icon').on('click', function () {  
        $('.overlay').addClass('show');
        $('.news-mobile-nav').addClass('active');
    })
    $('.news-close-icon').on('click', function () { 
        console.log('as') 
        $('.overlay').removeClass('show');
        $('.news-mobile-nav').removeClass('active');
    })
})

// news search dropdown
$(function () {
    var $win = $(window); 
    var $box = $(".news-search-icon");

    $win.on("click.Bst", function (event) {
        if (
            $box.has(event.target).length == 0 //checks if descendants of $box was clicked
            &&
            !$box.is(event.target) //checks if the $box itself was clicked
        ) {
            $('.news-search-icon .dropdown-header-search').removeClass('active');
        } else {
            $('.news-search-icon .dropdown-header-search').addClass('active');
        }
    });
})


//mobile-menu dropdown
$(function () {  
    $('.nav-lv2-wrap .head-name').on('click', function () {  
        $('.nav-lv2-wrap .nav__lv2').slideToggle();
        $('.nav-lv2-wrap .head-name img').toggleClass('active')
    })
})

// lastest news tab
$(function () {
    $('.latest-news .title__list li').on('click', function () {
        let anchor = $(this).attr('data-tab');

        $('.latest-news .title__list li').removeClass('active');
        $(this).addClass('active');

        $('.latest-news .news-grid').removeClass('active');
        $(this).parents('.left__title').siblings('.tab-content-wrap').find(('#' + anchor)).addClass('active')
    });
})

//discovery news tab
$(function () {
    $('.discovery-news .title__list li').on('click', function () {
        let anchor = $(this).attr('data-tab');

        $('.discovery-news .title__list li').removeClass('active');
        $(this).addClass('active');

        $('.discovery-news .featured-news-carousel').removeClass('active');
        $(this).parents('.news-container').find(('#' + anchor)).addClass('active')

        //flickity
        $('.featured-news-carousel').flickity()
        // trigger resize method after showing
        $('.featured-news-carousel').flickity('resize');
    });
})


// news detail tab
$(function () {
    $('.discovery-news .title__large ').on('click', function () {
        let anchor = $(this).attr('data-tab');

        $('.discovery-news .title__large').removeClass('active');
        $(this).addClass('active');

        $('.discovery-news .featured-news-carousel').removeClass('active');
        $(this).parents('.news-container').find(('#' + anchor)).addClass('active')

        //flickity
        $('.featured-news-carousel').flickity()
        // trigger resize method after showing
        $('.featured-news-carousel').flickity('resize');
    });
})

// scroll a bit to fixed
if ($('.header-menu').length) {
    let newsHeaderFixed = $('.header-news .header-menu').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= newsHeaderFixed) {
            $('.header-news .header-menu').css({
                position: 'fixed',
                top: '0',
                left: '0',
                width: '100%',
                zIndex: '9999'
            });
        } else {
            $('.header-news .header-menu').css({
                position: 'static'
            });
        }
    });
}

//set bg with data
$(function () {  
    $(".data-bg").each(function () {
        var attr = $(this).attr("data-bg-src");

        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css("background", "url(" + attr + ")");
        }
    });
})

$(function () {  
    $(".config-slider .slider1")
    .slider({
        max: 5,
        value: 1,
        range: "max",
    })
    .slider("pips", {
        first: "pip",
        last: "pip"
    });
})

// animation
AOS.init();