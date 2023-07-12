<template>
    <div class="text-center mb-md-4 mb-3">
        <router-link :to="{name: 'auth.login'}" data-bs-toggle="tooltip" data-bs-title="ورود به حساب کاربری" class="btn mx-md-2 mx-1 btn-outline-primary">
            <i class="mdi mdi-login-variant mdi-24px"></i>
        </router-link>

        <router-link :to="{name: 'auth.register'}" data-bs-toggle="tooltip" data-bs-title="ثبت نام" class="btn mx-md-2 mx-1 btn-outline-primary">
            <i class="mdi mdi-account-plus-outline mdi-24px"></i>
        </router-link>

        <router-link :to="{name: 'auth.password'}" data-bs-toggle="tooltip" data-bs-title="بازنشانی رمز عبور" class="btn mx-md-2 mx-1 btn-outline-primary">
            <i class="mdi mdi-key-outline mdi-24px"></i>
        </router-link>
    </div>

    <router-view></router-view>
</template>

<script>
export default {
    mounted() {
        activeBootstrapTooltips();
    },
};
</script>
