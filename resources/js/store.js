import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex)

export const store = new Vuex.Store({

    state:{
        newOffersArr:[],
    },
    getters:{
        getNewOffers(state){
            return state.newOffersArr
        },
    },

    mutations:{
        newOffers(state,offers){
            state.newOffersArr = offers
        },
    }

})