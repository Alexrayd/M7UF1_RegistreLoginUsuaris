// Obtener elementos
const popup = document.getElementById('popup');
const openPopup = document.getElementById('openPopup');
const closeBtn = document.querySelector('.close-btn');
const formulario = document.getElementById('formulario');

// Abrir el popup al hacer clic en el enlace
openPopup.addEventListener('click', (event) => {
    event.preventDefault(); // Evita que el enlace recargue la página
    popup.style.display = 'flex';
});

// Cerrar el popup al hacer clic en la "X"
closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});

// Cerrar el popup al hacer clic fuera de él
popup.addEventListener('click', (e) => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
});

// Manejar el envío del formulario
formulario.addEventListener('submit', (event) => {
    event.preventDefault(); // Evita que la página se recargue
    alert("Formulario enviado con éxito!");

    // Opcional: limpiar los campos del formulario
    formulario.reset();

    // Cerrar el popup después de enviar el formulario
    popup.style.display = 'none';
});
