import React, { useEffect, useRef, useState } from "react";
import { FormLabel, Image, Box, Flex } from "@chakra-ui/react";

const UploadImage = ({ data = null, setData }) => {
    const imgRef = useRef(null);
    const [image, setImage] = useState(null);
    const [imageInfo, setImageInfo] = useState(null);

    useEffect(() => {
        if (data) {
            console.log(data.image);
            // let file = new File(data.image);
            // console.log(file);
            // setImage(URL.createObjectURL(data.image));
            // imgRef.current.value = data.image;
            // setImage(data.image);
            // setImageInfo(data);
        }
    }, [data]);

    useEffect(() => {
        if (imageInfo !== null) {
            setData('image', imageInfo)
        }
    }, [imageInfo]);

    const handleClick = () => imgRef.current.click();

    const handleChange = (e) => {
        if (e.target.files.length === 0) {
            return;
        }
        setImageInfo(e.target.files[0]);
        setImage(URL.createObjectURL(e.target.files[0]));
    };

    return (
    <>
        <FormLabel onClick={handleClick}>Image</FormLabel>
        <Box w="100%" h="240px" cursor="pointer" bg="gray.100"  border="2px" borderRightRadius="md" borderColor="gray.200" onClick={handleClick}>
            {image === null ? (
                <Flex justify="center" align="center" h="100%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" stroke="#fff">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </Flex>
            ) : (
                <Image src={image} alt={imageInfo.name} objectFit="cover" boxSize="100%" h="100%" />
            )}
        </Box>
        <input
            ref={imgRef}
            style={{ display: 'none' }}
            type="file"
            accept="image/png, image/gif, image/jpeg"
            onChange={handleChange}
        />
    </>
    );
};

export default UploadImage;