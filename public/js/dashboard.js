function copyText(text) {

    return navigator.clipboard
        .writeText(text)
        .catch(() => {

            const input =
                document.createElement('textarea');

            input.value = text;

            document.body.appendChild(input);

            input.select();

            document.execCommand('copy');

            document.body.removeChild(input);
        });
}

document.addEventListener('DOMContentLoaded', () => {

    const toast = document.getElementById('toast');

    function showToast(message, type = 'success') {

        toast.textContent = message;

        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    document.addEventListener('click', async (e) => {

        const button = e.target.closest('.copy-btn');

        if (!button) {
            return;
        }

        try {

            await copyText(
                button.dataset.url
            );

            const originalText =
                button.innerText;

            button.innerText = 'Copied!';

            showToast(
                'URL copied successfully'
            );

            setTimeout(() => {
                button.innerText =
                    originalText;
            }, 2000);

        } catch (error) {

            showToast(
                'Failed to copy URL',
                'error'
            );
        }
    });

});