var config = {
    map: {
        '*': {
            'fancybox': 'js/jquery.fancybox/jquery.fancybox.pack',
            'owlcarousel': 'js/owl.carousel',
            'unveil': 'js/jquery.unveil',
            'bootstrap':'js/bootstrap/bootstrap.bundle.min.js',
            'popper': 'js/bootstrap/popper',
            'slick': 'js/slick'
        }
    },
    deps: [
        "js/bootstrap/bootstrap.bundle.min",
        "js/owl.carousel",
        "js/main"
    ],
    paths: {
            'bootstrap':'Magento_Theme/js/bootstrap/bootstrap.bundle',
    } ,
    shim: {
        'popper': {
            'deps': ['jquery'],
            'exports': 'Popper'
        },
        'bootstrap': {
            'deps': ['jquery', 'popper']
        }
    }
};