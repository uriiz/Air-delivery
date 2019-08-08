import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex)

export const store = new Vuex.Store({

    state:{
        newOffersArr:[],
        newConfirmOffersArr:[],
        newOffersUserArr:[],
        usersArr:[],
    },
    getters:{
        getNewOffers(state){
            return state.newOffersArr
        },
        getNewConfirmOffers(state){
            return state.newConfirmOffersArr
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
        newConfirmOffers(state,offers){
            state.newConfirmOffersArr = offers
        },
        newOffersUser(state,offers){
            state.newOffersUserArr = offers
        },
        users(state,users){
            state.usersArr = users
        },
        deleteUser(state,id){

            for(let i = 0;i<state.usersArr.length;i++){
                if(state.usersArr[i].id == id){
                    state.usersArr.splice(i,1)
                }
            }
        },
        deleteOffer(state,id){
            for(let i = 0;i<state.newConfirmOffersArr.length;i++){
                if(state.newConfirmOffersArr[i].response_id == id){
                    state.newConfirmOffersArr.splice(i,1)
                }
            }
        },

        deleteAppOffer(state,id){

            for(let i = 0;i<state.newOffersArr.length;i++){
                if(state.newOffersArr[i].id == id){
                    state.newOffersArr.splice(i,1)
                }
            }
        },
    }

})