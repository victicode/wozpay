import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";
import storage from "../storage";

export const useCoinStore = defineStore("coin", {
  state: () => ({
    coinCurrent: {},
  }),
  actions: {
    setCoin(state){
      this.coinCurrent = state;
      storage.setItem('coin', state.id)
    },
    async getCoins() {
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/coins")
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
    async getCoinById(id, current = false) {
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.get("/api/coins/getById/"+id)
            .then(({ data }) => {
              if(data.code !== 200){
                throw data;
              }
              if(current) this.setCoin(data.data)
              resolve(data)
            }).catch((response) => {
              console.log(response)
              resolve('Error al actualizar datos');
            });
        }
      })
      .catch((response) => {
        console.log(response)
        reject('Error al buscar los datos');
      });
    },
    async updateCoin(data) {
      console.log(data)
      return await new Promise((resolve, reject) => {
        if (JwtService.getToken()) {
          ApiService.setHeader();
          ApiService.post("/api/coins/update/"+data.id, data)
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
    }
  },
  getters: {
  },
});