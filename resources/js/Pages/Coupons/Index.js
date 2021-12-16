import React, { useEffect, useState } from 'react';
import { Link as LinkInertia, usePage, Head } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { Link, Flex, Spacer, Box, Button, Spinner, IconButton, useDisclosure,
    useToast, InputGroup, InputLeftAddon, Input, Center,
  Table,
  Thead,
  Tbody,
  Tfoot,
  Tr,
  Th,
  Td, } from '@chakra-ui/react';
import { AddIcon, DeleteIcon, EditIcon, SearchIcon, LockIcon, } from '@chakra-ui/icons';

import AddCoupon from "../../components/coupons/Add";
import EditCoupon from "../../components/coupons/Edit";
import DeleteCoupon from "../../components/coupons/Delete";
import DeleteAllCoupon from "../../components/coupons/DeleteAll";
import Pagination from "../../components/Pagination";
import Search from "../../components/coupons/Search";

const Index = ({ coupons, q }) => {
    const { flash } = usePage().props;
    const toast = useToast();
    const { isOpen, onOpen, onClose, } = useDisclosure();
    const [data, setData] = useState([]);
    const [search, setSearch] = useState('');
    const [item, setItem] = useState({
        id: -1,
        nb_days_expired: '0',
        reward: '0',
        quantity: '0',
    });
    const [type, setType] = useState('');

    useEffect(() => {
        if (flash.type) {
            toast({
                title: flash.message,
                status: false.type,
                variant: 'left-accent',
                position: 'top-right',
                duration: 5000,
                isClosable: true,
            });
            flash.type = null;
        }
    }, [flash.type]);

    useEffect(() => {
        if (coupons.data) {
            setData(coupons.data);
        }
    }, [coupons.data]);
console.log(data)
    useEffect(() => {
        setSearch(q);
    }, [q]);

    const handleAdd = (e) => {
        setType('add');
        onOpen();
    };

    const handleEdit = ({ id, nb_days_expired, reward, quantity }) => {
        setType('edit');
        setItem({ id, nb_days_expired, reward, quantity, });
        onOpen();
    };

    const handleRemove = ({ code, }) => {
        setType('remove');
        setItem({ code, });
        onOpen();
    };

    const handleSearch = (e) => {
        let searchVal = e.target.value;
        setSearch(searchVal);
        Inertia.get(
            route('admin.coupons.index'),
            { q: searchVal },
            { replace: true, preserveState: true }
        );
    };

    const handleDelete = () => {
        setType('removeAll');
        onOpen();
    };

    return (
    <>
        <Head title="Coupons" />

        <Flex my={2}>
            <Box>
                <InputGroup>
                    <InputLeftAddon children={<SearchIcon />} />
                    <Input type="text" defaultValue={search} name="q" onChange={handleSearch} placeholder="Rechercher ici..." />
                </InputGroup>
            </Box>
            <Spacer />
            <Button
                colorScheme="red"
                leftIcon={<DeleteIcon />}
                onClick={handleDelete}
                mr={2}
            >
                supprimer inutilisé
            </Button>
            <Button
                colorScheme="blue"
                leftIcon={<AddIcon />}
                onClick={handleAdd}
            >
                Créer un nouveau
            </Button>
        </Flex>

        {data.length > 0 ? (
            <Box>
                <Table variant="striped" colorScheme="blue">
                    <Thead>
                        <Tr>
                            <Th isNumeric>#</Th>
                            <Th>Coupon</Th>
                            <Th>Quantité</Th>
                            <Th>Récompense</Th>
                            <Th>Expire à</Th>
                            <Th>Active</Th>
                            <Th>Action</Th>
                        </Tr>
                    </Thead>

                    <Tbody>
                        {data.map((item, i) => (
                            <Tr key={i}>
                                <Td>{i + 1}</Td>
                                <Td>{item.code}</Td>
                                <Td>{item.quantity}</Td>
                                <Td>{`${item.reward} DZD`}</Td>
                                <Td>{item.expires_at}</Td>
                                <Td><Box w={5} h={5}>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
    {item.isActive ? (
  <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
      ) : (
  <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd" />
      )}
</svg>
                                </Box></Td>
                                <Td>
                                    <IconButton
                                        colorScheme="teal"
                                        aria-label="edit button"
                                        size="sm"
                                        icon={<EditIcon />}
                                        onClick={() => handleEdit(item)}
                                    />
                                    <IconButton
                                        mx={2}
                                        colorScheme="blue"
                                        aria-label="remove button"
                                        size="sm"
                                        icon={<LockIcon />}
                                        onClick={() => handleRemove(item)}
                                    />
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>

                <Flex align="center" justify="center" my={3}>
                    <Pagination
                        links={coupons.links}
                        prevUrl={coupons.prev_page_url}
                        nextUrl={coupons.next_page_url}
                    />
                </Flex>
            </Box>
        ) : (
            <Center h="200px">il n'y a pas de données</Center>
        )}

        {type === 'edit' ? (
            <EditCoupon
                item={item}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : type === 'remove' ? (
            <DeleteCoupon
                item={item}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : type === 'removeAll' ? (
            <DeleteAllCoupon
                item={item}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : type === 'add' ? (
            <AddCoupon
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : null}
    </>
    );
};

export default Index;