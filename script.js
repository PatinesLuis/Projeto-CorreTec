document.querySelectorAll(".editar-btn").forEach(botao => {
    botao.addEventListener("click", function () {
        const tr = this.closest("tr");
        const id = tr.dataset.id;

        // Captura dos dados corretamente das células
        const nome = tr.querySelector("td:nth-child(2)").innerText; // 2ª célula
        const premio = tr.querySelector("td:nth-child(3)").innerText; // 3ª célula
        const capital = tr.querySelector("td:nth-child(4)").innerText; // 4ª célula
        const tipo = tr.querySelector("td:nth-child(5)").innerText; // 5ª célula

        // Remove formulário anterior (se existir)
        const formExistente = tr.nextElementSibling;
        if (formExistente && formExistente.classList.contains("editar-form")) {
            formExistente.remove();
            return;
        }

        // Criação do formulário de edição
        const novaLinha = document.createElement("tr");
        novaLinha.classList.add("editar-form");

        const td = document.createElement("td");
        td.colSpan = 6; // A coluna deve cobrir todas as células

        const form = document.createElement("form");
        form.action = "../processos/processoSeguros.php";
        form.method = "post";

        // Criação dos inputs com valores já preenchidos
        const tipoInput = document.createElement("input");
        tipoInput.type = "hidden";
        tipoInput.name = "tipo";
        tipoInput.value = "editar";

        const idInput = document.createElement("input");
        idInput.type = "hidden";
        idInput.name = "id";
        idInput.value = id;

        const nomeInput = document.createElement("input");
        nomeInput.type = "text";
        nomeInput.name = "nome_seguradora";
        nomeInput.value = nome;

        const premioInput = document.createElement("input");
        premioInput.type = "text";
        premioInput.name = "premio";
        premioInput.value = premio;

        const capitalInput = document.createElement("input");
        capitalInput.type = "text";
        capitalInput.name = "capital";
        capitalInput.value = capital;

        const tipoSeguroInput = document.createElement("input");
        tipoSeguroInput.type = "text";
        tipoSeguroInput.name = "tipo_seguro";
        tipoSeguroInput.value = tipo;

        const botaoSalvar = document.createElement("button");
        botaoSalvar.type = "submit";
        botaoSalvar.textContent = "Salvar";

        // Adicionando os inputs ao formulário
        form.appendChild(tipoInput);
        form.appendChild(idInput);
        form.appendChild(nomeInput);
        form.appendChild(premioInput);
        form.appendChild(capitalInput);
        form.appendChild(tipoSeguroInput);
        form.appendChild(botaoSalvar);

        td.appendChild(form);
        novaLinha.appendChild(td);

        tr.parentNode.insertBefore(novaLinha, tr.nextSibling); // Inserindo o novo formulário após a linha
    });
});
