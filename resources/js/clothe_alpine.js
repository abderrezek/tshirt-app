document.addEventListener('alpine:init', () => {
    Alpine.data('cartItems', () => ({
        open: false,
        type: 'cart',

        toggleAuth() {
            this.open = true;
            this.type = 'auths';
        },
        isAuth() {
            return this.open && this.type === 'auths';
        },
        toggleCart() {
            this.open = true;
            this.type = 'cart';
        },
        isCart() {
            return this.open && this.type === 'cart';
        },
    }));

    // Clothe Data
    Alpine.data('clothe', () => ({
        open: false,
        clothe: -1,
        show: false,

        hideApercuRapide() {
            this.show = false;
        },
        showApercuRapide(id) {
            this.show = true;
            this.clothe = id;
        },
        isShowApercuRapide(id) {
            return this.show && this.clothe === id;
        },
        openModal(id) {
            this.open = true;
            this.clothe = id;
        },
        isOpenModal(id) {
            return this.open && this.clothe === id;
        },
    }));

    Alpine.data('panier', () => ({
        code: false,
        remarque: false,
        address: false,

        toggleCode() {
            this.code= ! this.code
        },
        toggleRemarque() {
            this.remarque = ! this.remarque
        },
        toggleAddress() {
            this.address = ! this.address
        },
    }));
});