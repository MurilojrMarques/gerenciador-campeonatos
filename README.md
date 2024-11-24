Sistema de gerenciamento de campeonatos 

-Desenvolvimento de um para criação de campeonatos de futebol 

-Desenvolvimento API para criação de times, sorteio de jogos e placares 

-Utilizando HTML, CSS, Boostrap e PHP para front-end 

 

Downloads 

-Download XAMPP(PHP, Apache e MySQL): https://www.apachefriends.org/xampp-files/8.1.4/xampp-windows-x64-8.1.4-1-VS16-installer.exe 

- Download Composer: https://getcomposer.org/Composer-Setup.exe 

 

Para testes 

1 - Em uma pasta detinada ao projeto, utilizando os comandos : 

- git init 

- git clone https://github.com/MuriloJrMarques/gerenciador-campeonatos

2 - Utilize o comando "composer install" na pasta do projeto clonado 

3 - Verifique se o arquivo ".env" foi gerado, caso não tenha sido, execute os seguintes passos: 

- Na pasta do projeto, execute "cp .env.example env" e "php artisan key:generate" 

4 - Utilizando MYSQL faça: 

- Crie um banco de dados e altere o nome no arquivo .env com username e password caso tenha 

- Caso tenha Host e Porta coloque-os dentro do .env também 

5 - Novamente na pasta do projeto, utilize o comando "php artisan migrate" para a criação das tabelas no banco 

7 - Configure um servidor apache e insira o projeto dentro dele, ou utilize o comando "php artisan serve" 

8 - Para testar pode utilizar diretamente servidor navegando pelas telas web 
