import React, { useEffect, useState } from 'react';
import { Link as LinkInertia, usePage, Head } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { Link, Flex, Spacer, Box, Button, useToast, useDisclosure,
    InputGroup, InputLeftAddon, Input,
    Table, Thead, Tbody, Tr, Td, Th,
    IconButton, Center
} from '@chakra-ui/react';
import { AddIcon, SearchIcon, EditIcon, DeleteIcon } from '@chakra-ui/icons';

import Pagination from "../../components/Pagination.js";
import DeleteClothe from "../../components/clothes/DeleteClothe";

const Index = ({ clothes, q }) => {
    const { flash } = usePage().props;
    const toast = useToast();
    const { isOpen, onOpen, onClose, } = useDisclosure();
    const [data, setData] = useState([]);
    const [id, setId] = useState(-1);
    const [search, setSearch] = useState('');

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
        if (clothes.data) {
            setData(clothes.data);
        }
    }, [clothes.data]);

    useEffect(() => {
        setSearch(q);
    }, [q]);

    const handleSearch = (e) => {
        let searchVal = e.target.value;
        setSearch(searchVal);
        Inertia.get(
            route('admin.clothes.index'),
            { q: searchVal },
            { replace: true, preserveState: true }
        );
    };

    const handleRemove = (id) => {
        setId(id);
        onOpen();
    };

    return (
    <>
        <Head title="Clothes" />

        <Flex my={2}>
            <Box>
                <InputGroup>
                    <InputLeftAddon children={<SearchIcon />} />
                    <Input type="text" defaultValue={search} name="q" onChange={handleSearch} placeholder="Rechercher ici..." />
                </InputGroup>
            </Box>
            <Spacer />
            <Button
                as={LinkInertia}
                href={route('admin.clothes.create')}
                colorScheme="blue"
                leftIcon={<AddIcon />}
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
                                        as={LinkInertia}
                                        href={route('admin.clothes.edit', { id: item.id })}
                                        icon={<EditIcon />}
                                    />
                                    <IconButton
                                        mx={2}
                                        colorScheme="red"
                                        aria-label="remove button"
                                        size="sm"
                                        icon={<DeleteIcon />}
                                        onClick={() => handleRemove(item.id)}
                                    />
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>

                <Flex align="center" justify="center" my={3}>
                    <Pagination
                        links={clothes.links}
                        prevUrl={clothes.prev_page_url}
                        nextUrl={clothes.next_page_url}
                    />
                </Flex>
            </Box>
        ) : (
            <Center h="200px">
                il n'y a pas de données
            </Center>
        )}

        <DeleteClothe
            id={id}
            isOpen={isOpen}
            onClose={onClose}
        />
    </>
    );
};

export default Index;