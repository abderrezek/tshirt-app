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
    FormErrorMessage,
    FormControl,
    FormLabel,
    Input,
} from '@chakra-ui/react';
import { useForm } from "@inertiajs/inertia-react";

const EditMarque = ({ item, isOpen, onClose }) => {
    const initialRef = React.useRef();
    const { data, setData, post, processing, errors } = useForm({
        id: 0,
        name: '',
    });

    useEffect(() => {
        if (item) {
            setData(prevState => ({
                id: item.id,
                name: item.name,
            }));
        }
    }, [item]);

    const handleClick = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("admin.marques.update"), {
            onSuccess: () => onClose(),
        });
    };

    const showError = (errs) =>
        errs && <FormErrorMessage>{errs}</FormErrorMessage>;

    return (
        <Modal isOpen={isOpen} onClose={onClose} initialFocusRef={initialRef}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Modifier un marque</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    <FormControl isInvalid={errors.name || errors.id}>
                        <FormLabel>Nom</FormLabel>
                        <Input
                            name="name"
                            ref={initialRef}
                            placeholder="Nom"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                        />
                        {showError(errors.name)}
                        {showError(errors.id)}
                    </FormControl>
                </ModalBody>

                <ModalFooter>
                    <Button variant="ghost"  mr={3} onClick={onClose}>Fermer</Button>
                    <Button
                        colorScheme="teal"
                        onClick={handleClick}
                        color="white"
                        _hover={{ bg: "teal.300", }}
                        disabled={processing}
                        isLoading={processing}
                    >Modifier</Button>
                </ModalFooter>
            </ModalContent>
        </Modal>
    );
};

export default EditMarque;