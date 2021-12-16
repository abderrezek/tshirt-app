import React, { useEffect, useState } from "react";
import { useForm, Head } from "@inertiajs/inertia-react";
import {
    FormControl,
    FormLabel,
    FormErrorMessage,
    Input,
    Button,
    Flex,
    Box,
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    NumberIncrementStepper,
    NumberDecrementStepper,
    Textarea,
    Select,
    IconButton,
    InputGroup,
    InputRightAddon,
    Grid,
    Checkbox,
    CheckboxGroup,
    Stack,
    Wrap,
    WrapItem,
    Tooltip,
    useBoolean,
    useDisclosure,
} from "@chakra-ui/react";
import { AddIcon, DownloadIcon, CloseIcon } from '@chakra-ui/icons';
import { SketchPicker } from 'react-color';

import AddMarque from "../../components/marques/AddMarque";
import UploadImage from "../../components/UploadImage";

const SIZES = ['Toutes', 'xs', 's', 'm', 'l', 'xl', 'xxl'];
const SIZE_ADD_ICON = {w: 30, h: 30};
const SIZE_DEL_ICON = {w: 15, h: 15};
const SIZE_COLOR = {w: 50, h: 50};

const Create = ({ marques }) => {
    const [showIconRemove, setShowIconRemove] = useState(-1);
    const [colorPicker, setColorPicker] = useBoolean();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { data, setData, post, processing, errors } = useForm({
        marque: -1,
        name: "",
        qte: 0,
        size: [false, false, false, false, false, false, false],
        color: [],
        price: 0,
        isSolde: false,
        solde: 0,
        description: "",
        image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("admin.clothes.store"));
    };

    const showError = (errs) =>
        errs && <FormErrorMessage>{errs}</FormErrorMessage>;

    const sizeChange = (e, i) => {
        if (i === 0) {
            data.size = data.size.map(s => e.target.checked);
            setData('size', data.size);
        } else {
            let arrSize = [ ...data.size ];
            if (data.size[0]) {
                arrSize[0] = false;
            }
            arrSize[i] = e.target.checked;
            setData('size', arrSize);
        }
    };

    const changeColor = (color, e) => {
        let exist = false;
        let colors = data.color;
        for (var i = 0; i < colors.length; i++) {
            if (colors[i] === color.hex) {
                exist = true;
            }
        }
        if (!exist) {
            setData('color', [ ...colors, color.hex ]);
            setColorPicker.off();
            // setDisplayColorPicker(false);
        } else {
            alert('color exist');
        }
    };

    const hadnleSupprimerColor = (color) => {
        let colors = data.color.filter((clr) => clr !== color);
        setData('color', colors);
    };

    const handleMouseEnter = (i) => setShowIconRemove(i);

    const handleMouseLeave = () => setShowIconRemove(-1);

    return (
    <>
        <Head title="Ajouter un nouveau clothe" />

        <form onSubmit={handleSubmit}>
            <Box py={4} px={3} boxShadow="base" bg="white">
                <Grid templateColumns="repeat(2, 1fr)" gap={6}>
                    <Box w="100%">
                        {/* Marque */}
                        <FormControl id="mark" isInvalid={errors.marque} mb={3}>
                            <FormLabel>Marque</FormLabel>
                            <InputGroup>
                                <Select
                                    name="marque"
                                    placeholder="Sélectionner la marque"
                                    onChange={(e) => setData('marque', e.target.value)}
                                    value={data.marque}
                                >
                                    {marques.length > 0 && marques.map((marq, i) => (
                                        <option key={i} value={marq.id}>{marq.name}</option>
                                    ))}
                                </Select>
                                <InputRightAddon cursor="pointer" onClick={onOpen} children={<AddIcon />} />
                            </InputGroup>
                            {showError(errors.marque)}
                        </FormControl>

                        {/* Name */}
                        <FormControl id="name" isInvalid={errors.name}>
                            <FormLabel>Nom</FormLabel>
                            <Input
                                placeholder="Nom"
                                name="name"
                                value={data.name}
                                onChange={(e) => setData("name", e.target.value)}
                            />
                            {showError(errors.name)}
                        </FormControl>

                        {/* qte */}
                        <FormControl id="qte" my={3} isInvalid={errors.qte}>
                            <FormLabel>Quantite</FormLabel>
                            <NumberInput
                                min={0}
                                max={100000000000000}
                                name="qte"
                                defaultValue={data.qte}
                                onChange={(vString, vNumber) => setData("qte", vNumber)}
                                isRequired
                            >
                                <NumberInputField />
                                <NumberInputStepper>
                                    <NumberIncrementStepper />
                                    <NumberDecrementStepper />
                                </NumberInputStepper>
                            </NumberInput>
                            {showError(errors.qte)}
                        </FormControl>

                        {/* prix */}
                        <FormControl id="price" my={3} isInvalid={errors.price}>
                            <FormLabel>Prix</FormLabel>
                            <NumberInput
                                precision={2}
                                min={0}
                                max={100000000000000}
                                name="price"
                                defaultValue={data.price}
                                onChange={(vString, vNumber) => setData("price", vNumber)}
                                isRequired
                            >
                                <NumberInputField />
                                <NumberInputStepper>
                                    <NumberIncrementStepper />
                                    <NumberDecrementStepper />
                                </NumberInputStepper>
                            </NumberInput>
                            {showError(errors.price)}
                        </FormControl>

                        {/* is solder */}
                        <Checkbox
                            name="isSolde"
                            isChecked={data.isSolde}
                            isInvalid={errors.isSolde}
                            onChange={(e) => setData('isSolde', e.target.checked)}
                        >
                            is sale ?
                        </Checkbox>
                        {/* solde */}
                        <FormControl id="solde" my={3} isDisabled={!data.isSolde} isInvalid={errors.solde}>
                            <FormLabel >Sale</FormLabel>
                            <NumberInput
                                precision={2}
                                min={0}
                                max={100000000000000}
                                isDisabled={!data.isSolde}
                                name="solde"
                                defaultValue={data.solde}
                                onChange={(vString, vNumber) => setData("solde", vNumber)}
                                isRequired
                            >
                                <NumberInputField />
                                <NumberInputStepper>
                                    <NumberIncrementStepper />
                                    <NumberDecrementStepper />
                                </NumberInputStepper>
                            </NumberInput>
                            {showError(errors.solde)}
                        </FormControl>

                        {/* description */}
                        <FormControl id="description" my={3} isInvalid={errors.description}>
                            <Textarea
                                name="description"
                                value={data.description}
                                onChange={(e) => setData('description', e.target.value)}
                                placeholder="description"
                            />
                            {showError(errors.description)}
                        </FormControl>
                    </Box>

                    <Box w="100%">
                        {/* image */}
                        <FormControl mb={3} w="100%" h="280px" isInvalid={errors.image}>
                            <UploadImage setData={setData} />
                            {showError(errors.image)}
                        </FormControl>

                        {/* sizing */}
                        <FormControl id="size" isInvalid={errors.size}>
                            <FormLabel>Les Tailles</FormLabel>
                            <CheckboxGroup defaultValue={data.size} name="size">
                                <Stack spacing={5} direction="row">
                                    {SIZES.map((size, i) => (
                                        <Checkbox
                                            key={i}
                                            isChecked={data.size[i]}
                                            onChange={(e) => sizeChange(e, i)}
                                        >
                                            {size}
                                        </Checkbox>
                                    ))}
                                </Stack>
                            </CheckboxGroup>
                            {showError(errors.size)}
                        </FormControl>

                        {/* color */}
                        <FormControl id="color" my={3} isInvalid={errors.color}>
                            <FormLabel>Couleurs</FormLabel>
                            <Wrap spacing={4} direction="row">
                                {data.color.map((clr, i) => (
                                    <WrapItem key={i}>
                                        <Tooltip label="clique ici pour supprimer">
                                            <Box
                                                w={SIZE_COLOR.w}
                                                h={SIZE_COLOR.h}
                                                bg={clr}
                                                border="1px"
                                                borderColor="gray.200"
                                                borderRadius="md"
                                                boxShadow="base"
                                                cursor="pointer"
                                                display="flex" alignItems="center" justifyContent="center"
                                                onClick={() => hadnleSupprimerColor(clr)}
                                                onMouseEnter={() => handleMouseEnter(i)}
                                                onMouseLeave={handleMouseLeave}
                                            >
                                                {showIconRemove === i && (
                                                    <CloseIcon color="gray.200" w={SIZE_DEL_ICON.w} h={SIZE_DEL_ICON.h} />
                                                )}
                                            </Box>
                                        </Tooltip>
                                    </WrapItem>
                                ))}
                                <WrapItem>
                                    <Box
                                        w={SIZE_COLOR.w}
                                        h={SIZE_COLOR.h}
                                        bg="white"
                                        border="1px"
                                        borderColor="gray.200"
                                        borderRadius="md"
                                        boxShadow="base"
                                        cursor="pointer"
                                        onClick={setColorPicker.toggle}
                                        display="flex" alignItems="center" justifyContent="center"
                                    >
                                        <AddIcon color="gray.200" w={SIZE_ADD_ICON.w} h={SIZE_ADD_ICON.h} />
                                    </Box>
                                </WrapItem>
                                {colorPicker.toString() === 'true' && (
                                <Box>
                                    <Box pos="fixed" top="0" left="0" right="0" bottom="0" onClick={setColorPicker.off} />
                                    <SketchPicker onChangeComplete={changeColor} />
                                </Box>
                                )}
                            </Wrap>
                            {showError(errors.color)}
                        </FormControl>
                    </Box>
                </Grid>

                <Flex justify="end">
                    <Button
                        type="submit"
                        bg="blue.400"
                        color="white"
                        _hover={{ bg: "blue.300", }}
                        disabled={processing}
                        isLoading={processing}
                    >
                        Enregisterer
                    </Button>
                </Flex>
            </Box>
        </form>

        <AddMarque
            create={true}
            isOpen={isOpen}
            onClose={onClose}
        />
    </>
    );
};

export default Create;
