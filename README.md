## Sobre a API da Bíblia

Este projeto se trata de uma API, onde se é possível extrair passagens bíblicas em diferentes versões, além de também apresentar um plano de leitura bíblica anual.

## Instalação

- Faça o download do código e extraia onde deseja instalar.
- Abra o terminal na pasta onde está o projeto e execute o comando "composer update" (é necessário ter o Composer instalado).
- Na pasta do projeto, crie o arquivo .env e copie e cole nele o conteúdo de .env.example, e preencha as variáveis conforme o ambiente onde você está instalando o projeto.
- Uma vez configurado as variáveis de ambiente, abra o terminal na pasta do projeto e execute o comando "php artisan migrate" para criar as tabelas do banco de dados.
- Abra o terminal na pasta do projeto e execute o comando "php artisan db:seed" para adicionar os dados iniciais no banco de dados.
- Inicie o servidor PHP a partir da pasta public.

## Extrair Passagem Bíblica
É muito simples de usar: basta acessar a seguinte rota: /passage/{version}/{abbrev}/{passages}, substituindo as variáveis pelos valores correspondentes. Exemplos:
- /api/passage/nvi/gn/1 -> Gênesis 1, Nova Versão Internacional;
- /api/passage/acf/ex/2:7 -> Êxodo 2:7, Almeida Corrigida Fiel;
- /api/passage/a21/lv/2:1-3;3:4,7,8 -> Levítico 2:1-3 e 3:4,7 e 8, Almeida Século 21.

## Plano de Leitura
É muito simples de usar: basta acessar a seguinte rota: /plan/{planId}/{day}/{version}, substituindo as variáveis pelos valores correspondentes. Exemplos:
- /api/plan/1/1/nvi -> Passagens do 1º dia, de acordo com o Plano de Leitura Anual da SBB, Nova Versão Internacional;
- /api/plan/2/135/acf -> Passagens do 135º dia, de acordo com o Plano de Leitura Cronológico, Almeida Corrigida Fiel;
- /api/plan/2/365/a21 -> Passagens do 365º dia, de acordo com o Plano de Leitura Cronológico, Almeida Século 21.

As rotas /diary e /weekly representam, respectivamente, as leituras diária e semanal. A rota /diary trará os textos respectivos do dia de hoje e a rota /weekly trará uma tabela contendo as referências das passagens bíblicas de cada dia da semana, começando de domingo até sábado.

## Valores para Variáveis
Valores para a variável version: a21, aa, acf, ara, arc, kja, nvi, nvt.
Valores para a variável abbrev: gn, ex, lv, nm, dt, js, jz, rt, 1sm, 2sm, 1rs, 2rs, 1cr, 2cr, ed, ne, et, job, sl, pv, ec, ct, is, jr, lm, ez, dn, os, jl, am, ob, jn, mq, na, hc, sf, ag, zc, ml, mt, mc, lc, jo, at, rm, 1co, 2co, gl, ef, fp, cl, 1ts, 2ts, 1tm, 2tm, tt, fm, hb, tg, 1pe, 2pe, 1jo, 2jo, 3jo, jd, ap.