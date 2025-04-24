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