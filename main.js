// main.js

document.addEventListener('DOMContentLoaded', function () {
    // Este evento é acionado quando o DOM está completamente carregado

    // Array para armazenar informações sobre modelos 3D
    const modelos3D = [
        { nome: 'Modelo1', arquivo: 'modelo1.stl' },
        { nome: 'Modelo2', arquivo: 'modelo2.obj' },
        // Adicione mais modelos conforme necessário
    ];

    // Função para carregar e exibir modelos 3D
    function carregarModelos3D() {
        const listaModelos = document.getElementById('modeloList');

        // Limpar a lista antes de adicionar os novos modelos
        listaModelos.innerHTML = '';

        // Iterar sobre a lista de modelos
        modelos3D.forEach((modelo, index) => {
            // Criar elemento de lista
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            
            // Adicionar nome do modelo como texto do item de lista
            listItem.textContent = modelo.nome;

            // Adicionar evento de clique para exibir o modelo
            listItem.addEventListener('click', () => {
                exibirModelo3D(modelo.arquivo);
            });

            // Adicionar item de lista à lista de modelos
            listaModelos.appendChild(listItem);
        });
    }

    // Função para exibir modelos 3D usando a biblioteca Three.js
    function exibirModelo3D(arquivo) {
        // Lógica para exibir modelos 3D usando Three.js
        // Substitua isso com a implementação real conforme necessário
        console.log(`Exibindo modelo 3D: ${arquivo}`);
    }

    // Chamar a função para carregar modelos 3D quando o DOM estiver pronto
    carregarModelos3D();
});
