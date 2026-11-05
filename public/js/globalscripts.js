function asigListenersOfSubmitForms() {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated');
        }, false)
    })
}

function togglePassword() {
    const password_field = document.getElementById("password");
    const type = password_field.type === "password" ? "text" : "password";
    password_field.type = type;

    const eye_icon = type === "password" ? "http://127.0.0.1:8000/img/eye.png" : "http://127.0.0.1:8000/img/eyeclosed.png";

    document.querySelector("span[onclick='togglePassword()'] > img").src = eye_icon;
}

function matchPasswords() {
    const password_field = document.getElementById("password");
    const confirm_password_field = document.getElementById("confirm_password");
    const value_password = password_field?.value?.trim();
    const value_confirm_password = confirm_password_field?.value?.trim();

    const password_feedback = document.getElementById('password_invalid_feedback');
    const confirm_password_feedback = document.getElementById('confirm_password_invalid_feedback');

    //Si ninguna de las contraseñas tiene valor, no mostrar mensaje de error.
    if (!value_password && !value_confirm_password) {
        password_feedback.textContent = 'Ingresa una contraseña válida.';
        confirm_password_feedback.textContent = 'Ingresa una confirmación de contraseña válida.';
        password_field?.classList?.remove(['is-invalid', 'is-valid']);
        confirm_password_field?.classList?.remove(['is-invalid', 'is-valid']);

        document.getElementById('submit')?.setAttribute('disabled', '');
        return;
    }

    if (!(value_password === value_confirm_password)) {
        password_feedback.textContent = 'Las contraseñas no coinciden.';
        confirm_password_feedback.textContent = 'Las contraseñas no coinciden.';

        password_field?.classList?.add('is-invalid');
        confirm_password_field?.classList?.add('is-invalid');

        password_field?.classList?.remove('is-valid');
        confirm_password_field?.classList?.remove('is-valid');

        document.getElementById('submit')?.setAttribute('disabled', '');
        return;
    } else {
        password_feedback.textContent = 'Ingresa una contraseña válida.';
        confirm_password_feedback.textContent = 'Ingresa una confirmación de contraseña válida.';

        password_field?.classList?.remove('is-invalid');
        confirm_password_field?.classList?.remove('is-invalid');

        password_field?.classList?.add('is-valid');
        confirm_password_field?.classList?.add('is-valid');

        document.getElementById('submit')?.removeAttribute('disabled');
        return;
    }
}

const changePage = (change, numPages) => {
    const pageInput = document.getElementById('page');
    let currentPage = parseInt(pageInput.value);

    if ((currentPage === 1 && change < 0) || (currentPage + change > numPages)) return;

    pageInput.value = currentPage + change;

    document.getElementById('filterForm').requestSubmit();
};

const previewImage = (event, idImg) => {
    const fileInput = event.target;
    const previewImg = document.getElementById(idImg);

    if (fileInput.files.length > 0 && fileInput.files[0] && previewImg) {
        const file = fileInput.files[0];

        if (!file.type.startsWith("image/") || (!file.type.includes("jpeg") && !file.type.includes("png") && !file.type.includes("jpg"))) {
            alert("El archivo seleccionado no es una imagen válida.");
            fileInput.value = ""; //Vaciamos el FileList para que el usuario pueda seleccionar otro archivo válido.
            previewImg.src = "http://127.0.0.1:8000/img/default-avatar.png";
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            previewImg.src = e.target.result;
        }

        reader.onerror = function (e) {
            alert('Ocurrió un error al cargar la imagen. Por favor, inténtelo de nuevo.');
            fileInput.value = ""; //Vaciamos el FileList para que el usuario pueda seleccionar otro archivo válido.
            previewImg.src = "http://127.0.0.1:8000/img/default-avatar.png";
        }

        reader.readAsDataURL(file);
    }

    else {
        previewImg.src = "http://127.0.0.1:8000/img/default-avatar.png";
    }
}
