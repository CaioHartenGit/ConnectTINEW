const docenteCheck  = document.getElementById('docenteCheck');
const docenteFields = document.getElementById('docenteFields');
const alunoFields   = document.getElementById('alunoFields');
const emailProf     = document.getElementById('emailProfissional');
const registro      = document.getElementById('registro');

docenteCheck.addEventListener('change', () => {

    if (docenteCheck.checked) {
        docenteFields.style.display = 'block';
        alunoFields.style.display   = 'none';

        emailProf.required = true;
        registro.required  = true;
    } else {
        docenteFields.style.display = 'none';
        alunoFields.style.display   = 'block';

        emailProf.required = false;
        registro.required  = false;
    }
});