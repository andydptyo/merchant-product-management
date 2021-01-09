const ProductIndex = () => import('./Index')
const ProductCreate = () => import('./Create')
const ProductShow = () => import('./Show')
const ProductEdit = () => import('./Edit')

const ProductRoutes = [
    {
        path: '/products',
        component: ProductIndex,
        name: 'ProductIndex',
    },
    {
        path: '/products/create',
        component: ProductCreate,
        name: 'ProductCreate'
    },
    {
        path: '/products/:slug',
        component: ProductShow,
        name: 'ProductShow'
    },
    {
        path: '/products/:slug/edit',
        component: ProductEdit,
        name: 'ProductEdit'
    },
];

export default ProductRoutes
