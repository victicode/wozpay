import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useNotificationStore = defineStore("notification", {
  actions: {
    async getAllNotificationByUser(userId) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/notifications/"+userId)
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
    async seeAllNotificationByUser(userId) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/notifications/seeAll/"+userId)
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
    async storeNotification(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/notifications", data)
          .then(({ data }) => {
            if(data.code !== 200){
              throw data;
            }
            resolve(data)
          }).catch(({response}) => {
            console.log(response)
            resolve('Error al crear y enviar la notificacion');
          });
        }
      })
      .catch(({response}) => {
        console.log(response)
        resolve('Error al crear y enviar la notificacion');
      });
    },
  },
  getters: {
  },
});