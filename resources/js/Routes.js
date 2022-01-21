import Home from "./Pages/Home";
import Products from "./Pages/Products";
import QuotesIndex from "./Pages/Quotes/QuotesIndex";
import QuotesShow from "./Pages/Quotes/QuotesShow";

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
        },
        {
            path: '/quotes',
            name: 'quotes.index',
            component: QuotesIndex
        },
        {
            path: '/quotes/:id',
            name: 'quotes.show',
            component: QuotesShow
        }
    ]
}
