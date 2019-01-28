import 'es6-promise/auto';
import Vue from 'vue';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en';
import vueInvoker from '../util/vueInvoker';
import vueCollection from '../vue/collection';

export default {
    init() {
        Vue.use(ElementUI, {locale});
        // JavaScript to be fired on all pages
        vueInvoker.init(Vue, vueCollection);
        BX.addCustomEvent('onAjaxSuccess', function(){
            vueInvoker.init(Vue, vueCollection);
        });
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
