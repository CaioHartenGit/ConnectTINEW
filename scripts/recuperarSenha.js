const emailForm = document.getElementById('formEmail');
const emailInput = document.getElementById('emailRecuperacao');
const emailHidden = document.getElementById('emailHidden');

emailForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const email = emailInput.value.trim();
    if (!email) return;

    fetch('../recuperar_senha.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'email=' + encodeURIComponent(email)
    })
    .then(() => {
        emailHidden.value = email;

        bootstrap.Modal.getInstance(
            document.getElementById('emailModal')
        ).hide();

        new bootstrap.Modal(
            document.getElementById('codigoModal')
        ).show();
    });
});