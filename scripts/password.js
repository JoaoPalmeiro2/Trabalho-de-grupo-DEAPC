const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question("Digite a password: ", function(password) {
    const temLetra = /[a-zA-Z]/.test(password);
    const temNumero = /[0-9]/.test(password);

    if (temLetra && temNumero) {
        console.log("A password é válida (contém letras e números).");
    } else {
        console.log("A password é inválida. Deve conter letras e números.");
    }

    rl.close();
});
