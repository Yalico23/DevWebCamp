// let tags = [];

// document.addEventListener('DOMContentLoaded', function () {
//     inicializarTags();
// });

// function inicializarTags() {
//     inicializarEntradaDeTags();
//     recuperarTags();
// }
// function inicializarEntradaDeTags(){
//     const tagsInput = document.querySelector('#tags_input');
//     if (tagsInput) {
//         tagsInput.addEventListener('keypress', function(e){
//             guardarTag(e, tagsInput);
//         });
//     }
// }
// function recuperarTags(){
//     const InputNameTags = document.querySelector('[name="Tags"]');

//     if(InputNameTags.value !== ''){
//         tags = InputNameTags.value.split(',');
//         listarTags();
//     }
// }

// function guardarTag(e, tagsInput) {
//     if (e.code === 'Comma') {
//         e.preventDefault(); // Evita que la coma se añada al input
//         const tag = tagsInput.value.trim();
//         if (tag) {
//             tags = [...tags, tag];
//             // console.log(tags);
//             limpiarInput(tagsInput);
//             listarTags();
//         }
//     }
// }
// function limpiarInput(tagsInput) {
//     tagsInput.value = '';
// }

// function listarTags(){
//     const contenedorTags = document.querySelector('#tags');

//     contenedorTags.textContent = '';
//     tags.forEach((tag)=>{
//         const etiqueta = document.createElement('LI');
//         etiqueta.classList.add('formulario__tag');
//         etiqueta.textContent = tag;
//         etiqueta.ondblclick = eliminarTag;
//         contenedorTags.appendChild(etiqueta);
//     });
//     ActualizarInputHidden();
// }

// function ActualizarInputHidden(){//se usa para agregar o eliminar
//     const InputNameTags = document.querySelector('[name="Tags"]');
//     InputNameTags.value = tags.toString();
// }

// function eliminarTag(e){
//     e.target.remove();
//     tags = tags.filter(tag => tag  !== e.target.textContent);//crea un arreglo nuevo desasociando con el e
//     ActualizarInputHidden();
// }

(function () {
  const tagsInput = document.querySelector("#tags_input");

  if (tagsInput) {
    let tags = [];
    recuperarTags();

    tagsInput.addEventListener("keypress", function (e) {
      guardarTag(e, tagsInput);
    });

    function guardarTag(e, tagsInput) {
      if (e.code === "Comma") {
        e.preventDefault(); // Evita que la coma se añada al input
        const tag = tagsInput.value.trim();
        if (tag) {
          tags = [...tags, tag];
          limpiarInput(tagsInput);
          listarTags();
        }
      }
    }

    function limpiarInput(tagsInput) {
      tagsInput.value = "";
    }

    function listarTags() {
      const contenedorTags = document.querySelector("#tags");

      contenedorTags.textContent = "";
      tags.forEach((tag) => {
        const etiqueta = document.createElement("LI");
        etiqueta.classList.add("formulario__tag");
        etiqueta.textContent = tag;
        etiqueta.ondblclick = eliminarTag;
        contenedorTags.appendChild(etiqueta);
      });
      ActualizarInputHidden();
    }

    function ActualizarInputHidden() {
      //se usa para agregar o eliminar
      const InputNameTags = document.querySelector('[name="Tags"]');
      InputNameTags.value = tags.toString();
    }

    function eliminarTag(e) {
      e.target.remove();
      tags = tags.filter((tag) => tag !== e.target.textContent); //crea un arreglo nuevo desasociando con el e
      ActualizarInputHidden();
    }

    function recuperarTags(){
            const InputNameTags = document.querySelector('[name="Tags"]');
        
            if(InputNameTags.value !== ''){
                tags = InputNameTags.value.split(',');
                listarTags();
            }
        }
  }
})();
