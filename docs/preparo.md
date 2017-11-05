# Preparo dos dados

A seguir os procedimentos que estabelecem a [proveniência de dados](https://en.wikipedia.org/wiki/Data_lineage) dos arquivos presentes na pasta [`/data`](../data).

O preparo inicial e conversões se baseiam em algoritmos gerais de processamento XML baseados na [LibXML2](http://xmlsoft.org/). A implementação de referência foi realizada em PHP:

* [xml_normalized.php](../src/xml_normalized.php): limpa o XML, normalizando espaços e ordem dos atributos em conformidade com o XML canônico, [XML-C14N](https://www.w3.org/TR/xml-c14n); porém apresentando o XML de forma usual, com sintaxe de elementos vazios e algum espaçamento (padrão LibXML2) destacando hierarquia.

* [csv_cleaned.php](../src/xml_normalized.php): limpa o CSV, normalizando uso das aspas, espaços e quebras de linha.

* [vocLexMLRdf2csv.php](../src/vocLexMLRdf2csv.php): converte o XML RDF em tabela, criando os arquivos CSV de referência para o trabalho terminológico, garantido a  inspeção visual humana em planilhas e a auditoria em algoritmos de banco de dados SQL, como o [*SQL Dataset Unifier*](https://github.com/datasets-br/sql-unifier).

* *Planilha colaborativa*: é a interface colaborativa para os arquivos CSV, mais amigável para os usuários não-técnicos, está sendo mantida [nesta planilha colaborativa](https://docs.google.com/spreadsheets/d/1FbRVToE2Yu2I7_jfL0mD_MaxWe-m9aKM6ukPqkpju64/edit#gid=1020275856), sem valor de registro (apenas os arquivos CSV deste *git* têm esse valor).

## Fundamentos e motivações

Uma breve introdução sobre o preparo e seus fundamentos.

### Preservação digital

Por se tratar de um repositório público com controle de versões, em particular por se tratar do uso do [sistema *git*](https://en.wikipedia.org/wiki/Git), o presente repositório já vem munido de *checksum* [SHA1](https://en.wikipedia.org/wiki/SHA-1): o que garante a **[integridade física](https://en.wikipedia.org/wiki/Data_integrity#Physical_integrity)** dos arquivos durante as operações cotidianas e, em parte, garante também a sua [autenticidade](https://en.wikipedia.org/wiki/Message_authentication).

Para fins de **[preservação de longo prazo](https://en.wikipedia.org/wiki/Digital_preservation)**, essa mesma garantia pode ser [ampliada se acrescentamos mais uma *hash*](https://crypto.stackexchange.com/a/44281/42893), notadamente [*SHA3 do padrão FIPS 202 de 2015*](https://en.wikipedia.org/wiki/SHA-3). A linha de comando abaixo pode ser utilizada em qualquer sistema Linux para a obtenção do arquivo `sha3-256sum.txt` das assinaturas digitais dos (demais) arquivos de uma pasta:

```sh
sha3sum -a 256 *.* | grep -v sha3-256sum > sha3-256sum.txt
```

Nota: por ser repositório público e audtorável, a garantia de autenticidade é reforçada pelo endosso dos *commiters* e o testemunho dos usuários do LexML em geral.

### Proveniência

A [proveniência dos dados](https://en.wikipedia.org/wiki/Data_lineage#Data_Provenance) deve ser registrada no presente documento, e ser rastreável no *git*.

Alguns processos de preparo levam em consideração a [auditoria de *commits*](https://en.wikipedia.org/wiki/Commit_(version_control)) específicos, relativos ao processamento automático de transformação dos dados sem perda do conteúdo original, garantindo a não-adulteração. Vide por exemplo o uso do algortimo *xml_normalized*.

Esses *commits* são explicitamente indicados na seção "Preparo inicial" do presente documento de descrição do preparo dos dados.

## Preparo inicial

Os arquivos da pasta [`/data/RDF-v1.0`](../data/RDF-v1.0) são cópias dos **vocabulários originais**, citados pela [Parte 6 do LexML](http://projeto.lexml.gov.br/documentacao/Parte-6-Vocabularios-Controlados.pdf) e acessíveis como arquivos XML RDF em [dadosabertos.senado.leg.br](http://dadosabertos.senado.leg.br/dataset/vocabul-rios-controlados-da-urn-lex),  novembro de 2017.

A cópia dos originais foi obtida diretamente do _download_ dos arquivos:

```sh
mkdir data/RDF-v1.0
cd data/RDF-v1.0
wget  http://www.lexml.gov.br/vocabulario/autoridade.rdf.xml
wget  http://www.lexml.gov.br/vocabulario/evento.rdf.xml
wget  http://www.lexml.gov.br/vocabulario/lingua.rdf.xml
wget  http://www.lexml.gov.br/vocabulario/localidade.rdf.xml
wget  http://www.lexml.gov.br/vocabulario/tipoConteudo.rdf.xml
wget  http://www.lexml.gov.br/vocabulario/tipoDocumento.rdf.xml
```
