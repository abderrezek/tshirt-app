import React from 'react';
import { render } from 'react-dom';
import { createInertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';

import Layout from "./layout";

InertiaProgress.init({
  delay: 250,
  color: '#29d',
  includeCSS: true,
  showSpinner: false,
});

const layout = page => <Layout children={page} />

createInertiaApp({
  resolve: name => {
    const page = require(`./Pages/${name}`).default
    page.layout = page.layout || layout
    return page
  },
  setup({ el, App, props }) {
    render(<App {...props} />, el)
  },
});