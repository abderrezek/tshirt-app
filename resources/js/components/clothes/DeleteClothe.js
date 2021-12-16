import React, { useEffect } from "react";
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
import { useForm } from "@inertiajs/inertia-react";

const DeleteClothe = ({ id, isOpen, onClose }) => {
    const { data, setData, delete: destroy, processing, errors } = useForm({
        id: -1
    });

    useEffect(() => {
        if (id) {
            setData('id', id);
        }
    }, [id]);

    const handleClick = (e) => {
        e.preventDefault();
        console.log(data);
        destroy(route("admin.clothes.delete", { id: data.id}), {
            onSuccess: () => onClose(),
        });
    };

    return (
        <Modal isOpen={isOpen} onClose={onClose}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Supprimer un clothe</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    Voulez-vous vraiment supprimer cette clothe ?
                </ModalBody>
                <ModalFooter>
                    <Button variant="ghost"  mr={3} onClick={onClose}>Fermer</Button>
                    <Button
                        colorScheme="red"
                        onClick={handleClick}
                        color="white"
                        _hover={{ bg: "red.300", }}
                        disabled={processing}
                        isLoading={processing}
                    >Supprimer</Button>
                </ModalFooter>
            </ModalContent>
        </Modal>
    );
};

export default DeleteClothe;