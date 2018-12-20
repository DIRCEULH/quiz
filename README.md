# quiz

_______________Funcionalidades_________________
O Usuario (Candidato) poderá cadastrar se e em  seguida realizar o teste. Ao finalizar o teste o mesmo não poderá efetuar o novamente.
O Usuario (Candidato) poderá ver seus erros e acertos no final do teste em menu "detalhes" sempre que logar.
O usuário admin (usuário fixo)também poderá realizar o teste, porém o mesmo poderá cadastrar as perguntas e respostas e exclui-las. Observação: Ao excluir perguntas que já foram usadas em testes implicará no relatório do usuário daquele teste.
O admin também poderá ver os acertos, erros, data , hora do começo e fim.
O admin poderá verificar as perguntas e respostas que o usuário (candidato) acertou e errou no menu "respostas de Usuários".
________________Estrutura________________
O sistema é bastante procedural, tendo uma pasta (INC) com as funcionalidades (functions.php) a conexão com o banco de dados (connection.php),
checagem de usuários logados (check_login.php).
Usamos insert (na inserção das perguntas, dados dos testes nas tabelas answer_user, answer_user_id, questions, question_options e user_admin),
update (na tabela answer_user e questions)e delete (na tabela questions e question_options).
________________Tabelas________________
questions: "tabela que recebe os dados das perguntas"
question_options:" tabela que recebe os dados das respostas"
answer_user:"tabela que recebe os dados dos acertos, data, hora e erros do usuario"
answer_user_id: "tabela que recebe os dados das respostas que o usuário marcou"
user_admin:"tabela dos usuários cadastrados"
______________________________________
Link acesso: https://dirceuluis.000webhostapp.com/quiz/index.php
Programador : Dirceu Luis Heineck
Email: dirceulh@hotmail.com



