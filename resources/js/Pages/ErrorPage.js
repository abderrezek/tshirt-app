import React from 'react'
import { Box, Heading } from '@chakra-ui/react';

export default function ErrorPage({ status }) {
  console.log(status);

  return (
    <Box>
      <Heading>404 page</Heading>
    </Box>
  );
}