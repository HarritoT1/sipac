const contactsDeleted = [];

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

const addEmergencyContact = () => {
    const id = new Date().getTime()
    const container = document.getElementById('emergencyContactsSection');
    container.insertAdjacentHTML('beforeend', `<form class="emergency-contact-block needs-validation d-flex justify-content-between gap-3 align-items-center"
                novalidate autocomplete="off" id="emergencyContactForm_${id}" action="" method="post" enctype="application/x-www-form-urlencoded">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="nameEmergencyContact_${id}" class="form-label custom-label">Nombre y apellidos</label>
                        <input type="text" class="form-control form-control-custom" id="nameEmergencyContact_${id}" name="nameEmergencyContact_${id}"
                            placeholder="Ingresa el nombre completo" required maxlength="255" />
                        <div class="invalid-feedback">
                            Ingresa un nombre completo válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="relationshipEmergencyContact_${id}" class="form-label">Parentesco</label>
                        <select class="form-select text-secondary" id="relationshipEmergencyContact_${id}" name="relationshipEmergencyContact_${id}" required>
                            <option value="">Selecciona un parentesco...</option>
                            <option value="padre">Padre</option>
                            <option value="madre">Madre</option>
                            <option value="hermano(a)">Hermano/a</option>
                            <option value="tio(a)">Tio/a</option>
                            <option value="primo(a)">Primo/a</option>
                            <option value="amigo(a)">Amigo/a</option>
                        </select>
                        <div class="invalid-feedback">
                            Selecciona un parentesco válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="emailEmergencyContact_${id}" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control form-control-custom" id="emailEmergencyContact_${id}" name="emailEmergencyContact_${id}"
                            placeholder="example@domain.com" maxlength="255" />
                        <div class="invalid-feedback">
                            Ingresa un correo electrónico válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="phone_numberEmergencyContact_${id}" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control form-control-custom"
                            id="phone_numberEmergencyContact_${id}" name="phone_numberEmergencyContact_${id}" placeholder="10 dígitos numéricos" required
                            maxlength="20" />
                        <div class="invalid-feedback">
                            Ingresa un número de teléfono válido.
                        </div>
                    </div>

                    <div class="col-12 mt-3 form-check text-start mb-4 ms-2">
                        <label class="form-check-label" for="is_primary_${id}" style="color: #475569; font-size: 0.85rem;">
                            Este contacto es el principal para emergencias
                        </label>
                        <input class="form-check-input" type="checkbox" value="is-primary" id="is_primary_${id}" />
                    </div>
                </div>

                <button onclick="removeEmergencyContact(${id})" type="button" class="btn-remove-contact" title="Eliminar contacto">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </form>`);
};

const removeEmergencyContact = (id) => {
    if (confirm("¿Estás seguro de que deseas eliminar este contacto de emergencia?")) {
        const contactForm = document.getElementById(`emergencyContactForm_${id}`);
        if (contactForm.classList.contains('existing')) contactsDeleted.push(id);
        contactForm.remove();
    }
};

function patientCreateOrUpdateFormSubmit() {
    const forms = document.querySelectorAll('.needs-validation')

    // Todo form deben pasar la validación de Bootstrap, si no, no se envía el formulario.
    const anyInvalid = Array.from(forms).some(form => {
        if (!form.checkValidity()) {
            //console.log("Formulario inválido:", form);
            form.classList.add('was-validated');
            return true;
        }
        form.classList.add('was-validated');
        return false;
    }
    );

    if (anyInvalid) {
        alert("Por favor, completa todos los campos requeridos correctamente antes de enviar el formulario.");
        return;
    }

    const form = document.getElementById('registerForm') ?? document.getElementById('actForm');
    const isCreateForm = form.id === 'registerForm';
    const mainForm = new FormData(form);

    const emergencyContactForms = document.querySelectorAll('#emergencyContactsSection > form');

    if (emergencyContactForms.length === 0) {
        alert("Debes agregar al menos un contacto de emergencia.");
        return;
    }

    const emergencyContacts = Array.from(emergencyContactForms).map(contactForm => {
        const contactFormData = new FormData(contactForm);
        const id = contactForm.id.split('_')[1];
        return {
            id: id,
            name: contactFormData.get(`nameEmergencyContact_${id}`),
            relationship: contactFormData.get(`relationshipEmergencyContact_${id}`),
            email: contactFormData.get(`emailEmergencyContact_${id}`),
            phone_number: contactFormData.get(`phone_numberEmergencyContact_${id}`),
            is_primary: document.getElementById(`is_primary_${id}`)?.checked
        };
    }
    );

    mainForm.append('emergency_contacts', JSON.stringify(emergencyContacts));

    if (isCreateForm) submitFormData(mainForm, '', 'POST');
    else submitFormData(mainForm, '', 'PUT');

    return;
}

function submitFormData(formData, action, method = 'POST') {

    const form = document.createElement('form');

    form.method = 'POST';
    form.action = action;
    form.enctype = 'multipart/form-data';
    form.style.display = 'none';

    for (const [key, value] of formData.entries()) {

        if (value instanceof File) {

            // Evitar agregar archivos vacíos opcionales.
            if (value.name === '' && value.size === 0 && value.type === 'application/octet-stream') continue;

            const input = document.createElement('input');
            input.type = 'file';
            input.name = key;

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(value);

            input.files = dataTransfer.files;

            form.appendChild(input);

            continue;
        }

        const input = document.createElement('input');

        input.type = 'hidden';
        input.name = key;
        input.value = value;

        form.appendChild(input);
    }

    if (method === 'PUT' && contactsDeleted.length > 0) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'contacts_deleted';
        input.value = JSON.stringify(contactsDeleted);
        form.appendChild(input);
    }

    document.body.appendChild(form);

    form.submit();

    return;
}

const deleteAvatar = (userId) => {
    if (!confirm("¿Estás seguro de que deseas eliminar la foto de perfil?")) return;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/users/${userId}/avatar`;
    form.enctype = 'application/x-www-form-urlencoded; charset=UTF-8a';
    form.style.display = 'none';

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);

    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = document.querySelector('meta[name="csrf-token"]')?.content;
    form.appendChild(tokenInput);

    document.body.appendChild(form);

    form.submit();
};