<template>
    <div class="navbar__menu d-lg-none" data-toggle="collapse" data-target="#sidebar-menu" @click="isToggled = !isToggled">
        <span class="navbar__menu__global navbar__menu__global--top" :class="{navbar__top_click : isToggled}"></span>
        <span class="navbar__menu__global navbar__menu__global--middle" :class="{navbar__middle_click : isToggled}"></span>
        <span class="navbar__menu__global navbar__menu__global--bottom" :class="{navbar__bottom_click : isToggled}"></span>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                isToggled: false
            }
        },
        computed: {
            compClasses: function () {
                return  {
                    isToggled: this.isToggled
                }
            }
        }
    }
</script>
<style scoped>
/*Classes that turn the menu into an "X"*/
    .navbar__top_click {
        backface-visibility: hidden;
        top:3px;
        transform: rotate(50deg);
        transition: 0.55s 0.5s;
        margin-top: 2rem;
    }
    .navbar__middle_click {
         opacity: 0;
     }
    .navbar__bottom_click {
         backface-visibility: hidden;
         top: 3px;
         transform: rotate(-410deg);
         transition: 0.55s 0.5s;
         margin-top: 2rem;
     }
</style>
