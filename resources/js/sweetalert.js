import Swal from "sweetalert2";

window.addEventListener('confirm-checkout', event => {
  Swal.fire({
    title: event.detail.title,
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: event.detail.confirmButtonText,
    denyButtonText: event.detail.denyButtonText,
  }).then((result) => {
    let timerInterval, icon, title, type;
    if (result.isConfirmed) {
      title = event.detail.msgYes;
      icon = 'success';
      type = 'yes';
    } else if (result.isDenied) {
      title = event.detail.msgNo;
      icon = 'info';
      type = 'no';
    }
    if (!result.isDismissed) {
      Swal.fire({
        icon: icon,
        title: title,
        html: 'Je vais fermer dans <b></b> millisecondes.',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 100)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          Livewire.emit('result', type)
        }
      })
    }
  })
});
