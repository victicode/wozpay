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

  },
  getters: {
  },
});