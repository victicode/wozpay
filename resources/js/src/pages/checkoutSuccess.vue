<template>
    <div class="content_all">
        <div>
            hola
        </div>
        <div class="overlay">
            <div class="container_overlay flex-center">
                <div>
                    <q-icon name="eva-checkmark-circle-2" size="15rem" color="white" class="doneIcon" />
                </div>
                <div class="text-up">
                    Pago exitoso
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { storeToRefs } from 'pinia';
import { inject, onMounted, ref, watch } from 'vue';
import { useAuthStore } from '../services/store/auth.store';
import { useRoute, useRouter } from 'vue-router';
import { usePayStore } from '@/services/store/pay.store';

export default {
    setup() {
        const { user } = storeToRefs(useAuthStore());
        const router = useRouter();
        const loading = ref(true);
        const payStore = usePayStore();
        const route = useRoute();
        const getPayByTrx = () => {
            payStore.getPayByTrx(route.query.trx)
                .then((response) => {
                    console.log(response.data)
                })
        }

        onMounted(() => {
            getPayByTrx()
            console.log(user.value.plan_id)
        })
    },
}

</script>

<style lang="scss">
.overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
}

.content_all {
    background: red;
    height: 100vh;
}

.container_overlay {
    display: flex;
    flex-direction: column;
    background: #19cd15;
    width: 100%;
    height: 100%;

}

.text-up {
    font-size: 2rem;
    color: white;
    font-weight: 500;
}

.doneIcon {
    animation: doneAppear 1.7s forwards;
}

@media screen and (max-width: 780px) {
    .doneLoan .q-dialog__inner--minimized>div {
        max-width: 100% !important;
    }
}

@keyframes doneAppear {
    0% {
        transform: rotate(360deg) scale(0.2);
    }

    70% {
        transform: rotate(0deg) scale(1);
    }

    80% {
        transform: translateY(-20%);
    }

    100% {
        transform: translateY(0%);
    }
}
</style>