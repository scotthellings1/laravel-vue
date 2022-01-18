import Home from "./Pages/Home";
import Products from "./Pages/Products";

export default {
    mode:'history',
    linkActiveClass: "nav-link-active",
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
