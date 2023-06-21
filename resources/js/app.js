import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// DELETE

//prendo i buttons
const deleteSubmitButtons = document.querySelectorAll('.delete-button');
//ad ognuno assegno e-listener e e-prevent
deleteSubmitButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        //recupero il data-title
        const dataTitle = button.getAttribute('data-item-title');
        //prendo la modale
        const modal = document.getElementById('deleteModal');
        //assegno modale di bootstrap e relativo show
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        //inserisco il data-title nel modal title
        const modalItemTitle = modal.querySelector('#modal-item-title');
        modalItemTitle.textContent = dataTitle;
        //prendo il button della modale
        const buttonDelete = modal.querySelector('button.btn-danger');
        //gli assegno e-listener
        buttonDelete.addEventListener('click', () => {
            //e submit del parent
            button.parentElement.submit();
        });
    });
});

//EDIT TYPE
//prendo i bottoni matita
const pencilEdit = document.querySelectorAll('.pencil-edit');
//ciclo sui bottoni
pencilEdit.forEach((pencil)=>{
    pencil.addEventListener('click', (e)=>{ //al click
        e.preventDefault();
        //prendo il form
        const tdFormEdit = document.getElementById('td-form-edit');
        //lo rendo visibile
        tdFormEdit.classList.remove('d-none');
        tdFormEdit.classList.add('d-table-cell');
        //prendo il nome
        const tdNameEdit = document.getElementById('td-name-edit');
        //lo rendo invisibile
        tdNameEdit.classList.remove('d-table-cell');
        tdNameEdit.classList.add('d-none');

        //prendo il bottone submit edit
        const submitEdit = document.getElementById('submit-edit');
        //all'evento submit
        submitEdit.addEventListener('submit', () =>{
            //rendo invisibile il form
            tdFormEdit.classList.remove('d-table-cell');
            tdFormEdit.classList.add('d-none');
             //rendo visibile il nome
            tdNameEdit.classList.remove('d-none');
            tdNameEdit.classList.add('d-table-cell');
        });



    });
});
