import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useTransactionStore = defineStore("transaction", {
  actions: {

    async allTransactionByUser(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/transaction/all/"+data.user+'?page='+data.page+'&search='+data.search+'&month='+data.month+'&year='+data.year+'&')
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener datos.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getTrasactionByData(TransactionType, TransactionId, isPublic = false) {
      const url = isPublic ? '/api/transaction/byType/' : '/api/transaction-public/byType/'
      return await new Promise((resolve) => {
        if (!isPublic) {
          if(!JwtService.getToken()) throw ''
          ApiService.setHeader();
        }
        ApiService.get(url+TransactionType+'/'+TransactionId)
          .then(({ data }) => {
            if(data.code !== 200){
              throw data;
            }
            resolve(data)
          }).catch((response) => {
            console.log(response)
            resolve('Error al solicitar prestamo.');
          });
        
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