import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const usePackageStore = defineStore("packages", {
  actions: {
    async getPackages() {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/package")
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener datos');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al obtener datos';
      });
    },
    async getPackageById(id) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/package/byId/"+id)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener datos');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al obtener datos';
      });
    },


  },
  getters: {
  },
});