import { defineStore } from "pinia";
import ApiService from "@/services/axios/";
import JwtService from "@/services/jwt/";
import storage from "@/services/storage";

export const useUserStore = defineStore("user", {
  actions: {
    async updateUser(data) {
      return await new Promise((resolve) => {
        ApiService.post("api/user/", data)
          .then(({ data }) => {
            if(!data.data.access_token){
              throw data;
            }
            resolve(data)
          })
          .catch(({ response }) => {
            console.log(response.data.error)
            resolve(response.data.error);
          });
      })
    },
  },
  getters: {
  },
});