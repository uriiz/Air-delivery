import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex)

export const store = new Vuex.Store({

    state:{
        newOffersArr:[],
        newOffersUserArr:[],
    },
    getters:{
        getNewOffers(state){
            return state.newOffersArr
        },
        getNewOffersUser(state){
            return state.newOffersUserArr
        },
    },

    mutations:{
        newOffers(state,offers){
            state.newOffersArr = offers
        },
        newOffersUser(state,offers){
            state.newOffersUserArr = offers
            console.log(state.newOffersUserArr)
        },
    }

})