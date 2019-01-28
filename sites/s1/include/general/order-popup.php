<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<el-dialog :title="callBackForm.name" lock-scroll :visible.sync="dialogTableVisible" fullscreen custom-class="order-form" @open="openOrderForm" @close="closeOrderForm">
    <form class="order-form__form">
        <el-row :gutter="10">
            <el-col :span="12">
                <el-input placeholder="Ваше имя" name="name" v-model="orderForm.name"></el-input>
            </el-col>
            <el-col :span="12">
                <el-input placeholder="Ваш телефон" name="phone" v-model="orderForm.phone"></el-input>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :span="24">
                <el-input type="textarea" name="comment" v-model="orderForm.comment"
                          placeholder="По желанию оставте комментарий"></el-input>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :span="24">
                <el-checkbox v-model="orderForm.agree" name="agree">Я согласен на обработку моих персональных данных</el-checkbox>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :span="24">
                <div class="order-form__btn">
                    <div class="btn btn_order-form waves-effect"><span>Оформить заказ</span></div>
                </div>
            </el-col>
        </el-row>
    </form>
</el-dialog>