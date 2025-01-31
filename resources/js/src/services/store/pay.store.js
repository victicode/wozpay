import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const usePayStore = defineStore("pay", {
  actions: {
    async payRequest(body) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/pay/get_url", body)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al actualizar datos');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async createPay(body) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/pay", body)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              resolve(response.response);
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async changeStatus(body) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/pay/change-status/"+body.id, body)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              resolve(response.response);
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getPendingPays(count){
      return new Promise((resolve, reject ) => {
        if(JwtService.getToken()){
          ApiService.setHeader()
          ApiService.get("/api/pay/pays_pending"+ (count ?'?count=1':''))
          .then(({data}) => {
            if(data.code !== 200){
              throw data;
            }
            resolve(data)
          }).catch((response) => {
            console.log(response)
            reject(response)
          })
        }
      }).catch((response) => {
        console.log(response)
        return 'Error al obtener pagos pendientes';
      });
    },
    async getPayById(id){
      return new Promise((resolve, reject ) => {
        if(JwtService.getToken()){
          ApiService.setHeader()
          ApiService.get("/api/pay/byId/"+id)
          .then(({data}) => {
            if(data.code !== 200){
              throw data;
            }
            resolve(data)
          }).catch((response) => {
            console.log(response)
            reject(response)
          })
        }
      }).catch((response) => {
        console.log(response)
        return 'Error al obtener pagos pendientes';
      });
    },
    getDataTransfer(){
      return [
        'SUDAMERIS BANK',
        'CUENTA CORRIENTE',
        'ALIAS BANCARIO',
        '0983994268'
      ]
    }

  },
  getters: {
  },
});