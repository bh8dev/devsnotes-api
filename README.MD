# DevsNotes API - PHP Estrutural

## O que é?

Um projeto de anotações.

## Planejamento

### Levantamentos

#### O que o projeto precisa fazer?

- Inserir uma anotação;
- Listar anotações;
- Ver o conteúdo de uma anotação específica;
- Atualizar uma anotação;
- Deletar uma anotação

#### Qual a estrutura de dados?

O que uma anotação tem?
Ps: Entenda aqui, a anotação como um objeto e pense em características que uma anotação tem. ;D

No caso desta API, teremos:

- id;
- title;
- body;
- Local para armazenar anotações

#### Quais serão os endpoints?

Para simplificar, a quantidade de endpoints será basicamente a mesma quantidade de itens que o projeto irá fazer.

Seguiremos esta estrutura:

> (Metodo) /url/arquivo.php?parametros

- (GET) /api/getall.php (Listar as anotações)

- (GET) /api/get.php?id=123 (Ver o conteúdo de uma anotação específica)
- (POST) /api/insert.php (title, body) (Criar uma nova anotação)
- (PUT) /api/update.php (title, body) (Atualizar uma anotação)
- (DELETE) /api/delete.php (Deletar uma anotação)

A partir dessas informações, que iremos seguir para construir nosso banco de dados, etc... A API como um todo.
