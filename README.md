# API CFOP

Esta API fornece uma lista de CFOPs (Códigos Fiscais de Operações e Prestações) extraídos de uma página pública da Secretaria da Fazenda de Pernambuco. A API retorna os dados em formato JSON.

## Endpoints

### `GET /cfop-api.php`

> Retorna uma lista de CFOPs disponíveis na tabela da Secretaria da Fazenda de Pernambuco.

#### Exemplo de resposta:
```json
{
  "mensagem": "CFOPs listados com sucesso!",
  "cfops": [
    {
      "cfop": 101,
      "descricao": "Venda de produção do estabelecimento"
    },
    {
      "cfop": 102,
      "descricao": "Venda de mercadoria adquirida ou recebida de terceiros"
    }
  ]
}
```

## Como usar

- Faça o clone ou download deste repositório.

- Coloque o arquivo cfop-api.php em seu servidor local ou de produção.

- Acesse o endpoint via navegador ou ferramenta como curl ou Postman:

```web
http://localhost/cfop-api.php
```

>A resposta será uma lista dos CFOPs em formato JSON.

### Requisitos
- PHP 7.0 ou superior
- Servidor web como Apache ou Nginx
