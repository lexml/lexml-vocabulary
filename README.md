# Vocabulários LexML

O controle de vocabulários desempenha papel fundamental na organização da informação governamental e estruturação de conteúdos nos documentos oficiais.

Os vocabulários do [projeto LexML Brasil](https://pt.wikipedia.org/wiki/LexML_Brasil), conforme apresentados na [_Parte 6_ das normas LexML](http://projeto.lexml.gov.br/documentacao/Parte-6-Vocabularios-Controlados.pdf),  são utilizados nas [URNs LEX](https://en.wikipedia.org/wiki/Lex_(URN) ([Parte 2](http://projeto.lexml.gov.br/documentacao/Parte-2-LexML-URN.pdf)). Há também a previsão de utilização dos vocabulários LeXML como  referência para os [diários oficiais](https://en.wikipedia.org/wiki/Government_gazette) do governo brasileiro, no controle da terminologia espressa em títulos das matérias e seções dos diários.

Os vocabulários são aqueles elencados nas seções 2 e 3 da referida norma Parte 6:<br/> "2.1 *Natureza do Conteúdo*" (`tipoConteudo`), "2.2 *Língua*" (`lingua`),  "2.3 *Evento*" (`evento`),  "3.1 *Localidade*" (`localidade`),  "3.2 *Autoridade*" (`autoridade`) e  "3.3 *Tipo de Documento*" (`tipoDocumento`),
disponíveis nas pastas [/data/RDF-v*](data) do presente repositório, com proveniência e autenticidade descritos [nesta documentação](docs/preparo.md).

Na ausência de um comitê formal (seção 1.1 da Parte 6), os mantenedores do presente repositório *git* assumem parte das atribuições do "Comitê Central para a Atribuição de Nomes" do LexML.

Apesar do [padrão RDF](https://en.wikipedia.org/wiki/Resource_Description_Framework) permitir o uso de diferentes formatos, foi adotado o  [RDF/XML](https://en.wikipedia.org/wiki/RDF/XML) como principal &mdash; que por sua vez, historicamente no LexML, foi inspirado pelo [padrão RDA](https://en.wikipedia.org/wiki/Resource_Description_and_Access).

## Versão corrente dos vocabulários

A [_tag_ de versão próprio *git*](https://github.com/lexml/lexml-vocabulary/releases) determina a versão corrente válida &mdash; a mais recente entre as versões lançadas, e em geral anterior ao último *commit* do repositório. As _tags_ de versão seguem a sintaxe de [Major.minNor.Patch](http://semVer.org/) (<tt>vM.N.P</tt>), sendo que os arquivos RDF são mantidos em sua versão mais na pasta correspondente <tt>vM.N</tt>.

A _tag_ do repositório só é atribuída quando todos os RDFs da pasta mais atual forem homologados. Arquivos que não sofrem alteração permanecem na pasta onde receberam a última homologação. No repositório são previstos os seguintes tipos de arquivo:

* Documentos **XML** formato RDF: mantidos cada qual na sua pasta `data/RDF-vM.N`, quando um arquivo estiver ausente significa que ainda se encontra na versão anterior (portanto na pasta correspondente).

* Documentos **CSV**: mantidos na pasta de dados, [*data*](data) e descritos no arquivo [`datapackage.json`](datapackage.json), seguem a versão corrente do repositório, em  sincronia (ou à frente) dos arquivos RDF. Versões específicas poderão ser encontradas navegandos-se pelas [versões antigas do repositório](https://github.com/lexml/lexml-vocabulary/releases).

## Licenças

* **Software**: algoritmos e códigos-fonte de software,  licença relativa à pasta [`/src`](src), **[*MIT*](https://spdx.org/licenses/MIT.html)**.

* **Dados**: arquivos CSV, JSON, XML e demais arquivos de dados, **[*ODbL-1.0*](https://spdx.org/licenses/ODbL-1.0.html)**

* **Conteúdo**: presente documentação e todos os aqrquivos da pasta [/docs](docs), **[*CC-BY-4*](https://creativecommons.org/licenses/by/4.0/)**.
