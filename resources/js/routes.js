import CategoryRoutes from './views/categories/routes'
import ProductRoutes from './views/products/routes'
import MerchantRoutes from './views/merchants/routes'
const Home = () => import('./views/Home')

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    ...CategoryRoutes,
    ...ProductRoutes,
    ...MerchantRoutes,
];

export default routes
