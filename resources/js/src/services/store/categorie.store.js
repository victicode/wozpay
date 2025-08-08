import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";

export const useCategorieStore = defineStore("categorie", {
  state: () => ({
   
  }),
  actions: {
    async getAllCategorie() {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/categories/")
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener las categorias');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getAllCategorieToSelect() {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/categories/all/input")
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener las categorias');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async getMostProlifict(quantity = 5) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/categories/mostprolifict?quantity="+quantity+"&")
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al obtener las categorias');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        return 'Error al actualizar datos';
      });
    },
    async storeCategorie(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/categories", data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
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
    async massiveCreate(data) {
      return await new Promise((resolve) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/categories/massive", data)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
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