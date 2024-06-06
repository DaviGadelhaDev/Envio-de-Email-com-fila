--Para fazer o envio do email
    -php artisan make:mail WelcomeEmail
    --Implementar antes do commit

--Para fazer o envio do email com fila
    -php artisan make:job JobSendWelcomeEmail

--Para executar a fila
    -php artisan queue:work