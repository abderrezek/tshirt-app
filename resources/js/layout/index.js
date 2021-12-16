import React from "react";
import { usePage } from '@inertiajs/inertia-react'
import { ChakraProvider, Box, Container } from "@chakra-ui/react"

import NavBar from "./NavBar";
// import Breadcrumbs from "./Breadcrumbs";

const Index = ({ children }) => {
    const { appName, user } = usePage().props;

    return (
        <ChakraProvider>
            <Box bg="gray.50" h="100%">
                <NavBar logo={appName} userName={user.name} />

                <Container maxW="container.xl">
                    {/*<Breadcrumbs />*/}

                    <Box>{children}</Box>
                </Container>
            </Box>
        </ChakraProvider>
    );
};

export default Index;