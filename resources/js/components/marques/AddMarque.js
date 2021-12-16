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
    FormErrorMessage,
    FormControl,
    FormLabel,
    Input,
} from '@chakra-ui/react';
import { useForm } from "@inertiajs/inertia-react";

const AddMarque = ({ create, isOpen, onClose }) => {
    const initialRef = React.useRef();
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        create: create,
    });

    const handleClick = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("admin.marques.store"), {
            onSuccess: () => onClose(),
        });
    };

    const showError = (errs) =>
        errs && <FormErrorMessage>{errs}</FormErrorMessage>;

    return (
        <Modal isOpen={isOpen} onClose={onClose} initialFocusRef={initialRef}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Ajouter un nouveau marque</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    <FormControl isInvalid={errors.name}>
                        <FormLabel>Nom</FormLabel>
                        <Input
                            name="name"
                            ref={initialRef}
                            placeholder="Nom"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                        />
                        {showError(errors.name)}
                    </FormControl>
                </ModalBody>

                <ModalFooter>
                    <Button variant="ghost"  mr={3} onClick={onClose}>Fermer</Button>
                    <Button
                        colorScheme="blue"
                        onClick={handleClick}
                        color="white"
                        _hover={{ bg: "blue.300", }}
                        disabled={processing}
                        isLoading={processing}
                    >Ajouter</Button>
                </ModalFooter>
            </ModalContent>
        </Modal>
    );
};

export default AddMarque;