$(document).ready(function () {
    var boxslide = $('#slide');
    var ul = $('#slide .sl-items'), li = $('#slide .sl-item'), img = $('slide .sl-items .sl-item img');
    var itemh = 380, itemw = 100;
    var size = $('#slide .sl-items .sl-item').size();
    var next = $('#next'), prev = $('#prev');
    var num = 0, interval;

    function slide() {
        num = num + 1;
        if (num === size) {
            ul.animate({'margin-left': '0%'}, 1000, function () {
            });
            num = 0;
        } else {
            ul.animate({'margin-left': '-=' + itemw + '%'}, 1000, function () {
            });
        }
    }
    interval = setInterval(slide, 6000);
    boxslide.mouseenter(function () {
        clearInterval(interval);
    });
    boxslide.mouseleave(function () {
        interval = setInterval(slide, 6000);
    });
    next.click(function () {
        slide();
        return false;
    });
    prev.click(function () {
        num = num - 1;
        var margin = (1 - size) * itemw;
        if (num === -1) {
            ul.animate({'margin-left': margin + '%'}, 1000, function () {
            });
            num = size - 1;
        } else {
            ul.animate({'margin-left': '+=' + itemw + '%'}, 1000, function () {
            });
        }
    });
});


