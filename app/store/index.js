export const state = () => ({
    products:             null,
    customers:            null,
    productTotal:         0
})

export const actions = {
    ACTION_LOAD_PRODUCTS({commit,getters},params){
        if(!getters.products){
            let page = (params.page === undefined) ? 1 : params.page;
            let p = `?page=${page}`;
            if(params.keyword !== undefined){
                p += `&q=${params.keyword}`
            }

            if(params.sortBy !== undefined && params.sortDesc !== undefined){
                const sort = (params.sortDesc) ? 'DESC' : 'ASC';
                p += `&orderBy=${params.sortBy}&sortType=${sort}`
            }
            this.$axios.$get(`http://localhost/api/products${p}`)
            .then((result) => {
                if(result.total > 0){
                    commit('SET_PRODUCT',result);
                }else{
                    commit('SET_PRODUCT',[])
                }
            }).catch(() => {
                commit('SET_PRODUCT',[]);
            });
            
        }

    },
    GetCustomer(){}
}

export const mutations = {
    SET_PRODUCT(state,val){
        state.products = val.data;
        state.productTotal = val.total;
    }
}

export const getters = {
    getProducts: (state) => state.products,
    getProductTotal: (state) => state.productTotal,

}

