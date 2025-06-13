document.getElementById('loginForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const username = document.getElementById('username').value.trim();
  const password = document.getElementById('password').value;
  const erroEl = document.getElementById('erro');

  // Verifica se a senha contém pelo menos uma letra e um número
  const temLetra = /[a-zA-Z]/.test(password);
  const temNumero = /[0-9]/.test(password);

  if (temLetra && temNumero) {
    // Cria formulário para enviar ao PHP
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'login.php';

    const inputUser = document.createElement('input');
    inputUser.type = 'hidden';
    inputUser.name = 'username';
    inputUser.value = username;

    const inputPass = document.createElement('input');
    inputPass.type = 'hidden';
    inputPass.name = 'password';
    inputPass.value = password;

    form.appendChild(inputUser);
    form.appendChild(inputPass);

    document.body.appendChild(form);
    form.submit();
  } else {
    erroEl.textContent = 'Palavra passe incorreta.';
  }
});
