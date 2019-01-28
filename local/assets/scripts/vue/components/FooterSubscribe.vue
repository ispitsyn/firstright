<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" :show-message=false>
        <div class="field-group field-group_subscribe">
        <el-form-item prop="email">
            <el-input v-model="ruleForm.email" placeholder="Введите ваш e-mail"></el-input>
        </el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')" class="button button_theme_footer-subscribe">Подписаться</el-button>
        </div>
        <el-form-item prop="agree">
            <el-checkbox v-model="ruleForm.agree">Согласен с политикой конфиденциальности</el-checkbox>
        </el-form-item>
    </el-form>
</template>
<script>
    export default {
        data() {
            return {
                ruleForm: {
                    agree: [],
                    email: '',
                },
                rules: {
                    agree: [
                        { type: 'array', required: true,  trigger: 'change'}
                    ],
                    email: [
                        { required: true, message: 'Please input Activity name', trigger: 'blur'},
                    ],

                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$notify({
                            title: 'Success',
                            message: 'This is a success message',
                            position: 'bottom-right',
                            type: 'success'
                        });
                        return false;
                    } else {
                        this.$notify({
                            title: 'Warning',
                            message: 'error submit!!',
                            position: 'bottom-right',
                            type: 'warning'
                        });
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
