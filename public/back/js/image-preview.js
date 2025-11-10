document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('src').addEventListener('change', function (event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });
});
