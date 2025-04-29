// botão de ativos e inativos

document.addEventListener("DOMContentLoaded", function () {
    const inativoBtn = document.getElementById("inativo");
    const formInativo = document.getElementById("form-inativo");
    const ativoBtn = document.getElementById("ativo");

    if (inativoBtn && formInativo) {
        inativoBtn.addEventListener("click", function () {
            formInativo.style.display = "block";
        });
    }

    if (ativoBtn && formInativo) {
        ativoBtn.addEventListener("click", function () {
            formInativo.style.display = "none";
        });
    }
});

//status de clientes

document.addEventListener("DOMContentLoaded", function () {
    let statusElements = document.querySelectorAll(".status");

    statusElements.forEach(function(status) {
        if (status.textContent.trim() === "ATIVO") {
            status.style.backgroundColor = "green";
            status.style.color = "white";
        } else {
            status.style.backgroundColor = "red";
            status.style.color = "white";
        }
    });
});


//consumindo API viaCEP para preenchimento dos dados

  // Quando o usuário sair do campo de CEP, chama a função
  document.getElementById("cep").addEventListener("blur", buscarCep);

  function buscarCep() {
    // Pegando o valor do campo e tirando tudo que não é número
    const cep = document.getElementById("cep").value.replace(/\D/g, '');

    // Verifica se o CEP tem exatamente 8 dígitos
    if (cep.length !== 8) {
      alert("CEP inválido. Digite 8 números.");
      return;
    }

    // Faz a requisição para a API ViaCEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(dados => {
        if (dados.erro) {
          alert("CEP não encontrado.");
        } else {
          document.getElementById("rua").value = dados.logradouro;
          document.getElementById("bairro").value = dados.bairro;
          document.getElementById("cidade").value = dados.localidade;
          document.getElementById("estado").value = dados.uf; // CORRIGIDO
        }
      })
      .catch(() => {
        alert("Erro ao buscar o CEP.");
      });
  }

