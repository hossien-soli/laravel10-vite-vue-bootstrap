<template>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">
                        <i class="mdi mdi-account-plus mdi-24px"></i> ثبت نام در وبلاگ
                    </h4>

                    <form @submit.prevent="formSubmit">
                        <div class="mb-3">
                            <label for="registerFullName" class="form-label">نام کامل</label>
                            <input v-model="fullName" type="text" id="registerFullName" class="form-control" maxlength="30" placeholder="نام کامل خود را وارد کنید ...">
                        </div>

                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">آدرس ایمیل</label>
                            <input v-model="email" type="text" id="registerEmail" class="form-control" maxlength="50" placeholder="یک آدرس ایمیل معتبر وارد کنید ...">
                        </div>

                        <div class="mb-3">
                            <label for="registerUsername" class="form-label">نام کاربری</label>
                            <input v-model="username" type="text" id="registerUsername" class="form-control" maxlength="20" placeholder="یک نام کاربری برای حساب خود وارد کنید ...">
                        </div>

                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">رمز عبور</label>
                            <input v-model="password" type="password" id="registerPassword" class="form-control" maxlength="30" placeholder="یک رمز عبور برای حساب خود وارد کنید ...">
                        </div>

                        <div class="mb-3">
                            <label for="registerConfirmPassword" class="form-label">تکرار رمز عبور</label>
                            <input v-model="passwordConfirm" type="password" id="registerConfirmPassword" class="form-control" maxlength="30" placeholder="تکرار رمز عبور را وارد کنید ...">
                        </div>

                        <button class="btn btn-primary w-100" type="submit">
                            <i class="mdi mdi-check-bold"></i> تایید و ثبت نام
                        </button>
                    </form>

                    <hr>

                    <div>
                        قبلا ثبت نام کرده اید؟
                        <router-link class="link-offset-3 link-opacity-75-hover" :to="{name: 'auth.login'}">
                            <i class="mdi mdi-login-variant"></i> ورود به حساب کاربری
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementById('registerFullName').focus();
    },

    data() {
        return {
            fullName: '',
            email: '',
            username: '',
            password: '',
            passwordConfirm: '',
        };
    },

    methods: {
        formSubmit() {
            let fullName = this.fullName.trim();
            let email = this.email.trim();
            let username = this.username.trim();
            let password = this.password.trim();
            let passwordConfirm = this.passwordConfirm.trim();
            let validate = fullName && email && username && password && passwordConfirm;
            if (!validate) {
                let key = '';
                let id = '';
                if (!fullName) {
                    key = 'نام کامل';
                    id = 'registerFullName';
                }
                else if (!email) {
                    key = 'آدرس ایمیل';
                    id = 'registerEmail';
                }
                else if (!username) {
                    key = 'نام کاربری';
                    id = 'registerUsername';
                }
                else if (!password) {
                    key = 'رمز عبور';
                    id = 'registerPassword';
                }
                else if (!passwordConfirm) {
                    key = 'تکرار رمز عبور';
                    id = 'registerConfirmPassword';
                }
                Swal.fire({
                    icon: 'warning',
                    text: 'لطفا ' + key + ' را وارد کنید!',
                }).then(() => {
                    setTimeout(() => {
                        document.getElementById(id).focus();
                    },270);
                });
                return;
            }

            if (password != passwordConfirm) {
                Swal.fire({
                    icon: 'warning',
                    text: 'رمز عبور با تکرار آن مطابقت ندارد!',
                });
                return;
            }

            email = email.toLowerCase();
            username = username.toLowerCase();


        },
    },
};
</script>
