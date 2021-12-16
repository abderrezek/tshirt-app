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
import { AddIcon, DeleteIcon, EditIcon, SearchIcon, } from '@chakra-ui/icons';

import AddMarque from "../../components/marques/AddMarque";
import EditMarque from "../../components/marques/EditMarque";
import DeleteMarque from "../../components/marques/DeleteMarque";
import Pagination from "../../components/Pagination";
import Search from "../../components/marques/Search";

const Index = ({ marques, q }) => {
    const { flash } = usePage().props;
    const toast = useToast();
    const { isOpen, onOpen, onClose, } = useDisclosure();
    const [data, setData] = useState([]);
    const [search, setSearch] = useState('');
    const [item, setItem] = useState({
        id: -1,
        name: '',
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
        if (marques.data) {
            setData(marques.data);
        }
    }, [marques.data]);

    useEffect(() => {
        setSearch(q);
    }, [q]);

    const handleAdd = (e) => {
        setType('add');
        onOpen();
    };

    const handleEdit = ({ id, name }) => {
        setType('edit');
        setItem({ id, name, });
        onOpen();
    };

    const handleRemove = ({ id, name }) => {
        setType('remove');
        setItem({ id, name, });
        onOpen();
    };

    const handleSearch = (e) => {
        let searchVal = e.target.value;
        setSearch(searchVal);
        Inertia.get(
            route('admin.marques.index'),
            { q: searchVal },
            { replace: true, preserveState: true }
        );
    };

    return (
    <>
        <Head title="Marques" />

        <Flex my={2}>
            <Box>
                <InputGroup>
                    <InputLeftAddon children={<SearchIcon />} />
                    <Input type="text" defaultValue={search} name="q" onChange={handleSearch} placeholder="Rechercher ici..." />
                </InputGroup>
            </Box>
            <Spacer />
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
                            <Th>Nom</Th>
                            <Th>Action</Th>
                        </Tr>
                    </Thead>

                    <Tbody>
                        {data.map((item, i) => (
                            <Tr key={i}>
                                <Td>{i + 1}</Td>
                                <Td>{item.name}</Td>
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
                                        colorScheme="red"
                                        aria-label="remove button"
                                        size="sm"
                                        icon={<DeleteIcon />}
                                        onClick={() => handleRemove(item)}
                                    />
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>

                <Flex align="center" justify="center" my={3}>
                    <Pagination
                        links={marques.links}
                        prevUrl={marques.prev_page_url}
                        nextUrl={marques.next_page_url}
                    />
                </Flex>
            </Box>
        ) : (
            <Center h="200px">
                il n'y a pas de données
            </Center>
        )}

        {type === 'edit' ? (
            <EditMarque
                item={item}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : type === 'remove' ? (
            <DeleteMarque
                item={item}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : type === 'add' ? (
            <AddMarque
                create={false}
                isOpen={isOpen}
                onClose={onClose}
            />
        ) : null}
    </>
    );
};

export default Index;