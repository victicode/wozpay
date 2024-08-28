import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useUserStore = defineStore("user", {
  actions: {
    async updateUser(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("api/user/u/"+data.id, data)
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
    async sendMobileCode(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("api/user/sendPhoneCode", data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch(({response}) => {
              console.log(response)
              resolve('Error al enviar codigo');
            });
        }
      })
      .catch(({response}) => {
        console.log(response)
        resolve('Error al enviar codigo');
      });
    },
    async verifyMobileCode(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("api/user/verifyPhoneCode", data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              console.log(data)
              resolve(data)
            }).catch(({response}) => {
              console.log(response)
              resolve('Error al validar codigo');
            });
        }
      })
      .catch(({response}) => {
        console.log(response)
        resolve('Error al validar codigo');
      });
    },
    async getUserByWallet(wallet) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("api/wallet/"+ wallet)
            .then(({ data }) => {
              if(data.code !== 200) throw data; 
              
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al conseguir wallet.');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getAllUser(query) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/all?page="+query.page+"&search="+query.search+"&")
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },
    async getUserById(userID) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/get/"+userID)
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },
    async setUserStatus(data) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/user/set-status/"+data.user, data)
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },
    async deleteUser(userID) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/user/delete/"+userID)
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },
    async restoreUser(userID) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/user/restore/"+userID)
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },
    async getUserWithLoan(query) {
      return await new Promise((resolve) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/loan/?page="+query.page+"&search="+query.search+"&")
            .then(( { data } ) => {
                // console.log(data)
                resolve(data);
                
            })
            .catch(( { response } ) => {
                console.log(response )
                reject('Ocurrió un error desconocido al intentar obtener los usuarios');
            });
        }
      })
    },


  },
  getters: {
  },
});