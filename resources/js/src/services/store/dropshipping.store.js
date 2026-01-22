import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";
import storage from "../storage";

export const useDropshippingStore = defineStore("dropshipping", {
    state: () => ({
      plans: [
        {
          id: 1,
          name: "Plan Gratuito / Free",
          type: "Gratis",
          annual: {
              price: 'Gratis',
              annualSavings: '',
              description: "Ideal para iniciar",
              features: [
                  "Cuenta básica en Gs",
                  "Hasta 5 links o QR por mes",
                  "Hasta 300.000 Gs por link o QR",
                  "Hasta 1.500.000 Gs/mes en trans.",
                  "Comisión por trans. del 10% + IVA",
                  "Solo retiros manuales",
                  "1 Retiro por mes"
              ],
          },
          monthly: {
              price: 'Gratis',
              annualSavings: '',
              description: "Ideal para iniciar",
              features: [
                  "Cuenta básica en Gs",
                  "Hasta 5 links o QR por mes",
                  "Hasta 300.000 Gs por link o QR",
                  "Hasta 1.500.000 Gs/mes en trans.",
                  "Comisión por trans. del 10% + IVA",
                  "Solo retiros manuales",
                  "1 Retiro por mes"
              ],
          },
        },
        {
          id: 2,
          name: "Principiante",
          type: "Basico",
          annual: {
              price: 2500000,
              annualSavings: 938000,
              description: "Ideal para principiantes",
              features: [
                  "Cuenta básica en Gs",
                  "Hasta 10 links o QR por mes",
                  "Hasta 700.000 Gs por link o QR",
                  "Hasta 7.000.000 Gs/mes en trans.",
                  "Comisión por trans. del 15% + IVA",
                  "Desembolso día lunes",
              ],
          },
          monthly: {
              price: 99000,
              description: "Ideal para principiantes",
              features: [
                  "Cuenta básica en Gs",
                  "Hasta 10 links o QR por mes",
                  "Hasta 700.000 Gs por link o QR",
                  "Hasta 7.000.000 Gs/mes en trans.",
                  "Comisión por trans. del 15% + IVA",
                  "Desembolso día lunes",
              ],
          },
        },
        {
          id: 3,
          name: "Emprendedor regular",
          type: "Regular",
          annual: {
              price: 600000,
              annualSavings: 1800000,
              description: "Ideal para emprendedores regulares",
              features: [
                  "Cuenta corriente en USD",
                  "Hasta 30 links por mes",
                  "Hasta 30 QR por mes",
                  "Gs - USD - EUR",
                  "Hasta 1.000 USD por link o QR",
                  "Hasta 30.000 USD/mes en trans.",
                  "Comisión por trans. del 6,5% + IVA",
                  "Préstamo hasta Gs. 200.000.000",
                  "Proceso de acreditación 48hs",
                  "Desembolso al instante",
              ],
          },
          monthly: {
              price: 200000,
              description: "Para negocios en crecimiento",
              features: [
                  "Cuenta corriente en USD",
                  "Hasta 30 links por mes",
                  "Hasta 30 QR por mes",
                  "Gs - USD - EUR",
                  "Hasta 1.000 USD por link o QR",
                  "Hasta 30.000 USD/mes en trans.",
                  "Comisión por trans. del 6,5% + IVA",
                  "Préstamo hasta Gs. 200.000.000",
                  "Proceso de acreditación 48hs",
                  "Desembolso al instante",
              ],
          },
        },
        {
          id: 4,
          name: "Emprendedor Business",
          type: "Profesional",
          annual: {
              price: 850000,
              annualSavings: 2700000,
              description: "Para empresas establecidas",
              features: [
                  "Cuenta corriente en USD",
                  "Tarjeta de crédito - 2.000 USD",
                  "Links & QR ilimitados",
                  "+200 monedas",
                  "Hasta 10.000 USD por link o QR",
                  "Hasta 500.000 USD/mes en trans.",
                  "Comisión por trans. del 3,9% + IVA",
                  "Préstamo a sola firma Gs. 600.000.000",
                  "Proceso de acreditación 24hs",
                  "Desembolso al instante",
                  "Multi-dispositivos",
                  "Ejecutivo de cuentas asignado",
                  "Boton de pago API Woz Pay",
              ],
          },
          monthly: {
              price: 350000,
              description: "Ideal para emprendedores establecidos",
              features: [
                  "Cuenta corriente en USD",
                  "Tarjeta de crédito - 2.000 USD",
                  "Links & QR ilimitados",
                  "+200 monedas",
                  "Hasta 10.000 USD por link o QR",
                  "Hasta 500.000 USD/mes en trans.",
                  "Comisión por trans. del 3,9% + IVA",
                  "Préstamo a sola firma Gs. 600.000.000",
                  "Proceso de acreditación 24hs",
                  "Desembolso al instante",
                  "Multi-dispositivos",
                  "Ejecutivo de cuentas asignado",
                  "Boton de pago API Woz Pay",
              ],
          },
        },
      ],
    }),
    actions: {
        async getStadistics(user) {
            return await new Promise((resolve, reject) => {
                if (JwtService.getToken()) {
                    ApiService.setHeader();
                    ApiService.get("/api/dropshipping/stadistics/" + user)
                        .then(({ data }) => {
                            if (data.code !== 200) {
                                throw data;
                            }
                            resolve(data);
                        })
                        .catch((response) => {
                            console.log(response);
                            resolve("Error al obtener los datos");
                        });
                }
            }).catch((response) => {
                console.log(response);
                reject("Error al obtener los datos");
            });
        },
        getSelectPlan(id, type) {
          const selectedPlan = this.plans.filter((plan) => plan.id == id);
          return {
            id: selectedPlan.id,
            name: selectedPlan.name,
            type: selectedPlan.type,
            paymentType: selectedPlan[type],
            price: selectedPlan[type].price,
          };

        }
    },
    getters: {},
});