import React from "react";
import { FormControl, FormLabel, Input } from '@chakra-ui/react';

const Search = ({ data, setData }) => {


    const handleChange = (e) => {
        let search = e.target.value;

        if (search === '') {
            setData(data);
            return;
        }
        const searchData = data.map(item => item.name === search);
        setData(searchData);
    };

    return (
    <>
        <FormControl id="search" display="flex" alignItems="center" justifyContent="center">
            <FormLabel w="30%">Rechercher ici</FormLabel>
            <Input type="text" name="search" onChange={handleChange} />
        </FormControl>
    </>
    );
};

export default Search;