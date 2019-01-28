/**
 * Здесь определяется коллекция Vue компонентов для модуля vueInvoker
 * Помимо "статичных" компонентов возможна также загрузка динамических "по требованию"
 *
 * import StaticComponent from './components/StaticComponent'
 * export default {
 *  StaticComponent,
 *  DynamicComponent: () => import('./components/DynamicComponent.vue')
 * };
 *
 */

import HeaderCart from './components/HeaderCart.vue';
import cart from './components/cart.vue';
import buttonBuy from './components/buttonBuy.vue';
import FooterSubscribe from './components/FooterSubscribe.vue';

export default {
    HeaderCart,
    cart,
    buttonBuy,
    FooterSubscribe
};
