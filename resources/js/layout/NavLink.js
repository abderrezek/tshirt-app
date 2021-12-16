import React from "react";
import { Link as LinkInertia } from '@inertiajs/inertia-react';
import { Link, useColorModeValue } from '@chakra-ui/react';

const NavLink = ({ href='#', children }) => (
  <Link
    as={LinkInertia}
    px={2}
    py={1}
    color="gray.50"
    rounded={'md'}
    _hover={{
      textDecoration: 'none',
      bg: useColorModeValue('gray.100', 'gray.700'),
    }}
    href={href}>
    {children}
  </Link>
);

export default NavLink;