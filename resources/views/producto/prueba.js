function mostrarProd(id,nombre) {
    Swal.fire({
        title: 'Sweet!',
        text: 'Modal with a custom image.',
        imageUrl: '/imagen/{{$productos['+id+']->imagen}}',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
}

document.getElementById("miBoton").addEventListener("click", miFunc);
function miFunc() {
  alert("Se ha dado clic al botón!");
}