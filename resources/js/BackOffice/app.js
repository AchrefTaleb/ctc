require('./bootstrap');
require('./plugins/loader');
//require('./plugins/assets/perfect-scrollbar/perfect-scrollbar.min');

import App from './plugins/app'


$(document).ready(function() {
    App.init();
});

require('./plugins/custom');

