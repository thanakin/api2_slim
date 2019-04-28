# api2_slim
API RESTful com PHP e Slim Framework, outro exemplo<br>
original: https://imasters.com.br/back-end/aprenda-a-usar-o-restful-com-php-e-slim-framework<br>

<ul>
    <li>GET /produtos/    Retorna uma lista de todos os produtos cadastrados;</li>
    <li>GET /produtos/<id>  Retorna o produto de acordo com a sua chave primária <id>;</li>
    <li>POST /produtos/  Salva o objeto produto. Como não há id, gera um INSERT;</li>
    <li>POST /produtos/<id>  Salva o objeto produto. Neste caso realiza um UPDATE. Poderia usar PUT também;</li>
    <li>DELETE /produtos/<id> Apaga o objeto produto;</li>
    <li>GET /categorias/ Obtém a lista de categorias.</li>
</ul>