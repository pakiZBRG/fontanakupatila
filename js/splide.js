document.addEventListener('DOMContentLoaded', function () {
    new Splide('#elektromaterijal', {
        rewind: true,
        autoplay: true,
        interval: 5000,
        cover   : true,
        height  : '40rem',
        lazyLoad: 'nearby'
    }).mount();

    new Splide('#keramika', {
        rewind: true,
        autoplay: true,
        interval: 5000,
        cover   : true,
        height  : '40rem',
        lazyLoad: 'nearby'
    }).mount();
});