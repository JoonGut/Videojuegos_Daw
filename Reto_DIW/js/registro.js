document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('listaEmpleados');
    const hidden = document.getElementById('tienda_id_hidden');
    const form = document.querySelector('.formulario form');

    // Crea un span de error junto al input
    function getErrorSpan(el) {
        let span = el.parentNode.querySelector('.error-msg');
        if (!span) {
            span = document.createElement('span');
            span.className = 'error-msg';
            span.style.color = 'crimson';
            span.style.fontSize = '0.9em';
            span.style.display = 'block';
            span.style.marginTop = '4px';
            el.parentNode.appendChild(span);
        }
        return span;
    }

    function clearError(el) {
        const span = el.parentNode.querySelector('.error-msg');
        if (span) span.textContent = '';
        el.classList.remove('invalid');
    }

    function setError(el, msg) {
        const span = getErrorSpan(el);
        span.textContent = msg;
        el.classList.add('invalid');
    }


    // Limpia el select y agrega la opción por defecto
    select.innerHTML = '';
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Selecciona una direccion';
    select.appendChild(defaultOption);

    // Cargar datos desde PHP
    fetch('../php/getEmpleados.php')
        .then(response => {
            if (!response.ok) throw new Error('Error HTTP ' + response.status);
            return response.json();
        })
        .then(data => {
            if (!Array.isArray(data) || data.length === 0) return;

            data.forEach(tienda => {
                const opt = document.createElement('option');
                opt.value = tienda.id_tienda;       // ID que queremos guardar en hidden
                opt.textContent = tienda.direccion; // Texto visible en el select
                select.appendChild(opt);
            });

            // Inicializa hidden con el valor actual (por si hay algo seleccionado)
            hidden.value = select.value || '';
        })
        .catch(err => {
            console.error('Error cargando tiendas:', err);
        });

    // Actualiza el hidden al cambiar la selección
    select.addEventListener('change', function() {
        hidden.value = this.value || '';
        clearError(select);
    });

    // ---------- Validación del formulario ----------
    if (form) {
        // Mapea campos por name para validarlos
        const fields = {
            DNI: form.querySelector('input[name="DNI"]'),
            nombre: form.querySelector('input[name="nombre"]'),
            apellido: form.querySelector('input[name="apellido"]'),
            fecha_nacimiento: form.querySelector('input[name="fecha_nacimiento"]'),
            usuario: form.querySelector('input[name="usuario"]'),
            email: form.querySelector('input[name="email"]'),
            password: form.querySelector('input[name="password"]'),
            tienda: select
        };

        // Validadores individuales
        function validaDNI(val) {
            if (!val){
                return 'El DNI es obligatorio.';
            }else{  
                if (!/^[0-9]{7,8}[A-Za-z]$/.test(val)){
                    return 'Formato DNI inválido (ej: 12345678A).';
                } else{
                    return '';
                }
            }
        }

        function validaNombre(val) {
            if (!val){
                return 'El nombre es obligatorio.';
            }else{
                if (val.length < 2){
                    return 'Nombre demasiado corto.';
                } else{
                    if (!/^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(val)){
                        return 'Nombre contiene caracteres no permitidos.';
                    }else{
                        return '';
                    }
                }
            }

        } 
        

        function validaApellido(val) {
            if (!val){
                return 'El apellido es obligatorio.';
            }else{
            if (val.length < 2){
                return 'Apellido demasiado corto.';
            }else{
                if (!/^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(val)){
                    return 'Apellido contiene caracteres no permitidos.';
                } 
                    return '';
            }

            }

        }

        function validaFecha(val) {
            if (!val) {
                return 'La fecha de nacimiento es obligatoria.';
            }
            // Formato esperado: yyyy/mm/dd
            if (!/^\d{4}\/\d{2}\/\d{2}$/.test(val)) {
                return 'La fecha debe tener el formato yyyy/mm/dd.';
            }
            const [yStr, mStr, dStr] = val.split('/');
            const y = parseInt(yStr, 10);
            const m = parseInt(mStr, 10);
            const d = parseInt(dStr, 10);

            if (m < 1 || m > 12) return 'Mes inválido.';
            // Creamos un objeto Date con los componentes y comprobamos que coincidan (evita 2021/02/30)
            const fecha_correcta = new Date(y, m - 1, d);
            if (fecha_correcta.getFullYear() !== y || fecha_correcta.getMonth() !== m - 1 || fecha_correcta.getDate() !== d) {
                return 'Fecha inválida.';
            }

            return '';
        }

        function validaUsuario(val) {
            if (!val){
                return 'El usuario es obligatorio.';
            } else{
                if (val.length < 4) return 'El usuario debe tener al menos 4 caracteres.';
                return '';
            }
        }

        function validaEmail(val) {
            if (!val){
                return 'El email es obligatorio.';
            }else{
                // Validacion formato email
                if (!/^[\w-.]+@[\w-_]+(\.[a-zA-Z]{2,4}){1,2}$/.test(val)){ 
                    return 'Email inválido.';
                }else{
                    return '';
                }
            } 

        }

        function validaPassword(val) {
            if (!val){
                return 'La contraseña es obligatoria.';
            }else{
                if (val.length < 8){
                    return 'La contraseña debe tener al menos 8 caracteres.';
                }else{
                    // Validacion contraseña con numeros y letras
                    if (!/[0-9]/.test(val) || !/[A-Za-z]/.test(val)){
                        return 'La contraseña debe contener letras y números.';
                    }else{
                        return '';
                    }
                }
            }
        }

        function validaTienda(val) {
            if (!val){
                return 'Selecciona una dirección.';
            }else{
                return '';
            }
        }

        // Validación completa, devuelve true si OK
        function validarTodos() {
            let ok = true;
            // DNI
            let err;
            err = validaDNI(fields.DNI.value.trim());
            if (err) { 
                setError(fields.DNI, err); ok = false; 
            } else {
                clearError(fields.DNI);
            }

            err = validaNombre(fields.nombre.value.trim());
            if (err) { 
                setError(fields.nombre, err); ok = false; 
            } else {
                clearError(fields.nombre);
            }

            err = validaApellido(fields.apellido.value.trim());
            if (err) { 
                setError(fields.apellido, err); ok = false; 
            } else {
                clearError(fields.apellido);
            }

            err = validaFecha(fields.fecha_nacimiento.value.trim());
            if (err) { 
                setError(fields.fecha_nacimiento, err); ok = false; 
            } else {
                clearError(fields.fecha_nacimiento);
            }

            err = validaUsuario(fields.usuario.value.trim());
            if (err) { 
                setError(fields.usuario, err); ok = false; 
            } else {
                clearError(fields.usuario);
            }

            err = validaEmail(fields.email.value.trim());
            if (err) { 
                setError(fields.email, err); ok = false; 
            } else {
                clearError(fields.email);
            }

            err = validaTienda(fields.tienda.value);
            if (err) { 
                setError(fields.tienda, err); ok = false; 
            } else {
                clearError(fields.tienda);
            }

            err = validaPassword(fields.password.value);
            if (err) { 
                setError(fields.password, err); ok = false; 
            } else {
                clearError(fields.password);
            }

            return ok;
        }

        // Validación en tiempo real: limpiar mensajes al escribir
        Object.values(fields).forEach(f => {
            if (!f) return;
            if (f.tagName === 'SELECT') {
                f.addEventListener('change', () => clearError(f));
            } else {
                f.addEventListener('input', () => clearError(f));
            }
        });

        // Interceptar envío
        form.addEventListener('submit', function(e) {
            if (!validarTodos()) {
                e.preventDefault();
                // Llevar foco al primer campo inválido

            } else {
                // Antes de enviar, asegurar que hidden tenga el id de tienda
                hidden.value = select.value || '';
            }
        });
    }
});