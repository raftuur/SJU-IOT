document.addEventListener('DOMContentLoaded', function () {

    const avatarButton =
        document.getElementById('avatarButton');

    const avatarInput =
        document.getElementById('avatarInput');

    const avatarPreview =
        document.getElementById('profileAvatarPreview');

    const avatarForm =
        avatarInput?.closest('form');


    if (!avatarButton || !avatarInput || !avatarForm) {
        return;
    }


    // Buka file picker
    avatarButton.addEventListener('click', function () {

        avatarInput.click();

    });


    // Pilih avatar
    avatarInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }


        // Validasi format
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            alert(
                'Format gambar harus JPG, PNG, atau WebP.'
            );

            this.value = '';

            return;
        }


        // Validasi ukuran
        if (file.size > 2 * 1024 * 1024) {

            alert(
                'Ukuran gambar maksimal 2 MB.'
            );

            this.value = '';

            return;
        }


        // Preview
        const reader = new FileReader();

        reader.onload = function (event) {

            if (avatarPreview.tagName !== 'IMG') {

                const image =
                    document.createElement('img');

                image.src =
                    event.target.result;

                image.alt =
                    'Avatar';

                image.className =
                    'profile-avatar-image';

                image.id =
                    'profileAvatarPreview';

                avatarPreview.replaceWith(image);

            } else {

                avatarPreview.src =
                    event.target.result;

            }


            // Submit otomatis
            avatarForm.submit();

        };

        reader.readAsDataURL(file);

    });

});