import React, { useState } from "react";
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
import { Inertia } from "@inertiajs/inertia";

const DeleteAll = ({ isOpen, onClose }) => {
    const [loading, setLoading] = useState(false);

    const handleClick = (e) => {
        setLoading(true);
        e.preventDefault();
        Inertia.delete(route('admin.coupons.deleteAll'), {
            onSuccess: () => {
                setLoading(false);
                onClose();
            }
        });
    };

    return (
        <Modal isOpen={isOpen} onClose={onClose}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Supprimer des coupons inutilisé</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    Voulez-vous vraiment supprimer ces coupons inutilisé ?
                </ModalBody>
                <ModalFooter>
                    <Button variant="ghost"  mr={3} onClick={onClose}>Fermer</Button>
                    <Button
                        colorScheme="red"
                        onClick={handleClick}
                        color="white"
                        _hover={{ bg: "red.300", }}
                        disabled={loading}
                        isLoading={loading}
                    >Supprimer</Button>
                </ModalFooter>
            </ModalContent>
        </Modal>
    );
};

export default DeleteAll;