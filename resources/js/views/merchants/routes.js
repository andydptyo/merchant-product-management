const MerchantIndex = () => import('./Index')
const MerchantCreate = () => import('./Create')
const MerchantShow = () => import('./Show')
const MerchantEdit = () => import('./Edit')

const MerchantRoutes = [
    {
        path: '/merchants',
        component: MerchantIndex,
        name: 'MerchantIndex',
    },
    {
        path: '/merchants/create',
        component: MerchantCreate,
        name: 'MerchantCreate'
    },
    {
        path: '/merchants/:slug',
        component: MerchantShow,
        name: 'MerchantShow'
    },
    {
        path: '/merchants/:slug/edit',
        component: MerchantEdit,
        name: 'MerchantEdit'
    },
];

export default MerchantRoutes
