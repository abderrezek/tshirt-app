import React from "react";
import { Link } from '@inertiajs/inertia-react';;
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
} from "@chakra-ui/react"

const Home = [
    {
        title: 'Tableau de bord',
        link: route('admin.index'),

    }
];

// const BreadCrumbItem = (title, href, isCurrentPage) => (
//     <BreadcrumbItem as={Link} to={href} isCurrentPage={isCurrentPage}>
//         <BreadcrumbLink>{title}</BreadcrumbLink>
//     </BreadcrumbItem>
// );

const Breadcrumbs = () => {
    // let url = window.location.href;
    // if (route('admin.index') === url) {
    //     return (
    //     <Breadcrumb>
    //         {/*<BreadCrumbItem title="Tableau de bord" href={route('admin.index')} isCurrentPage />*/}
    //         <BreadcrumbItem  isCurrentPage>
    //             <BreadcrumbLink>Tableau de bord</BreadcrumbLink>
    //         </BreadcrumbItem>
    //     </Breadcrumb>
    //     );
    // }
    return <div>Breadcrumb</div>;
};

export default Breadcrumbs;