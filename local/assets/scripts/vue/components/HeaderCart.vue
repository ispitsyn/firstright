<template>
    <el-popover
            placement="bottom-end"
            title="Корзина:"
            width="400"
            popper-class="cart-header"
            trigger="hover">
            <ul class="cart-header__list">
                <li class="cart-header__item" v-for="element in elements">
                    <div class="product-header" data-id="element.id" :key="element.id">
                        <div class="product-header__view">
                            <img :src=element.image :alt=element.title class="product-header__image">
                        </div>
                        <div class="product-header__info">
                            <div class="product-header__name">{{element.name}}</div>
                            <div class="product-header__price-box">
                                <span class="product-header__price b-price">{{element.price}}</span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <a href="/cart/" class="header-cart" slot="reference">
                <svg class="svg-icon"><use xlink:href="#cart"></use></svg>
                <div class="header-cart__count"><span v-if="count">{{count}}</span></div>
            </a>
    </el-popover>
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
        mounted() {
            this.$store.dispatch('cartGet');
        }
    }
</script>
