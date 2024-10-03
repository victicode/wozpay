import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useWalletStore = defineStore("wallet", {
  state: () => ({
    balances: null
  }),
  actions: {
    setBalances(balances){
      this.balances = balances;
    },
    async getBalancesByUser(user) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/balance/"+user)
          .then(({ data }) => {
            if(data.code !== 200){
              throw data;
            }
            this.setBalances(data.data)
            resolve(data)
          }).catch((response) => {
            console.log(response)
            resolve('Error al obtener.');
          });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async incrementsWalletAdmin(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/balance/increments/"+data.user, data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              // this.setBalances(data.data)
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al sumar saldo');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async setNewAdminCapital(amount) {
      return new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/balance/admin", amount)
          .then(({ data }) => {
            if(data.code !== 200){
              throw data;
            }
            this.setBalances(data.data)
            resolve(data)
          }).catch((response) => {
            console.log(response)
            resolve('Error al obtener.');
          });
        }
      }).catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    }

  },
  getters: {
  },
});