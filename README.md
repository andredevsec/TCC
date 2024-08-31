<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/andredevsec/ordemservicoPHP?color=%2304D361">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/andredevsec/ordemservicoPHP">

  <a href="https://github.com/andredevsec/ordemservicoPHP/commits/main">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/andredevsec/ordemservicoPHP">
  </a>
</p>

<h4 align="center"> 
	📓 Ordem de Serviço com PHP 📓
</h4>

<p align="center">
 <a href="#-sobre-o-projeto">Sobre</a> •
 <a href="#-funcionalidades-principais">Funcionalidades</a> •
 <a href="#-como-executar-o-projeto">Como executar</a> • 
 <a href="#-tecnologias">Tecnologias</a> • 
 <a href="#-autores">Autores</a> 
</p>

## 💻 Sobre o projeto

Este é um sistema que permite a manipulação de ordens de serviço, desde a sua criação a sua finalização.

---

## 🐘 Funcionalidades Principais

- [x] Login como usuário, cliente ou terceirizado; alteração de senha; cadastro de cliente.

![tela-principal](https://github.com/user-attachments/assets/63b4426f-1849-439c-8ef0-52057ccaa08e)

- [x] Painel administrativo, sendo possível visualizar quantitativamente o estado das ordens de serviço.

![painel-administrativo](https://github.com/user-attachments/assets/071ef51d-e3bf-4361-93a4-52107f2c5fc5)

- [x] Cadastro de usuário (administrador do sistema), assim como de cliente e terceirizado.

![cadastro-usuario](https://github.com/user-attachments/assets/cfe198f7-d8e4-4b29-ba04-cd0af96c61cb)

- [x] Consulta à API ViaCEP para preenchimento automático dos campos do formulário.

![cadastro-usuario-viacep](https://github.com/user-attachments/assets/6b1173ff-8bd7-46cf-ba24-eca768dd6337)

- [x] Manipulação de ordens de serviço.

![gerenciamento-os](https://github.com/user-attachments/assets/ac8190e0-9de6-4144-a299-b273fe82e318)

- [x] Controle de acesso por perfil.

![perfil](https://github.com/user-attachments/assets/0d1723d3-f6e6-4597-a720-6c719b47d3e1)

---

## 🚀 Como executar o projeto

Para executar o projeto, siga estas etapas:

1. Certifique-se de ter o PHP e o MySQL instalados no seu computador.
2. Clone este repositório para o seu ambiente local.
3. Configure um servidor local:
   - Utilize o XAMPP, WAMP ou MAMP para configurar um servidor local.
5. Crie o banco de dados:
   - Acesse o MySQL via terminal ou use uma ferramenta como phpMyAdmin.
   - Execute o seguinte comando para criar o banco de dados:

    ```sql
    CREATE DATABASE ordemservico;
    ```
  - Execute as instruções contidas no arquivo `ordemservico.sql` no banco criado acima.
7. Configure a conexão com o banco de dados:
   - Confira as credenciais de acesso ao banco no arquivo: `ordemservicoPHP/bd/conecta_bd.php`.
8. Inicie o servidor e acesse o projeto:
   - Se estiver usando XAMPP, WAMP ou MAMP, coloque o projeto na pasta htdocs ou www.
   - Acesse o projeto via navegador:

   ```
   http://localhost/ordemservicoPHP
   ```

9. Use o projeto conforme necessário.

---

## 🛠 Tecnologias

As seguintes tecnologias foram utilizadas neste projeto:

- HTML
- CSS
- JavaScript (ECMAScript)
- PHP
- MySQL

---

## 👨‍💻 Autores

<a href="https://github.com/andredevsec/" target="_blank">
    <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/84422477?v=4" width="100px;" alt=""/>
    <br />
    <sub><b>André Lima</b> 🚀</sub>
</a>

<br />
<br />

<a href="https://www.linkedin.com/in/andredevsec/" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a>

<a href="https://github.com/josuemleite/" target="_blank">
    <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/84863364?v=4" width="100px;" alt=""/>
    <br />
    <sub><b>Josué Melquisedeque Leite</b> 🚀</sub>
</a>

<br />
<br />

<a href="mailto:josuemelquileite@gmail.com"><img src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white" target="_blank"></a>
<a href="https://www.linkedin.com/in/josuemleite/" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a>
