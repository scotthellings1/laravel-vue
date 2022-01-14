import Home from "./Pages/Home";
import Products from "./Pages/Products";

export default {
    mode:'history',

    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/products',
            component: Products
        }
    ]
}
