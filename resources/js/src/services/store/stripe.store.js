import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useStripeStore = defineStore("stripe", {
  state: () => ({
    loading: false,
    error: null
  }),
  actions: {
    setLoading(loading) {
      this.loading = loading;
    },
    setError(error) {
      this.error = error;
    },
    async getSetupIntent() {
      try {
        if (JwtService.getToken()) {
          ApiService.setHeader();
        }
        
        const { data } = await ApiService.get('/api/v1/stripe/payments/setup-intent', '');
        
        if (data.code !== 200) {
          throw new Error(data.error || 'Error al obtener el setup intent');
        }
        
        return { success: true, clientSecret: data.data.client_secret };
      } catch (e) {
        const errorMessage = e.response?.data?.error || e.response?.data?.message || e.message || "Error de conexión con el servidor";
        return { success: false, error: errorMessage };
      }
    },
    async confirmPayment(stripe, elements) {
      this.setLoading(true);
      this.setError(null);

      try {
        const { error: submitError } = await elements.submit();
        
        if (submitError) {
          this.setError(submitError.message);
          this.setLoading(false);
          return { success: false, error: submitError.message };
        }

        // Confirmar el pago con Stripe
        const { error: confirmError, setupIntent } = await stripe.confirmSetup({
          elements,
          confirmParams: {
            return_url: `${window.location.origin}/checkout/success`,
          },
          redirect: 'if_required'
        });

        if (confirmError) {
          this.setError(confirmError.message);
          this.setLoading(false);
          return { success: false, error: confirmError.message };
        }

        // Si el setup intent requiere redirección, manejarlo
        if (setupIntent.status === 'requires_action') {
          this.setLoading(false);
          return { success: false, error: 'Se requiere autenticación adicional', requiresAction: true };
        }

        // Obtener el payment method del setup intent
        const paymentMethod = setupIntent.payment_method;
        
        this.setLoading(false);
        return { 
          success: true, 
          paymentMethod: paymentMethod 
        };
      } catch (e) {
        const errorMessage = e.response?.data?.error || e.response?.data?.message || e.message || "Error al procesar el pago";
        this.setError(errorMessage);
        this.setLoading(false);
        return { success: false, error: errorMessage };
      }
    },
    async finalizeSubscription(paymentMethodId, planId = null) {
      try {
        if (JwtService.getToken()) {
          ApiService.setHeader();
        }
        
        const body = {
          payment_method: paymentMethodId
        };
        
        if (planId) {
          body.plan_id = planId;
        }

        // El backend espera POST /api/v1/stripe/payments/subscribe
        const { data } = await ApiService.post('/api/v1/stripe/payments/subscribe', body);
        
        // El backend devuelve { code: 200, data: '...' } o { code: 500, error: '...' }
        if (data.code !== 200) {
          throw new Error(data.error || 'Error al crear la suscripción');
        }

        this.setLoading(false);
        return { success: true, data };
      } catch (e) {
        // El backend devuelve { code: 500, error: '...' } en caso de error
        const errorMessage = e.response?.data?.error || e.response?.data?.message || e.message || "Error al finalizar el registro.";
        this.setError(errorMessage);
        this.setLoading(false);
        return { success: false, error: errorMessage };
      }
    }
  },
  getters: {
    isLoading: (state) => state.loading,
    getError: (state) => state.error
  },
});
