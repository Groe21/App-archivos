document.addEventListener('DOMContentLoaded', function() {
    const deleteFoldersButton = document.getElementById('deleteFolders');

    deleteFoldersButton.addEventListener('click', function(event) {
        event.preventDefault();

        // Obtener todas las carpetas seleccionadas
        const selectedCheckboxes = document.querySelectorAll('.folder-checkbox:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));

        if (selectedIds.length > 0) {
            // Confirmar la eliminación
            if (confirm('¿Estás seguro de que deseas eliminar las carpetas seleccionadas?')) {
                // Enviar una solicitud al servidor para eliminar las carpetas
                fetch('/app_archivos/src/views/carpetas/eliminarCarpeta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recargar la página o actualizar el contenido para reflejar los cambios
                        location.reload();
                    } else {
                        alert('No se pudo eliminar las carpetas. Inténtalo de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al eliminar las carpetas.');
                });
            }
        } else {
            alert('Por favor, selecciona al menos una carpeta para eliminar.');
        }
    });
});
