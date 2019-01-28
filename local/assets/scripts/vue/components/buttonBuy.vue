<template>
    <div class="button" :class="[{active: active}, button.theme]" @click="toggle">
        <span class="button__text">{{buttonText}}</span>
    </div>
</template>
<script>
    import {store} from '../store';
    export default {
        props: ['initial'],
        data() {
            return {
                product: this.initial.product,
                button:  this.initial.button,
            };
        },
        store,
        computed: {
            active: function(){
                return this.product.id in this.$store.state.cart.elements;
            },
            buttonText: function () {
                let text = '';
                if(this.button.type === 'card') {
                    text = this.active ? 'В корзине' : 'В корзину';
                } else {
                    text = this.active ? 'В корзине' : 'В корзину';
                }
                return text;
            }
        },
        methods: {
            toggle (e) {
                e.preventDefault();
                e.stopPropagation();
                if(!this.active) {
                    this.$store.dispatch('cartAddItem', this.product)
                }else {
                    this.$store.dispatch('cartRemoveItem', this.product.id);
                }
            }
        }
    }
</script>
