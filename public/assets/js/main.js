document.querySelector('select[name="locale"').addEventListener('change', async (e) => {
    try {
        const response = await fetch('/locale', {
            'method': 'POST',
            'body': JSON.stringify({'locale': e.target.value}),
            'headers': {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        if (!response.ok) {
            const error = await response.json();
            console.error(error);
            return;
        }

        const result = await response.json();
        if (result.success) {
            window.location.reload();
        }
    } catch (error) {
        console.error(error.message);
    }
});