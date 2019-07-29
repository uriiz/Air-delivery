import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex)

export const store = new Vuex.Store({

    state:{
        newOffersArr:[],
        newOffersUserArr:[],
        usersArr:[],
    },
    getters:{
        getNewOffers(state){
            return state.newOffersArr
        },
        getNewOffersUser(state){
            return state.newOffersUserArr
        },
        getUsers(state){
            return state.usersArr
        },
    },

    mutations:{
        newOffers(state,offers){
            state.newOffersArr = offers
        },
        newOffersUser(state,offers){
            state.newOffersUserArr = offers
        },
        users(state,users){
            state.usersArr = users
            console.log(state.usersArr)
        },
        deleteUser(state,id){

            for(let i = 0;i<state.usersArr.length;i++){
                if(state.usersArr[i].id == id){
                    state.usersArr.splice(i,1)
                }
            }
        }
    }

})