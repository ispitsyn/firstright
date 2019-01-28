import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import qs from 'qs';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        cart: {
            elements: {}
        }
    },
    getters: {
        count: state => {
            let count = 0;
            for (let element in state.cart.elements) {
                count += state.cart.elements[element]['quantity'];
            }
            return count;
        }
    },
    mutations: {
        cartItemIncrement: (state, id) => {
            state.cart.elements[id].quantity++;
        },
        cartItemDecrement: (state, id) => {
            state.cart.elements[id].quantity--;
        },
        productCartAdd: (state, {id, element}) => {
            Vue.set(state.cart.elements, id, element);
        },
        productCartRemove: (state, id) => {
            Vue.delete(state.cart.elements,id);
        },

    },
    actions: {
            cartGet: ({commit, state}) => {
                axios.post('/.ajax/cart.php', qs.stringify({actionType: "getCart"}))
                    .then(response => {
                        let elements = response.data.elements;
                        for(let key in elements) {
                            let element = {id: key, element: elements[key]};
                            commit('productCartAdd', element)
                        }
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            cartClear: () => {},
            cartAddItem: ({commit, state}, product) => {
                axios.post('/.ajax/cart.php', qs.stringify({actionType: 'addItem', product: {id: product.id,quantity: 1}}))
                    .then(response => {
                        if(response.data.type === 'ok') {
                            product.cartId = response.data.id;
                            let element = {id: product.id, element: product};
                            commit('productCartAdd', element)
                        } else {

                        }
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            cartRemoveItem: function({commit, state}, productId) {
                let cartId = state.cart.elements[productId].cartId;
                axios.post('/.ajax/cart.php', qs.stringify({actionType: 'removeItem', product: {id: cartId}}))
                    .then(response => {
                        if(response.data.type === 'ok') {
                            commit('productCartRemove', productId)
                        } else {

                        }
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            cartChangeItem: () => {},

        /*checkout ({ commit, state }, products) {
            // сохраним находящиеся на данный момент в корзине товары
            const savedCartItems = [...state.cart.added];
            // инициируем запрос и "оптимистично" очистим корзину
            commit(types.CHECKOUT_REQUEST);
            // предположим, что API магазина позволяет передать коллбэки
            // для обработки успеха и неудачи при формировании заказа
            shop.buyProducts(
                products,
                // обработка успешного исхода
                () => commit(types.CHECKOUT_SUCCESS),
                // обработка неудачного исхода
                () => commit(types.CHECKOUT_FAILURE, savedCartItems)
            )
        }*/
    },
});
