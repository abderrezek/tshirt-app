import React, { useState } from "react";
import {
  Box,
  Flex,
  Avatar,
  HStack,
  Link,
  IconButton,
  Button,
  Menu,
  MenuButton,
  MenuList,
  MenuItem,
  MenuDivider,
  useDisclosure,
  useColorModeValue,
  Stack,
} from '@chakra-ui/react';
import { HamburgerIcon, CloseIcon, AddIcon } from '@chakra-ui/icons';

import NavLink from './NavLink';
import ModalLogout from "../components/ModalLogout";

const Links = [
    {
      key: 1,
      href: route('admin.index'),
      name: 'Tableau de bord',
    },
    {
      key: 2,
      href: route('admin.clothes.index'),
      name: 'Clothes',
    },
    {
      key: 3,
      href: route('admin.marques.index'),
      name: 'Marques',
    },
    {
      key : 4,
      href: route('admin.coupons.index'),
      name: 'Coupons',
    }
];

const NavBar = ({ logo, userName }) => {
  const [type, setType] = useState('');
  const { isOpen, onOpen, onClose } = useDisclosure();

  const handleLogout = (e) => {
    setType('logout');
    onOpen();
  };

  const handleMenu = (e) => {
    setType('');
    onOpen();
  };

  return (
    <>
      <Box bg={useColorModeValue('gray.700', 'gray.900')} mb={4} px={4}>
        <Flex h={16} alignItems={'center'} justifyContent={'space-between'}>
          <IconButton
            size={'md'}
            icon={isOpen ? <CloseIcon /> : <HamburgerIcon />}
            aria-label={'Open Menu'}
            display={{ md: 'none' }}
            onClick={isOpen ? onClose : handleMenu}
          />

          <HStack spacing={8} alignItems={'center'}>
            <Box color="gray.50">{logo}</Box>
            <HStack
              as={'nav'}
              spacing={4}
              display={{ base: 'none', md: 'flex' }}>
              {Links.map(({ key, href, name }) => (
                <NavLink key={key} href={href}>{name}</NavLink>
              ))}
            </HStack>
          </HStack>

          <Flex alignItems={'center'}>
            <Link color="gray.50" href={route('site.boutique')} isExternal>
              Accueil
            </Link>

            <Menu>
              <MenuButton
                as={Button}
                rounded={'full'}
                variant={'link'}
                cursor={'pointer'}
                ml={2}
                minW={0}>
                {userName}
              </MenuButton>
              <MenuList>
                <MenuItem>Link 1</MenuItem>
                <MenuDivider />
                <MenuItem onClick={handleLogout}>Se déconnecter</MenuItem>
              </MenuList>
            </Menu>
          </Flex>
        </Flex>

        {isOpen && type !== 'logout' ? (
          <Box pb={4} display={{ md: 'none' }}>
            <Stack as={'nav'} spacing={4}>
              {Links.map(({ key, href, name }) => (
                <NavLink key={key} href={href}>{name}</NavLink>
              ))}
            </Stack>
          </Box>
        ) : null}
      </Box>

      <ModalLogout
        isOpen={isOpen && type === 'logout'}
        onClose={onClose}
      />
    </>
  );
};

export default NavBar;