import { isLoggedIn, logOut } from "./shared/utils/auth";

export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket: {
            items: []
        },
        isLoggedIn: false,
        user: {},
        availableFilters:{
            amenities: Object,
            bathrooms: Array,
            bedrooms: Array,
            priceRanges: Array,
            propertyTypes: Object
        },
        selectedFilters:{
            amenities: [],
            bathrooms: 0,
            bedrooms: 0,
            priceRanges: 0,
            propertyTypes: 0
        },
        searchString: '',
        bookables: []
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },
        addToBasket(state, payload) {
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload) {
            state.basket.items = state.basket.items.filter(item => item.bookable.id !== payload);
        },
        setBasket(state, payload) {
            state.basket = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        },
        setAvailableFilters(state, payload){
            state.availableFilters = payload
        },
        setSelectedFilters(state, payload){
            state.selectedFilters = payload
        },
        setSearchString(state, payload){
            state.searchString = payload
        },
        setBookables(state, payload){
            state.bookables = payload
        }
    },
    actions: {
        setLastSearch(context, payload) {
            context.commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        },
        loadStoredState(context) {
            const lastSearch = localStorage.getItem('lastSearch');
            if (lastSearch) {
                context.commit('setLastSearch', JSON.parse(lastSearch));
            }

            const basket = localStorage.getItem('basket');
            if (basket) {
                context.commit('setBasket', JSON.parse(basket));
            }

            const availableFilters = localStorage.getItem('availableFilters');
            if (basket) {
                context.commit('setAvailableFilters', JSON.parse(availableFilters));
            }

            const selectedFilters = localStorage.getItem('selectedFilters');
            if (basket) {
                context.commit('setSelectedFilters', JSON.parse(selectedFilters));
            }

            const searchString = localStorage.getItem('searchString');
            if (basket) {
                context.commit('setSearchString', JSON.parse(searchString));
            }

            context.commit("setLoggedIn", isLoggedIn());
        },
        addToBasket({ commit, state }, payload) {
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },
        removeFromBasket({ commit, state }, payload) {
            commit('removeFromBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },
        clearBasket({ commit, state }, payload) {
            commit("setBasket", { items: [] });
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
        async loadUser({ commit, dispatch }) {
            if (isLoggedIn()) {
                try {
                    const user = (await axios.get("/user")).data;
                    commit("setUser", user);
                    commit("setLoggedIn", true);
                } catch (error) {
                    dispatch("logout");
                }
            }
        },
        logout({ commit }) {
            commit("setUser", {});
            commit("setLoggedIn", false);
            logOut();
        },
        setAvailableFilters({ commit, state }, payload){
            commit('setAvailableFilters', payload);
            localStorage.setItem('availableFilters', JSON.stringify(payload));
        },
        setSelectedFilters({ commit, state }, payload){
            commit('setSelectedFilters', payload);
            localStorage.setItem('selectedFilters', JSON.stringify(payload));
        },
        setSearchString({ commit, state }, payload){
            commit('setSearchString', payload);
            localStorage.setItem('searchString', JSON.stringify(payload));
        },
        setBookables({ commit, state }, payload){
            commit('setBookables', payload);
        },
    },
    getters: {
        itemsInBasket: (state) => state.basket.items.length,
        inBasketAlready(state) {
            return function (id) {
                return state.basket.items.reduce(
                    (result, item) => result || item.bookable.id === id,
                    false
                );
            }
        }
    }
};
