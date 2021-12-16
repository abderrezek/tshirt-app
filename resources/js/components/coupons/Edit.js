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
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    NumberIncrementStepper,
    NumberDecrementStepper,
} from '@chakra-ui/react';
import { useForm } from "@inertiajs/inertia-react";

const Edit = ({ item, isOpen, onClose }) => {
    const initialRef = React.useRef();
    const { data, setData, post, processing, errors } = useForm({
        id: 0,
        expiresAt: '0',
        reward: '0',
        quantity: '0',
    });

    useEffect(() => {
        if (item) {
            console.log(item)
            setData(prevState => ({
                id: item.id,
                expiresAt: item.nb_days_expired,
                reward: item.reward,
                quantity: item.quantity,
            }));
        }
    }, [item]);

    const handleClick = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("admin.coupons.update"), {
            onSuccess: () => onClose(),
        });
    };

    const showError = (errs) =>
        errs && <FormErrorMessage>{errs}</FormErrorMessage>;

    return (
        <Modal isOpen={isOpen} onClose={onClose} initialFocusRef={initialRef}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Modifier un coupon</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
                    {/* Id */}
                    {errors.id && showError(errors.id)}
                    {/* Reward */}
                    <FormControl id="reward" isInvalid={errors.reward} mb={2}>
                        <FormLabel>Reward</FormLabel>
                        <NumberInput
                            min={0}
                            precision={2}
                            onChange={(vS, vN) => setData('reward', vS)}
                            keepWithinRange={false}
                            clampValueOnBlur={false}
                            defaultValue={data.reward}
                            name="reward"
                        >
                            <NumberInputField />
                            <NumberInputStepper>
                                <NumberIncrementStepper />
                                <NumberDecrementStepper />
                            </NumberInputStepper>
                        </NumberInput>
                        {showError(errors.reward)}
                    </FormControl>

                    {/* Quantity */}
                    <FormControl id="quantity" isInvalid={errors.quantity} mb={2}>
                        <FormLabel>Quantite</FormLabel>
                        <NumberInput
                            min={0}
                            onChange={(vS, vN) => setData('quantity', vS)}
                            keepWithinRange={false}
                            clampValueOnBlur={false}
                            defaultValue={data.quantity}
                            name="quantity"
                        >
                            <NumberInputField />
                            <NumberInputStepper>
                                <NumberIncrementStepper />
                                <NumberDecrementStepper />
                            </NumberInputStepper>
                        </NumberInput>
                        {showError(errors.quantity)}
                    </FormControl>

                    {/* expire at */}
                    <FormControl id="expiresAt" isInvalid={errors.expiresAt}>
                        <FormLabel>Nombre des jours expirer</FormLabel>
                        <NumberInput
                            min={0}
                            onChange={(vS, vN) => setData('expiresAt', vS)}
                            keepWithinRange={false}
                            clampValueOnBlur={false}
                            defaultValue={data.expiresAt}
                            name="expiresAt"
                        >
                            <NumberInputField />
                            <NumberInputStepper>
                                <NumberIncrementStepper />
                                <NumberDecrementStepper />
                            </NumberInputStepper>
                        </NumberInput>
                        {showError(errors.expiresAt)}
                        {/*<DatePicker
                            showPopperArrow={false}
                            id="expiresAt"
                            minDate={new Date()}
                            selected={data.expiresAt}
                            onChange={(date) => setData('expiresAt', date)}
                            placeholderText="Cliquez pour sélectionner une date"
                            todayButton="Aujourd'hui"
                            dropdownMode="select"
                            peekNextMonth
                            showMonthDropdown
                            showYearDropdown
                            isClearable
                            dateFormat="dd/MM/yyyy"
                            calendarStartDay={6}
                        />*/}
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

export default Edit;