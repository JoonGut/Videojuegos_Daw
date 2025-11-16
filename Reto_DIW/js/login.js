document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.formulario form') || document.querySelector('form');
    if (!form) return;

    const fields = {
        usuario: form.querySelector('input[name="usuario"]'),
        password: form.querySelector('input[name="password"]')
    };

    // Crea o devuelve un span de error dentro del contenedor del input
function getErrorSpan(el) {
    const container = el.parentNode; // el div.username
    let span = container.querySelector('.error-msg');
    if (!span) {
        span = document.createElement('span');
        span.className = 'error-msg';
        container.appendChild(span); // siempre al final del div
    }
    return span;
}

    // Limpia el mensaje de error
    function clearError(el) {
        const container = el.parentNode;
        const span = container.querySelector('.error-msg');
        if (span) span.textContent = '';
        el.classList.remove('invalid');
    }

    // Muestra mensaje de error
    function setError(el, msg) {
        const span = getErrorSpan(el);
        span.textContent = msg;
        el.classList.add('invalid');
    }


    function validaUsuario(val) {
        if (!val) {
            return 'El usuario es obligatorio.';
        } else if (!/^[A-Za-zÀ-ÖØ-öø-ÿ\s'\-]+$/.test(val)) {
            return 'Usuario contiene caracteres no permitidos.';
        }
        return '';
    }


    function validaPassword(val) {
        if (!val){
            return 'La contraseña es obligatoria.';
        }else{
            return '';
        }
    }

    function validarTodos() {
        let ok = true;
        let firstInvalid = null;
        //Obtenemos texto y validamos
        let err = validaUsuario(fields.usuario.value.trim());
        if (err) {
            setError(fields.usuario, err);
            ok = false;
            firstInvalid = firstInvalid || fields.usuario;
        } else {
            clearError(fields.usuario);
        }

        err = validaPassword(fields.password.value);
        if (err) {
            setError(fields.password, err);
            ok = false;
            firstInvalid = firstInvalid || fields.password;
        } else {
            clearError(fields.password);
        }

        if (!ok && firstInvalid) firstInvalid.focus();
        return ok;
    }

    // Limpiar errores al escribir
    Object.values(fields).forEach(f => {
        if (!f) return;
        f.addEventListener('input', () => clearError(f));
    });


    form.addEventListener('submit', function (e) {
        if (!validarTodos()) e.preventDefault();
    });
});
