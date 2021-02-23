Manual de utilização .
-Recomendado Laravel 8+


1. Configure a configuração de banco de dados no arqui .env(raiz)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=( database)
DB_USERNAME=(usuario banco)
DB_PASSWORD=(sua senha)



2. Execute o comando "php artisan migration" para que seja gerado todas as tabelas do banco de dados.

3. Execute o comando "php artisan db:seed --class=EscolaridadeTableSeeder" para que seja populado dados na tabela escolaridade.

4. Configure no arquivo .env(raiz) a os dados nescessários para o envio de email.
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=EMAIL
MAIL_PASSWORD=SENHA
MAIL_ENCRYPTION=tls

5. entre na raiz do projeto e execute o comando "php artisan serve" com isso o servidor irá iniciar e gerar a url. O formulário se encontra na raiz /.
