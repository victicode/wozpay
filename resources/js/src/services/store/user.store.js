import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useUserStore = defineStore("user", {
  state: () => ({
    stateList: 1,
  }),
  actions: {
    setStateList(state){
      this.stateList = state;
    },
    async updateUser(data) {
      return await new Promise((resolve, reject) => {
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
        reject('Error al actualizar datos');
      });
    },
    async setKyc(data) {
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/user/kyc", data)
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
        reject('Error al actualizar datos');
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
      return await new Promise((resolve, reject) => {
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
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("api/wallet/"+ wallet)
            .then(({ data }) => {
              if(data.code !== 200) throw data; 
              
              resolve(data)
            }).catch(({response}) => {
              console.log(response)
              resolve(response.data.error);
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getAllUser(query) {
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/all?page="+query.page+"&search="+query.search+"&"+"type="+query.typeOfUser+"&")
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
      return await new Promise((resolve, reject) => {
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
      return await new Promise((resolve, reject) => {
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
      return await new Promise((resolve, reject) => {
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
      return await new Promise((resolve, reject) => {
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
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/loan?page="+query.page+"&search="+query.search+"&")
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
    async getCleanUser(query) {
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/cleanUser?page="+query.page+"&search="+query.search+"&")
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
    async getSlowPayerUser (query) {
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/slowPayer?page="+query.page+"&search="+query.search+"&")
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
    async getUsersBySearch (query) {
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/getBySearch?search="+query+"&")
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
    async getUsersByPaidPending (query) {
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/user/payPendigs?page="+query.page+"&search="+query.search+"&")
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
    async setVerifyStatus(data){
      return await new Promise((resolve, reject) => {
        if(JwtService.getToken()){
          ApiService.setHeader()
          ApiService.post('/api/user/setNewVerifyStatus', data)
          .then(({data}) => {
            resolve(data)
          })
          .catch(( { response } ) => {
            console.log(response )
            reject('Ocurrió un error al actualizar el status de verificación');
          });
        }
      })
    }

  },
  getters: {
  },
});