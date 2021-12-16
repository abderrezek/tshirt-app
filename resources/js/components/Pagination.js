import React, { useState, useEffect } from "react";
import { Link } from '@inertiajs/inertia-react';
import { Button } from '@chakra-ui/react';
import { ArrowBackIcon, ArrowForwardIcon } from '@chakra-ui/icons';

const Pagination = ({ links, nextUrl, prevUrl }) => {
    const lastItem = links.length - 1;

    return links.length > 0 && links.map((link, i) => (
        <Button
            as={Link}
            href={link.url}
            isDisabled={i === 0 ? prevUrl === null : i === lastItem ? nextUrl === null : link.active}
            isActive={i === 0 ? prevUrl === null : i === lastItem ? nextUrl === null : link.active}
            key={i}
            mx={2}
            size="sm"
            leftIcon={i === 0 ? <ArrowBackIcon /> : null}
            rightIcon={i === lastItem ? <ArrowForwardIcon /> : null}
            colorScheme={
                (i === 0 || i === lastItem) ? 'blue' : 'cyan'
            }
        >
            {i === 0 ? 'Previous' : i === lastItem ? 'Next' : link.label}
        </Button>
    ));
};

export default Pagination;