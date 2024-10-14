import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useLoanStore = defineStore("loan", {
  actions: {

    async getLoan(userId) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/loan/"+userId,)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al solicitar prestamo.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getLoanById(Id) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/loan/get/"+Id,)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al solicitar prestamo.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async createLoan(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/loan", data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al solicitar prestamo.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async changeStatusLoan(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/loan/changeStatus/"+data.loan, data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al solicitar prestamo.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getApproveLoan(query) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/loan/approve/get?page="+query.page+"&search="+query.search+"&")
          .then(({ data }) => {
            if(data.code !== 200){
              throw data;
            }
            resolve(data)
          }).catch((response) => {
            console.log(response)
            resolve('Error al solicitar prestamo.');
          });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getPendingLoan(){
      return new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/loan/getloan/pending")
            .then(({ data }) => {
              if(data.code !== 200) throw data;
              resolve(data)
            }).catch((response) => {
              console.log(response)
              reject('Error al solicitar prestamo.');
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