<template>
  <div class="bg-white" style="height: 100vh;">
    <div style="height: 100%; overflow: auto;" class="flex flex-center column">
      <!-- Header -->

      <!-- Main Content -->
      <div class="content-container flex flex-center column">
        <!-- Icon -->
        <q-icon name="eva-clock-outline" size="6rem" color="terciary" class="q-mb-lg" />
        
        <!-- Title -->
        <div class="text-h5 text-weight-medium text-grey-9 q-mb-md text-center">
          Orden de retiro creada
        </div>

        <!-- Message -->
        <div class="text-body1 text-grey-7 text-center q-mb-md message-text">
          Tu orden está en espera de aprobación.<br>
          El proceso puede tardar entre <strong>24 a 72 horas hábiles</strong>.
        </div>

        <!-- Steps with Details -->
        <div class="steps-container q-mb-xl">
          <div class="step-item">
            <div class="step-number">1</div>
            <div class="step-content">
              <div class="step-title">Revisión administrativa</div>
              <div class="step-description">Nuestro equipo revisará tu solicitud y verificará los datos de tu cuenta bancaria.</div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-number">2</div>
            <div class="step-content">
              <div class="step-title">Aprobación</div>
              <div class="step-description">Una vez revisada, se aprobará tu solicitud y se procederá con el procesamiento del retiro.</div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-number">3</div>
            <div class="step-content">
              <div class="step-title">Transferencia</div>
              <div class="step-description">El dinero será transferido a tu cuenta bancaria registrada. Recibirás una notificación cuando se complete.</div>
            </div>
          </div>
        </div>

        <!-- Action Button -->
        <q-btn 
          unelevated 
          no-caps 
          color="primary" 
          class="action-button"
          @click="router.push('/dashboard')"
        >
          Volver al inicio
        </q-btn>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useQuasar } from 'quasar';
import { onMounted } from 'vue';

const router = useRouter();
const $q = useQuasar();

onMounted(() => {
  $q.addressbarColor.set('#0449fb');
});
</script>

<style lang="scss" scoped>
.header-container {
  position: absolute;
  top: 1rem;
  left: 1rem;
  z-index: 1;
}

.content-container {
  padding: 2rem 1.5rem;
  max-width: 450px;
  width: 100%;
}

.message-text {
  line-height: 1.6;
  max-width: 320px;
}

.action-button {
  width: 100%;
  max-width: 280px;
  padding: 0.75rem;
  font-size: 1rem;
  font-weight: 500;
}

.steps-container {
  width: 100%;
  max-width: 400px;
}

.step-item {
  display: flex;
  align-items: flex-start;
  padding: 1rem 0;
  border-bottom: 1px solid #f0f0f0;
  
  &:last-child {
    border-bottom: none;
  }
}

.step-number {
  width: 1.75rem;
  height: 1.75rem;
  border-radius: 50%;
  background: #0449fb;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 500;
  margin-right: 1rem;
  flex-shrink: 0;
  margin-top: 0.125rem;
}

.step-content {
  flex: 1;
}

.step-title {
  font-size: 0.95rem;
  font-weight: 500;
  color: #333;
  margin-bottom: 0.25rem;
  text-transform: capitalize;
}

.step-description {
  font-size: 0.85rem;
  color: #666;
  line-height: 1.5;
}

@media screen and (max-width: 780px) {
  .content-container {
    padding: 1.5rem 1rem;
  }
  
  .text-h5 {
    font-size: 1.25rem;
  }
  
  .steps-container {
    max-width: 100%;
  }
}
</style>
