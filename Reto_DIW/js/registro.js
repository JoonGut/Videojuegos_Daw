document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('listaEmpleados');
    const hidden = document.getElementById('tienda_id_hidden');


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
    });
});