import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";
import storage from "../storage";

export const useDropshippingStore = defineStore("dropshipping", {

  actions: {

    async getStadistics(user) {
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/dropshipping/stadistics/"+user)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener los datos');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        reject('Error al obtener los datos');
      });
    },

  },
  getters: {
  },
});