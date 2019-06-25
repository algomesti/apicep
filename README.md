# Busca CEP

## Start e Stop do Serviço

### Start

* Execute:    

	```
	make up -e PORT_LOC={{PORT}}
	```
* onde:    
	
	```
	{{PORT}} = porta local
	```
* exemplo:  
	
	```
	make up -e PORT_LOC=8001
	```

#### Neste caso o serviço subirá na porta ``` 8001 ```

```
localhost:8001/api-cep/
```

### Stop

* Execute: 

	```
	make down -e PORT_LOC={{PORT}}
	```
* onde:
  
	```
	{{PORT}} = porta local
	```
* exemplo:

	```
	make down -e PORT_LOC=8001
	```

## Visão Geral da Arquitetura
O serviço consiste em busca de cep, conforme url definida em varíavel de ambiente.
- O sistema usa redis para camada de cache.  Primeiro a aplicação busca o cep no redis, caso não encontre busca no endpoint e atualiza o cache com o dado.
- O dado é gravado no redis com ttl definido em varável de ambiente.
- As variáveis de ambiente estão no arquivo:
```
env.php
```


### Tecnologias envolvidas
- PHP
- APACHE
- Redis
- Slim (Framework PHP)

### Instalação (Makefile)
- Faz o build a Imagem Docker
- Instala a app da api 
- Instala a app do cliente
- Inicializa o Redis

### API
#### EndPoints:

##### /api-cep/<cep>

- Objetivo:
	
    - Buscar um endereço de acordo com o cep

- Método:
	- GET 
- URI
	- /api-cep/get/(cep)/
- Parametros:
	- Nenhum
- Exemplos:

	```
	http://localhost:8001/api-cep/get/80030-430/
	```
- Exemplo de Resposta:

```
{
    "cep_original": "80030-430",
    "cep_tratado": "80030430",
    "is_cached": true,
    "data": {
        "cep": "80030-430",
        "logradouro": "Rua Elbe Pospissil",
        "complemento": "",
        "bairro": "Juvevê",
        "localidade": "Curitiba",
        "uf": "PR",
        "unidade": "",
        "ibge": "4106902",
        "gia": ""
    },
    "ttl": 28
}

```
 