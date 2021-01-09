const CategoryIndex = () => import('./Index')
const CategoryCreate = () => import('./Create')
const CategoryShow = () => import('./Show')
const CategoryEdit = () => import('./Edit')

const CategoryRoutes = [
    {
        path: '/categories',
        component: CategoryIndex,
        name: 'CategoryIndex',
    },
    {
        path: '/categories/create',
        component: CategoryCreate,
        name: 'CategoryCreate'
    },
    {
        path: '/categories/:slug',
        component: CategoryShow,
        name: 'CategoryShow'
    },
    {
        path: '/categories/:slug/edit',
        component: CategoryEdit,
        name: 'CategoryEdit'
    },
];

export default CategoryRoutes
