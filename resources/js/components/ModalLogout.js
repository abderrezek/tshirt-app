import React from "react";
import {
    Button,
    Modal,
    ModalOverlay,
    ModalContent,
    ModalHeader,
    ModalFooter,
    ModalBody,
    ModalCloseButton,
} from '@chakra-ui/react';
import { Link, usePage } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

const ModalLogout = ({ isOpen, onClose }) => {
    const { csrfToken } = usePage().props;

    const handleClick = (e) => {
        e.preventDefault();
        Inertia.post(route('logout'), {
            _token: csrfToken,
            _method: 'POST',
            isAdminUrl: true,
        });
    };

    return (
        <Modal isOpen={isOpen} onClose={onClose}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Supprimer un marque</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    {/*{errors && errors.map((err, i) => <p key={i}>{err}</p>)}*/}
                    Voulez-vous vraiment quitter ?
                </ModalBody>
                <ModalFooter>
                    <Button variant="ghost" mr={3} onClick={onClose}>Fermer</Button>
                    <Button
                        colorScheme="red"
                        onClick={handleClick}
                        color="white"
                        _hover={{ bg: "red.300", }}
                        // disabled={processing}
                        // isLoading={processing}
                    >Quitter</Button>
                </ModalFooter>
            </ModalContent>
        </Modal>
    );
};

export default ModalLogout;