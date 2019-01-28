<template>
    <table class="cart">
        <thead>
        <tr>
            <th></th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="element in elements" :key="element.id">
            <td><img :src=element.image :alt=element.name></td>
            <td><p>{{element.name}}</p>
                <p class="cart__mark">
                    <span class="cart__mark-name">Комплект: </span>
                    <span class="cart__mark-value">Стандартный комплект</span>
                </p>
            </td>
            <td><span class="b-price">{{element.price}}</span></td>
            <td>
                <div class="field-group_quantity">
                    <div class="button button_theme_quantity" @click="decrement(element.id)"><span class="button__text">-</span></div>
                    <input class="field" :value=element.quantity type="text"/>
                    <div class="button button_theme_quantity" @click="increment(element.id)"><span class="button__text">+</span></div>
                </div>
            </td>
            <td><span class="b-price">{{element.price*element.quantity}}</span></td>
            <td>
                <div class="cart__close" @click="remove(element.id)">
                    <svg class="svg-icon">
                        <use xlink:href="#close"></use>
                    </svg>
                </div>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">
                <div class="cart__footer">
                    <div class="cart__promo">
                        <div class="field-group field-group_callback"><input class="field" type="mail"
                                                                             name="email"
                                                                             placeholder="Введите промокод"/>
                            <div class="button button_theme_footer-subscribe"><span class="button__text">Применить</span>
                            </div>
                        </div>
                    </div>
                    <div class="cart__cost"><span class="b-price">279 980</span></div>
                    <div class="cart__buy">
                        <div class="button button_theme_product-detail"><span class="button__text">Оформить заказ</span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tfoot>
    </table>
</template>
<script>
    import { mapState } from 'vuex';
    import {store} from '../store';
    export default {
        data() {
            return {}
        },
        store,
        computed: mapState({
            elements: state => state.cart.elements,
            count() {
                return this.$store.getters.count;
            }
        }),
        methods: {
            increment: function(id) {
                this.$store.commit('cartItemIncrement', id)
            },
            decrement: function(id) {
                if(this.elements[id].quantity > 1)
                    this.$store.commit('cartItemDecrement', id)
            },
            remove: function (id) {
                this.$store.dispatch('cartRemoveItem', id)
            }
        }
    }
</script>
