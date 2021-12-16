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
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    NumberIncrementStepper,
    NumberDecrementStepper,
} from '@chakra-ui/react';
import { useForm } from "@inertiajs/inertia-react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

const Add = ({ isOpen, onClose }) => {
    const initialRef = React.useRef();
    const { data, setData, post, processing, errors } = useForm({
        expiresAt: '0',
        reward: '0',
        quantity: '0',
    });

    const handleClick = (e) => {
        e.preventDefault();
        console.log('data: ', data);
        post(route("admin.coupons.store"), {
            onSuccess: () => onClose(),
        });
    };

    const showError = (errs) =>
        errs && <FormErrorMessage>{errs}</FormErrorMessage>;

    return (
        <Modal isOpen={isOpen} onClose={onClose} initialFocusRef={initialRef}>
            <ModalOverlay />
            <ModalContent>
                <ModalHeader>Ajouter un nouveau coupon</ModalHeader>
                <ModalCloseButton />
                <ModalBody>
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

                    {/* Expire at */}
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

export default Add;