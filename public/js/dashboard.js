function copyText(text) {
    return navigator.clipboard
        .writeText(text)
        .catch(() => {

            const input = document.createElement('textarea');

            input.value = text;

            document.body.appendChild(input);

            input.select();

            document.execCommand('copy');

            document.body.removeChild(input);
        });
}

document.addEventListener('DOMContentLoaded', () => {

    window.showToast = function (message) {

        const toastEl = document.getElementById('appToast');

        toastEl.querySelector('.toast-body').textContent = message;

        const toast = new bootstrap.Toast(toastEl);

        toast.show();
    };

    const flashSuccess =
        document.getElementById('flash-success');

    if (flashSuccess) {

        showToast(
            flashSuccess.dataset.message
        );

    }

    document.addEventListener('click', async (e) => {

        const copyButton = e.target.closest('.copy-btn');

        if (copyButton) {

            try {

                await copyText(copyButton.dataset.url);

                const originalText = copyButton.innerText;

                copyButton.innerText = 'Copied!';

                showToast('URL copied successfully');

                setTimeout(() => {
                    copyButton.innerText = originalText;
                }, 2000);

            } catch (error) {

                showToast('Failed to copy URL');
            }

            return;
        }

        const qrButton = e.target.closest('.qr-btn');

        if (qrButton) {

            document.getElementById('qr-image').src =
                qrButton.dataset.qrUrl;

            const modal = new bootstrap.Modal(
                document.getElementById('qrModal')
            );

            modal.show();
        }
    });

    $(document).ready(function () {

        $('#urlsTable').DataTable({

            processing: true,

            serverSide: true,

            ajax: '/dashboard/data',

            order: [[0, 'desc']],

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'short_code',
                    name: 'short_code'
                },
                {
                    data: 'original_url',
                    name: 'original_url'
                },
                {
                    data: 'clicks',
                    name: 'clicks',
                    orderable: true,
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });

    });

});